{{-- resources/views/components/destination-card.blade.php --}}
{{-- Usage: <x-destination-card :package="$package" /> --}}

@props(['package'])

@php
    // Kumpulkan semua kolom harga yang mungkin ada
    // Filter nilai yang null atau 0 agar tidak ikut terhitung sebagai harga termurah
    $prices = collect([
        $package->price_2_4,
        $package->price_5_7,
        $package->price_8_14,
        // Tambahkan kolom harga lain di sini jika ada di database Anda
    ])->filter(fn($price) => $price > 0);

    $lowestPrice = $prices->min();
@endphp

<div class="card bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden group cursor-pointer h-full flex flex-col">

    {{-- Foto --}}
    <div class="relative h-44 overflow-hidden bg-gray-200">
        @if($package->thumbnail)
            <img class="card-img w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                 src="{{ $package->thumbnail_url }}"
                 alt="{{ $package->title }}">
        @elseif($package->images->isNotEmpty())
            <img class="card-img w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                 src="{{ $package->images->first()->image_url }}"
                 alt="{{ $package->title }}">
        @else
            <div class="w-full h-full bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center">
                <i class="fas fa-image text-white text-4xl opacity-40"></i>
            </div>
        @endif

        {{-- Rating --}}
        @if($package->rating)
        <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-2 py-0.5 rounded-full text-xs font-bold text-orange-600 shadow">
            <i class="fas fa-star text-yellow-400 text-xs"></i> {{ number_format($package->rating, 1) }}
        </div>
        @endif

        {{-- Badge --}}
        @if($package->badge_label)
        <div class="absolute bottom-3 left-3">
            <span class="bg-black/60 text-white px-2 py-0.5 rounded-full text-[10px]">
                @if($package->badge_icon)<i class="fas {{ $package->badge_icon }} mr-1"></i>@endif
                {{ $package->badge_label }}
            </span>
        </div>
        @endif
    </div>

    {{-- Konten --}}
    <div class="p-3 md:p-4 flex flex-col flex-grow">
        <h4 class="font-bold text-gray-800 text-xs md:text-base leading-snug mb-1 md:mb-2 group-hover:text-yellow-600 transition-colors 
                    /* Mengunci tinggi box judul agar selalu setara 2 baris */
                    line-clamp-2 h-[2.6em] md:h-[3em] flex items-start overflow-hidden">
    
                        <a href="{{ route('tour.show', $package) }}" class="block">
                        {{ $package->title }}
                        </a>
                    </h4>
        @if($package->location)
        <p class="text-gray-400 text-[10px] md:text-xs flex items-center gap-1 mb-2">
            <i class="fas fa-map-marker-alt text-indigo-400"></i>
            {{ $package->location }}
        </p>
        @endif

        @if($package->description)
        <p class="text-gray-500 text-[10px] md:text-xs mb-4 line-clamp-2">{{ $package->description }}</p>
        @endif

        {{-- Harga & Tombol --}}
        <div class="mt-auto pt-3 border-t border-gray-100 flex flex-col gap-3">
            <div>
                @if($lowestPrice)
                    <span class="text-[9px] uppercase font-bold text-gray-400 block mb-0.5">Starts from</span>
                    <span class="text-sm md:text-lg font-extrabold text-orange-600 leading-tight">
                        Rp {{ number_format($lowestPrice, 0, ',', '.') }}
                    </span>
                    <span class="text-[10px] text-gray-400 font-medium">/pax</span>
                @else
                    <span class="text-xs text-gray-400 italic">Contact for price</span>
                @endif
            </div>

            <div class="flex items-center justify-between gap-2">
                <a href="{{ route('tour.show', $package) }}"
                    class="flex-1 bg-yellow-600 hover:bg-yellow-700 text-white text-[10px] md:text-xs font-bold py-2 md:py-2.5 rounded-xl text-center transition-all shadow-sm active:scale-95">
                    Details
                </a>
            </div>
        </div>
    </div>

</div>