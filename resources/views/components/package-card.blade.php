{{-- resources/views/components/package-card.blade.php --}}
{{-- Usage: <x-package-card :package="$package" /> --}}

@props(['package'])

<article class="card-hover bg-white rounded-2xl overflow-hidden shadow-md group">

    {{-- Photo --}}
    <a href="{{ route('tour.show', $package) }}" class="block relative overflow-hidden h-52">
        @if($package->thumbnail)
            <img src="{{ $package->thumbnail_url }}"
                 alt="{{ $package->title }}"
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
        @elseif($package->images->isNotEmpty())
            <img src="{{ $package->images->first()->image_url }}"
                 alt="{{ $package->title }}"
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
        @else
            <div class="w-full h-full bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center">
                <i class="fas fa-image text-white text-4xl opacity-50"></i>
            </div>
        @endif

        <span class="absolute top-3 left-3 bg-white/90 backdrop-blur text-yellow-700 text-xs font-bold px-3 py-1 rounded-full shadow">
            {{ $package->category->name }}
        </span>

        @if($package->discounted_price && $package->discounted_price < $package->price)
        <span class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow">
            SALE
        </span>
        @endif

        @if($package->images->count() > 0)
        <span class="absolute bottom-3 right-3 bg-black/50 text-white text-xs px-2 py-1 rounded-lg flex items-center gap-1">
            <i class="fas fa-images text-xs"></i> {{ $package->images->count() }}
        </span>
        @endif
    </a>

    {{-- Content --}}
    <div class="p-5">
        <div class="flex items-center gap-3 text-xs text-gray-400 mb-2">
            @if($package->duration)
            <span class="flex items-center gap-1">
                <i class="fas fa-clock"></i> {{ $package->duration }}
            </span>
            @endif
            @if($package->location)
            <span class="flex items-center gap-1">
                <i class="fas fa-map-marker-alt"></i> {{ $package->location }}
            </span>
            @endif
        </div>

        <h4 class="font-bold text-gray-800 text-base leading-snug mb-2 group-hover:text-yellow-600 transition-colors line-clamp-2 min-h-[2.8em]">
        <a href="{{ route('tour.show', $package) }}">{{ $package->title }}</a>
        </h4>

        @if($package->description)
        <p class="text-gray-500 text-sm leading-relaxed mb-4 line-clamp-2">
            {{ $package->description }}
        </p>
        @endif

        <div class="flex items-end justify-between pt-3 border-t border-gray-100">
            <div>
                @if($package->price_2_4)
                    <div class="flex flex-col">
                        <span class="text-xs text-gray-400 uppercase tracking-widest font-semibold mb-0.5">Starts from</span>
                        <div class="flex items-baseline gap-1">
                            <span class="text-xl md:text-2xl font-bold text-yellow-700">
                                Rp {{ number_format($package->price_2_4, 0, ',', '.') }}
                            </span>
                            <span class="text-xs text-gray-400 font-medium">/ pax</span>
                        </div>
                    </div>
                @else
                    <span class="text-sm text-gray-400 italic font-medium">Contact Us</span>
                @endif
            </div>
            <a href="{{ route('tour.show', $package) }}"
               class="inline-flex items-center gap-2 bg-yellow-600 hover:bg-yellow-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors">
                Details <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
    </div>

</article>