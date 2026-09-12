<?php

namespace App\Http\Controllers;

use App\Models\TourPackage;
use App\Models\Booking;
use App\Models\User;
use App\Notifications\NewBookingNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function index(TourPackage $tourPackage)
    {
        return view('checkout.index', compact('tourPackage'));
    }

    public function process(Request $request, TourPackage $tourPackage)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'country_code' => 'required|string|max:10',
            'phone' => 'required|string|max:20',
            'travel_date' => 'required|date|after_or_equal:today',
            'quantity' => 'required|integer|min:1',
            'single_quantity' => $tourPackage->is_activity ? 'required|integer|min:0' : 'nullable',
            'tandem_quantity' => $tourPackage->is_activity ? 'required|integer|min:0' : 'nullable',
            'pricing_option' => $tourPackage->is_activity ? 'required|in:single,tandem,mixed' : 'nullable',
            'pickup_point' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        // 1. Konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        $quantity = (int) $request->quantity;

        if ($tourPackage->is_activity) {
            $singleQuantity = (int) $request->single_quantity;
            $tandemQuantity = (int) $request->tandem_quantity;
            $quantity = $singleQuantity + ($tandemQuantity * 2);

        }

        if ($quantity < $tourPackage->minimum_booking_quantity) {
            return back()
                ->withInput()
                ->withErrors([
                    'quantity' => "This package requires a minimum of {$tourPackage->minimum_booking_quantity} pax.",
                ]);
        }

        if ($tourPackage->is_activity) {
            if ($quantity === 1) {
                $singlePrice = $tourPackage->price_1_pax ?? $tourPackage->activity_single_price ?? $tourPackage->price_2_4 ?? $tourPackage->price;
                $tandemPrice = $tourPackage->tandem_price_2_4 ?? $tourPackage->activity_tandem_price;
            } elseif ($quantity <= 4) {
                $singlePrice = $tourPackage->price_2_4;
                $tandemPrice = $tourPackage->tandem_price_2_4 ?? $tourPackage->activity_tandem_price;
            } elseif ($quantity <= 7) {
                $singlePrice = $tourPackage->price_5_7;
                $tandemPrice = $tourPackage->tandem_price_5_7 ?? $tourPackage->activity_tandem_price;
            } else {
                $singlePrice = $tourPackage->price_8_14;
                $tandemPrice = $tourPackage->tandem_price_8_14 ?? $tourPackage->activity_tandem_price;
            }
            $baseAmount = (int) (($singleQuantity * $singlePrice) + ($tandemQuantity * 2 * $tandemPrice));
            $price = $baseAmount;
            $billableQuantity = 1;
        } elseif ($quantity === 1) {
            $price = $tourPackage->price_1_pax ?? ($tourPackage->price_2_4 !== null ? $tourPackage->price_2_4 + 300000 : $tourPackage->price);
            $billableQuantity = 1;
            $baseAmount = (int) $price;
        } elseif ($quantity <= 4) {
            $price = $tourPackage->price_2_4;
            $billableQuantity = $quantity;
            $baseAmount = (int) ($price * $billableQuantity);
        } elseif ($quantity <= 7) {
            $price = $tourPackage->price_5_7;
            $billableQuantity = $quantity;
            $baseAmount = (int) ($price * $billableQuantity);
        } else {
            $price = $tourPackage->price_8_14;
            $billableQuantity = $quantity;
            $baseAmount = (int) ($price * $billableQuantity);
        }
        $merchantFee = (int) round($baseAmount * 0.03);
        $totalAmount = $baseAmount + $merchantFee;
        $sitePrefix = config('app.site.prefix', 'ZBT');

        $booking = Booking::create([
            'booking_code' => $sitePrefix . '-BOOK-' . Str::upper(Str::random(8)),
            'user_id' => auth()->id(),
            'tour_package_id' => $tourPackage->id,
            'name' => $request->name,
            'email' => $request->email,
            'country_code' => $request->country_code,
            'phone' => $request->phone,
            'travel_date' => $request->travel_date,
            'pickup_point' => $request->pickup_point,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'quantity' => $quantity,
            'single_quantity' => $tourPackage->is_activity ? $singleQuantity : 0,
            'tandem_quantity' => $tourPackage->is_activity ? $tandemQuantity : 0,
            'pricing_option' => $tourPackage->is_activity ? $request->pricing_option : null,
            'total_amount' => $totalAmount,
            'payment_status' => 'Unpaid',
        ]);

        // Notify admin about the new booking
        $admin = User::where('email', env('ADMIN_EMAIL'))->first();
        if ($admin) {
            $admin->notify(new NewBookingNotification($booking));
        }

        // 4. Buat Parameter Transaksi
        $params = [
            'transaction_details' => [
                'order_id' => $booking->booking_code,
                'gross_amount' => (int) $booking->total_amount,
            ],
            'customer_details' => [
                'first_name' => $booking->name,
                'email' => $booking->email,
                'phone' => preg_replace('/[^0-9+]/', '', $booking->country_code . $booking->phone),
            ],
            'item_details' => [[
                    'id' => (string) $tourPackage->id,
                    'price' => (int) $price,
                    'quantity' => (int) $billableQuantity,
                    'name' => Str::limit(preg_replace('/[^A-Za-z0-9 ]/', '', $tourPackage->title), 50),
                ], [
                    'id' => 'merchant-fee',
                    'price' => $merchantFee,
                    'quantity' => 1,
                    'name' => 'Merchant Fee (3%)',
                ]],
        ];

        Log::info('Midtrans Payload:', $params);

        try {
            // 5. Dapatkan Snap Token
            $snapToken = Snap::getSnapToken($params);
            $booking->update(['snap_token' => $snapToken]);

            // 6. Alihkan ke halaman pembayaran
            return view('checkout.payment', compact('booking', 'snapToken'));

        } catch (\Exception $e) {
            Log::error('Midtrans Error: ' . $e->getMessage());
            return back()->with('error', 'Midtrans Error: ' . $e->getMessage());
        }
    }

    public function callback(Request $request)
    {
        $serverKey = config('services.midtrans.serverKey');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            $booking = Booking::acrossAllSites()->where('booking_code', $request->order_id)->first();
            if ($booking) {
                if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                    $booking->update(['payment_status' => 'Paid']);
                } else if ($request->transaction_status == 'cancel' || $request->transaction_status == 'deny' || $request->transaction_status == 'expire') {
                    $booking->update(['payment_status' => 'Failed']);
                }
            }
        }
        return response()->json(['status' => 'success']);
    }

    public function success(Booking $booking)
    {
        $tourPackage = $booking->tourPackage;

        $adminPhone = '+6281266718008';
        $message = "Hello Admin, I have completed payment for a tour package:\n\n" .
                   "*Booking Code:* " . $booking->booking_code . "\n" .
                   "*Status:* PAID (Via Midtrans)\n" .
                   "*Name:* " . $booking->name . "\n" .
                   "*Email:* " . $booking->email . "\n" .
                   "*Phone:* " . $booking->country_code . " " . $booking->phone . "\n" .
                   "*Package:* " . $tourPackage->title . "\n" .
                   "*Date:* " . \Carbon\Carbon::parse($booking->travel_date)->format('d M Y') . "\n" .
                   "*Participants:* " . $booking->quantity . " Person(s)\n" .
                   "*Total Amount:* Rp " . number_format($booking->total_amount, 0, ',', '.') . "\n" .
                   "*Pickup Point:* " . $booking->pickup_point;

        $url = "https://wa.me/" . preg_replace('/[^0-9]/', '', $adminPhone) . "?text=" . urlencode($message);

        return redirect($url);
    }

    public function pending(Booking $booking)
    {
        return view('checkout.payment', [
            'booking' => $booking,
            'snapToken' => $booking->snap_token,
            'message' => 'Your payment is still pending. Please complete it to finalize your booking.'
        ]);
    }

    public function error(Booking $booking)
    {
        return redirect()->route('checkout.index', $booking->tourPackage->slug)
            ->with('error', 'Payment failed or was canceled. Please try again.');
    }
}
