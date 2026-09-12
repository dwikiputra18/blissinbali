<?php

namespace App\Http\Controllers;

use App\Models\CarRental;
use App\Models\CarBooking;
use App\Notifications\NewCarBookingNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class CarCheckoutController extends Controller
{
    public function index(CarRental $carRental)
    {
        return view('car-rental.checkout', compact('carRental'));
    }

    public function process(Request $request, CarRental $carRental)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'rental_range' => 'required|string',
            'start_date' => 'required|date',
            'rental_days' => 'required|integer|min:1',
        ]);

        $price = $carRental->discounted_price ?? $carRental->price;
        $baseAmount = (int) ($price * $request->rental_days);
        $merchantFee = (int) round($baseAmount * 0.03);
        $totalAmount = $baseAmount + $merchantFee;

        // Configuration
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', true);
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $sitePrefix = config('app.site.prefix', 'ZBT');

        $booking = CarBooking::create([
            'booking_code' => $sitePrefix . '-CAR-' . Str::upper(Str::random(8)),
            'user_id' => auth()->id(),
            'car_rental_id' => $carRental->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'rental_date' => $request->start_date,
            'rental_days' => (int) $request->rental_days,
            'total_amount' => $totalAmount,
            'payment_status' => 'Unpaid',
        ]);

        // Notify admin about the new car booking
        $admin = User::where('email', env('ADMIN_EMAIL'))->first();
        if ($admin) {
            $admin->notify(new NewCarBookingNotification($booking));
        }

        $params = [
            'transaction_details' => [
                'order_id' => $booking->booking_code,
                'gross_amount' => (int) $booking->total_amount,
            ],
            'customer_details' => [
                'first_name' => $booking->name,
                'email' => $booking->email,
                'phone' => preg_replace('/[^0-9+]/', '', $booking->phone),
            ],
            'item_details' => [
                [
                    'id' => (string) $carRental->id,
                    'price' => (int) $price,
                    'quantity' => (int) $request->rental_days,
                    'name' => Str::limit(preg_replace('/[^A-Za-z0-9 ]/', '', $carRental->name), 50),
                ], [
                    'id' => 'merchant-fee',
                    'price' => $merchantFee,
                    'quantity' => 1,
                    'name' => 'Merchant Fee (3%)',
                ]
            ],
        ];

        Log::info('Midtrans Car Payload:', $params);

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            $booking->update(['snap_token' => $snapToken]);

            return view('car-rental.payment', compact('booking', 'snapToken'));
        } catch (\Exception $e) {
            Log::error('Midtrans Car Error: ' . $e->getMessage());
            return back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
    }

    public function callback(Request $request)
    {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            // Use acrossAllSites() to find booking regardless of site scope
            $booking = CarBooking::acrossAllSites()->where('booking_code', $request->order_id)->first();
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

    public function success(CarBooking $booking)
    {
        $carRental = $booking->carRental;

        $adminPhone = '+6281266718008';
        $message = "Hello Admin, I have completed payment for a car rental:\n\n" .
                   "*Booking Code:* " . $booking->booking_code . "\n" .
                   "*Status:* PAID (Via Midtrans)\n" .
                   "*Name:* " . $booking->name . "\n" .
                   "*Email:* " . $booking->email . "\n" .
                   "*Phone:* " . $booking->phone . "\n" .
                   "*Car:* " . $carRental->name . "\n" .
                   "*Date:* " . $booking->rental_date . "\n" .
                   "*Duration:* " . $booking->rental_days . " Day(s)\n" .
                   "*Total Amount:* Rp " . number_format($booking->total_amount, 0, ',', '.');

        $url = "https://wa.me/" . preg_replace('/[^0-9]/', '', $adminPhone) . "?text=" . urlencode($message);

        return redirect($url);
    }

    public function pending(CarBooking $booking)
    {
        return view('car-rental.payment', [
            'booking' => $booking,
            'snapToken' => $booking->snap_token,
            'message' => 'Your payment is still pending. Please complete it to finalize your booking.'
        ]);
    }

    public function error(CarBooking $booking)
    {
        return redirect()->route('car-rental.checkout.index', $booking->carRental->slug)
            ->with('error', 'Payment failed or was canceled. Please try again.');
    }
}
