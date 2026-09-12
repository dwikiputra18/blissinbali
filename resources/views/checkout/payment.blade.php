@extends('layouts.front')

@section('content')
<div class="pt-24 pb-16 bg-[#F8F9FA] min-h-screen">
    <div class="max-w-3xl mx-auto px-4">
        <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
            <div class="bg-[#0A2240] p-6 text-white text-center">
                <h1 class="text-2xl font-bold">Booking Review</h1>
                <p class="opacity-90 text-sm">Please review your booking details before proceeding to payment.</p>
            </div>

            <div class="p-8">
                <div class="flex flex-col md:flex-row gap-6 mb-8 pb-8 border-b border-gray-100">
                    <div class="w-full md:w-40 h-40 rounded-2xl overflow-hidden flex-shrink-0">
                        @if($booking->tourPackage->thumbnail)
                            <img src="{{ Storage::url($booking->tourPackage->thumbnail) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">No Image</div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <span class="inline-block px-3 py-1 bg-[#F8F9FA] text-[#0A2240] rounded-lg text-xs font-bold mb-2">
                            {{ $booking->tourPackage->category->name ?? 'Tour Package' }}
                        </span>
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $booking->tourPackage->title }}</h2>
                        <p class="text-gray-500 text-sm flex items-center gap-2">
                            <i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($booking->travel_date)->format('d M Y') }}
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div>
                        <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-user-circle text-[#C68A36]"></i> Customer Info
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
                                <span class="font-medium text-gray-800">{{ $booking->country_code }}{{ $booking->phone }}</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-info-circle text-[#C68A36]"></i> Booking Summary
                        </h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Booking Code</span>
                                <span class="font-mono font-bold text-[#0A2240]">{{ $booking->booking_code }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Total Participants</span>
                                <span class="font-medium text-gray-800">{{ $booking->quantity }} Person(s)</span>
                            </div>
                            @if($booking->pricing_option)
                            <div class="flex justify-between">
                                <span class="text-gray-500">Activity Type</span>
                                <span class="font-medium text-gray-800">{{ ucfirst($booking->pricing_option) }}</span>
                            </div>
                            @endif
                            <div class="pt-3 border-t border-dashed flex justify-between items-center">
                                <span class="text-gray-800 font-bold">Total Payment</span>
                                <span class="text-xl font-black text-[#C68A36]">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-2xl p-4 mb-8 flex gap-4 items-start">
                    <div class="bg-white p-2 rounded-lg shadow-sm text-[#C68A36]">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Pickup Point</p>
                        <p class="text-sm text-gray-700 leading-relaxed">{{ $booking->pickup_point }}</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <button id="pay-button" class="w-full bg-[#0A2240] hover:bg-[#0E2F56] text-white py-4 rounded-lg font-bold text-lg transition-all shadow-lg shadow-[#0A2240]/20 flex items-center justify-center gap-3">
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
                window.location.href = "{{ route('checkout.success', $booking->booking_code) }}";
            },
            onPending: function (result) {
                window.location.href = "{{ route('checkout.pending', $booking->booking_code) }}";
            },
            onError: function (result) {
                window.location.href = "{{ route('checkout.error', $booking->booking_code) }}";
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
@endsection
