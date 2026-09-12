@extends('layouts.front')

@section('title', 'Sewa Mobil di Bali - Bliss in Bali')

@section('content')
<div class="pt-24 pb-16 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-gray-800 brand-font mb-4 text-center">Premium Car Rental</h1>
        <p class="text-gray-500 text-center mb-12 max-w-2xl mx-auto">Discover Bali at your own pace. Pick a car that fits your trip and enjoy our excellent service.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($cars as $car)
            <article class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow duration-300 flex flex-col group">
                {{-- Foto Mobil --}}
                <div class="h-56 overflow-hidden relative bg-gray-100 flex-shrink-0">
                    @if($car->image)
                        <img src="{{ Storage::url($car->image) }}" alt="{{ $car->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-yellow-300 to-orange-400 flex items-center justify-center">
                            <i class="fas fa-car text-white text-4xl opacity-50"></i>
                        </div>
                    @endif

                    {{-- Badge Diskon --}}
                    @if($car->discounted_price && $car->discounted_price < $car->price)
                        @php
                            $discountPerc = round((($car->price - $car->discounted_price) / $car->price) * 100);
                        @endphp
                        <div class="absolute top-4 right-4 bg-red-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">
                            Disc {{ $discountPerc }}%
                        </div>
                    @endif
                </div>

                <div class="p-6 flex flex-col flex-grow">
                    {{-- Nama Mobil --}}
                    <h2 class="text-2xl font-bold text-gray-800 brand-font mb-2 group-hover:text-yellow-600 transition-colors">{{ $car->name }}</h2>
                    
                    {{-- Harga --}}
                    <div class="mb-4">
                        @if($car->discounted_price && $car->discounted_price < $car->price)
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-sm text-gray-400 line-through">Rp {{ number_format($car->price, 0, ',', '.') }}</span>
                            </div>
                            <p class="text-xl font-bold text-yellow-700">Rp {{ number_format($car->discounted_price, 0, ',', '.') }} <span class="text-sm text-gray-500 font-normal">/ hari</span></p>
                        @else
                            <p class="text-xl font-bold text-yellow-700">Rp {{ number_format($car->price, 0, ',', '.') }} <span class="text-sm text-gray-500 font-normal">/ day</span></p>
                        @endif
                    </div>

                    {{-- Deskripsi --}}
                    <div class="text-sm text-gray-600 mb-6 flex-grow line-clamp-3">
                        {!! nl2br(e($car->description)) !!}
                    </div>

                    {{-- Tombol Booking --}}
                    <a href="{{ route('car-rental.checkout.index', $car) }}" class="mt-auto block w-full bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-3 px-4 rounded-xl text-center transition-colors shadow">
                        Book Now <i class="fas fa-arrow-right ml-1 text-sm"></i>
                    </a>
                </div>
            </article>
            @endforeach

            @if($cars->isEmpty())
                <div class="col-span-full text-center py-20 bg-white rounded-2xl border border-gray-100 placeholder-content shadow-sm">
                    <i class="fas fa-car-side text-gray-300 text-5xl mb-4"></i>
                    <p class="text-gray-500">No cars available for rent at the moment.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
