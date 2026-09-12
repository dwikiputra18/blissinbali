@extends('layouts.front')

@section('content')
<div class="pt-24 pb-16 bg-gray-50 min-h-screen">
    <div class="max-w-3xl mx-auto px-4">
        <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
            <div class="bg-blue-950 p-6 text-white text-center">
                <h1 class="text-2xl font-bold">Car Rental Booking Review</h1>
                <p class="opacity-90 text-sm">Please review your booking details before proceeding to payment.</p>
            </div>

            <div class="p-8">
                <div class="flex flex-col md:flex-row gap-6 mb-8 pb-8 border-b border-gray-100">
                    <div class="w-full md:w-40 h-40 rounded-2xl overflow-hidden flex-shrink-0">
                        @if($booking->carRental->image)
                            <img src="{{ Storage::url($booking->carRental->image) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">No Image</div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <span class="inline-block px-3 py-1 bg-blue-950 text-white rounded-full text-xs font-bold mb-2">
                            Car Rental
                        </span>
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $booking->carRental->name }}</h2>
                        <p class="text-gray-500 text-sm flex items-center gap-2">
                            <i class="far fa-calendar-alt"></i> {{ $booking->rental_date }}
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div>
                        <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-user-circle text-blue-950"></i> Customer Info
                        </h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Name</span>
                                <span class="font-medium text-gray-800">{{ $booking->name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Email</span>
                                <span class="font-medium text-gray-800">{{ $booking->email }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Phone</span>
                                <span class="font-medium text-gray-800">{{ $booking->phone }}</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-info-circle text-blue-950"></i> Booking Summary
                        </h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Booking Code</span>
                                <span class="font-mono font-bold text-blue-950">{{ $booking->booking_code }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Duration</span>
                                <span class="font-medium text-gray-800">{{ $booking->rental_days }} Day(s)</span>
                            </div>
                            <div class="pt-3 border-t border-dashed flex justify-between items-center">
                                <span class="text-gray-800 font-bold">Total Payment</span>
                                <span class="text-xl font-black text-yellow-600">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <button id="pay-button" class="w-full bg-blue-950 hover:bg-blue-900 text-white py-4 rounded-2xl font-bold text-lg transition-all shadow-lg shadow-blue-950/30 flex items-center justify-center gap-3">
                        <i class="fas fa-lock"></i>
                        Secure Payment Now
                    </button>
                    
                    <p class="text-center text-xs text-gray-400">
                        <i class="fas fa-shield-alt mr-1"></i> 
                        Payments are securely processed by Midtrans.
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ url()->previous() }}" class="text-gray-500 hover:text-gray-800 text-sm font-medium transition-colors">
                <i class="fas fa-arrow-left mr-1"></i> Back to booking form
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
<script type="text/javascript">
    const payButton = document.getElementById('pay-button');

    payButton.onclick = function (e) {
        e.preventDefault();
        
        // Tambahkan state loading pada tombol
        payButton.innerHTML = '<i class="fas fa-spinner animate-spin"></i> Processing...';
        payButton.disabled = true;

        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function (result) {
                window.location.href = "{{ route('car-rental.checkout.success', $booking->booking_code) }}";
            },
            onPending: function (result) {
                window.location.href = "{{ route('car-rental.checkout.pending', $booking->booking_code) }}";
            },
            onError: function (result) {
                window.location.href = "{{ route('car-rental.checkout.error', $booking->booking_code) }}";
            },
            onClose: function () {
                // Kembalikan tombol ke keadaan semula jika ditutup
                payButton.innerHTML = '<i class="fas fa-lock"></i> Secure Payment Now';
                payButton.disabled = false;
                alert('You closed the payment window without finishing the process.');
            }
        });
    };
</script>
@endpush
@endsection
