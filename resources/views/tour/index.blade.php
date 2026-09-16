@extends('layouts.front')

@section('title', ($activeCategory ? $activeCategory->name . ' — ' : '') . 'Tour Packages — Bliss in Bali')

@push('styles')
<style>
    .card-hover { transition: transform .3s ease, box-shadow .3s ease; }
    .card-hover:hover { transform: translateY(-6px); box-shadow: 0 20px 40px rgba(0,0,0,.12); }
    .category-pill.active { background-color: #d97706; color: #fff; border-color: #d97706; }
    .line-through-price { text-decoration: line-through; }
</style>
@endpush

@section('content')

{{-- HERO --}}
<section class="relative bg-gradient-to-br from-yellow-700 via-orange-600 to-amber-500 pt-32 pb-20 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-72 h-72 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-20 w-96 h-96 bg-white rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-yellow-100 text-sm font-semibold uppercase tracking-widest mb-3">
            Handcrafted Experiences Await You
        </p>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 brand-font">
            {{ $activeCategory ? $activeCategory->name : 'All Tour Packages' }}
        </h1>
        <p class="text-yellow-100 text-lg max-w-2xl mx-auto">
            @if($activeCategory)
                Showing <strong>{{ $packages->count() }}</strong> curated packages in <strong>{{ $activeCategory->name }}</strong>
            @else
                Explore <strong>{{ $packages->count() }}</strong> unforgettable journeys across Bali's most breathtaking destinations
            @endif
        </p>
    </div>
</section>
{{-- ═══════════════════════════════════════════════════════ --}}
{{-- SECTION PAKET WISATA --}}
{{-- ═══════════════════════════════════════════════════════ --}}
@if ($packages->isNotEmpty())
<section id="tour-packages" class="py-20 bg-gray-50 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
            <div>
                <span class="text-orange-500 font-bold uppercase tracking-wider text-xs">Best Picks</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mt-1 mb-3 brand-font">
                    Featured Travel Packages
                </h2>
                <div class="w-16 h-1 bg-yellow-500 rounded-full"></div>
            </div>

            {{-- Filter Kategori --}}
            @if ($categories->isNotEmpty())
            <div class="flex flex-col gap-4 w-full md:w-auto">
                <div class="flex items-center gap-2 overflow-x-auto flex-nowrap pb-2 w-full [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
                    <button onclick="filterCategory('all')"
                        class="cat-btn active px-4 py-2 rounded-full text-sm font-semibold border transition-all duration-200 border-yellow-500 bg-yellow-500 text-white whitespace-nowrap flex-shrink-0"
                        data-cat="all">
                        All
                    </button>
                    @foreach ($categories as $cat)
                    <button onclick="filterCategory('{{ $cat->id }}')"
                        class="cat-btn px-4 py-2 rounded-full text-sm font-semibold border transition-all duration-200 border-gray-200 text-gray-600 hover:border-yellow-500 hover:text-yellow-600 whitespace-nowrap flex-shrink-0"
                        data-cat="{{ $cat->id }}">
                        {{ strtoupper($cat->name) }}
                    </button>
                    @endforeach
                </div>

                {{-- Sub Kategori (Muncul otomatis jika memilih kategori Oneday Tour) --}}
                @php
                    $onedayTourId = $categories->first(fn($c) => stripos($c->name, 'oneday') !== false)->id ?? null;
                @endphp
                
                @if ($onedayTourId)
                <div id="subCategoryFilters"
                    class="hidden items-center gap-2 overflow-x-auto flex-nowrap pb-2 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none] pl-4 sm:pl-8 w-full border-l-2 border-yellow-200"
                    data-parent-cat="{{ $onedayTourId }}">
                    @php
                        $subCategories = ['Ubud Tour', 'Kintamani Tour', 'Island Tour', 'South Bali', 'East Bali', 'North Bali', 'West Bali'];
                    @endphp
                    <button onclick="filterSubCategory('all')"
                        class="subcat-btn active px-4 py-2 rounded-full text-[10px] md:text-xs font-bold border transition-all duration-200 border-yellow-500 bg-yellow-500 text-white whitespace-nowrap flex-shrink-0"
                        data-subcat="all">
                        ALL TYPES
                    </button>
                    @foreach ($subCategories as $subCat)
                    <button onclick="filterSubCategory('{{ $subCat }}')"
                        class="subcat-btn px-4 py-2 rounded-full text-[10px] md:text-xs font-bold border transition-all duration-200 border-gray-200 text-gray-500 hover:border-yellow-500 hover:text-yellow-600 whitespace-nowrap flex-shrink-0"
                        data-subcat="{{ $subCat }}">
                        {{ strtoupper($subCat) }}
                    </button>
                    @endforeach
                </div>
                @endif
            </div>
            @endif
        </div>

        {{-- Grid Paket --}}
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-7" id="packagesGrid">
            @foreach ($packages as $package)
            <article
                class="package-card bg-white rounded-xl md:rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group flex flex-col"
                data-cat="{{ $package->tour_category_id }}" 
                data-subcat="{{ $package->sub_category ?? 'all' }}">

                {{-- Foto Section (BAGIAN YANG DIUBAH: Aspect Video & Object Contain) --}}
                <a href="{{ route('tour.show', $package) }}" class="flex items-center justify-center relative w-full aspect-video overflow-hidden bg-light">
                    @if ($package->thumbnail)
                        <img src="{{ $package->thumbnail_url }}" alt="{{ $package->title }}"
                            class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500">
                    @elseif ($package->images->isNotEmpty())
                        <img src="{{ $package->images->first()->image_url }}" alt="{{ $package->title }}"
                            class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center">
                            <i class="fas fa-image text-white text-4xl opacity-40"></i>
                        </div>
                    @endif

                    {{-- Badge Diskon --}}
                    @if ($package->discounted_price && $package->discounted_price < $package->price)
                        <span class="absolute top-2 right-2 md:top-3 md:right-3 bg-red-500 text-white text-[10px] md:text-xs font-bold px-2 py-0.5 md:px-3 md:py-1 rounded-full shadow">
                            Disc
                        </span>
                    @endif

                    {{-- Jumlah Foto --}}
                    @if($package->images->count() > 0)
                        <span class="absolute bottom-2 right-2 md:bottom-3 md:right-3 bg-black/50 text-white text-[10px] px-2 py-0.5 rounded flex items-center gap-1">
                            <i class="fas fa-images"></i> {{ $package->images->count() }}
                        </span>
                    @endif
                </a>

                {{-- Konten Section (TETAP) --}}
                <div class="p-3 md:p-5 flex-grow flex flex-col">
                    @if($package->duration)
                        <p class="text-[10px] md:text-xs text-gray-400 mb-1.5 flex items-center gap-1">
                            <i class="fas fa-clock"></i> {{ $package->duration }}
                        </p>
                    @endif

                    <h4 class="font-bold text-gray-800 text-sm md:text-base leading-snug mb-2 group-hover:text-yellow-600 transition-colors line-clamp-2 h-[2.8em] md:h-[3em]">
                        <a href="{{ route('tour.show', $package) }}">
                            {{ $package->title }}
                        </a>
                    </h4>

                    @if($package->description)
                        <p class="text-gray-500 text-[10px] md:text-sm leading-relaxed mb-4 line-clamp-2 italic">
                            {{ $package->description }}
                        </p>
                    @endif

                    <div class="mt-auto pt-3 border-t border-gray-100 flex items-end justify-between">
                        <div class="flex flex-col">
                            @php
                                $lowestPrice = collect([$package->price_2_4, $package->price_5_7, $package->price_8_14])
                                               ->filter(fn($p) => $p > 0)->min();
                            @endphp

                            @if($lowestPrice)
                                <span class="text-[9px] md:text-[10px] text-gray-400 uppercase font-semibold">Starts From</span>
                                <p class="text-sm md:text-lg font-bold text-yellow-700 leading-none">
                                    Rp {{ number_format($lowestPrice, 0, ',', '.') }}
                                </p>
                            @else
                                <p class="text-[10px] md:text-sm text-gray-400 italic">Contact Us</p>
                            @endif
                        </div>
                        
                        <a href="{{ route('tour.show', $package) }}"
                            class="inline-flex items-center bg-yellow-600 hover:bg-yellow-700 text-white text-[10px] md:text-sm font-semibold px-3 py-1.5 md:px-4 md:py-2 rounded-lg md:rounded-xl transition-all">
                            Details
                        </a>
                    </div>
                </div>

            </article>
            @endforeach
        </div>

        {{-- Empty State (JS handling) --}}
        <div id="emptyState" class="hidden text-center py-20">
            <i class="fas fa-search text-gray-300 text-5xl mb-4"></i>
            <p class="text-gray-500">No packages found for this category.</p>
        </div>

    </div>
</section>

{{-- JS UNTUK FILTER (Opsional jika Anda ingin filter instan tanpa reload) --}}
<script>
function filterCategory(catId) {
    // Update Button UI
    document.querySelectorAll('.cat-btn').forEach(btn => {
        btn.classList.remove('active', 'bg-yellow-500', 'text-white', 'border-yellow-500');
        btn.classList.add('border-gray-200', 'text-gray-600');
    });
    event.currentTarget.classList.add('active', 'bg-yellow-500', 'text-white', 'border-yellow-500');

    // Show/Hide Subcategory
    const subFilter = document.getElementById('subCategoryFilters');
    if(subFilter) {
        if(catId == subFilter.dataset.parentCat) {
            subFilter.classList.remove('hidden');
            subFilter.classList.add('flex');
        } else {
            subFilter.classList.add('hidden');
            subFilter.classList.remove('flex');
            filterSubCategory('all'); // Reset subcat if parent changed
        }
    }

    // Filter Cards
    const cards = document.querySelectorAll('.package-card');
    let visibleCount = 0;
    
    cards.forEach(card => {
        if(catId === 'all' || card.dataset.cat === catId) {
            card.style.display = 'flex';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });

    document.getElementById('emptyState').classList.toggle('hidden', visibleCount > 0);
}

function filterSubCategory(subName) {
    document.querySelectorAll('.subcat-btn').forEach(btn => {
        btn.classList.remove('active', 'bg-yellow-500', 'text-white', 'border-yellow-500');
        btn.classList.add('border-gray-200', 'text-gray-600');
    });
    event.currentTarget.classList.add('active', 'bg-yellow-500', 'text-white', 'border-yellow-500');

    const activeCatId = document.querySelector('.cat-btn.active').dataset.cat;
    const cards = document.querySelectorAll('.package-card');
    let visibleCount = 0;

    cards.forEach(card => {
        const matchCat = (activeCatId === 'all' || card.dataset.cat === activeCatId);
        const matchSub = (subName === 'all' || card.dataset.subcat === subName);
        
        if(matchCat && matchSub) {
            card.style.display = 'flex';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });
    
    document.getElementById('emptyState').classList.toggle('hidden', visibleCount > 0);
}
</script>
@endif

{{-- CTA --}}
<section class="bg-gradient-to-r from-yellow-600 to-orange-500 py-16">
    <div class="max-w-3xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-white mb-4 brand-font">Can't Find What You're Looking For?</h2>
        <p class="text-yellow-100 mb-8">
            Our travel experts are ready to craft a personalized Bali experience just for you — tell us your dream trip and we'll make it happen.
        </p>
        <a href="https://wa.me/628216087623"
           target="_blank"
           class="inline-flex items-center gap-3 bg-white text-yellow-700 hover:bg-yellow-50 font-bold px-8 py-4 rounded-full shadow-lg transition-all duration-200 hover:shadow-xl">
            <i class="fab fa-whatsapp text-green-500 text-xl"></i>
            Chat with Us on WhatsApp
        </a>
    </div>
</section>

@endsection
