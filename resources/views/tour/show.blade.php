@extends('layouts.front')

{{-- ── Open Graph / SEO sections — populated from controller variables ── --}}
@section('og_title',       $ogTitle)
@section('og_description', $ogDescription)
@section('og_image',       $ogImage)
@section('og_url',         $ogUrl)
@section('og_type',        'article')

@push('styles')
<style>
    .gallery-thumb {
        cursor: pointer;
        transition: opacity .2s, transform .2s, border-color .2s;
    }

    .gallery-thumb:hover {
        opacity: .85;
    }

    .gallery-thumb.active {
        border-color: #f59e0b;
        opacity: 1;
    }

    .activity-card {
        background: linear-gradient(180deg, #ffffff 0%, #fffaf0 100%);
    }

    .line-through-price {
        text-decoration: line-through;
    }

    .pricing-display {
        font-family: 'Montserrat', sans-serif;
        letter-spacing: .01em;
    }

    .activities-pricing h2,
    .activities-pricing h3,
    .activities-pricing p {
        font-family: 'Montserrat', sans-serif;
    }

    #lightbox {
        display: none;
    }

    #lightbox.open {
        display: flex;
    }
</style>
@endpush

@section('content')
<div class="bg-white border-b border-gray-100 pt-24 pb-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-sm text-gray-400">
            <a href="{{ url('/') }}" class="hover:text-yellow-600 transition-colors">Home</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('tour.index') }}" class="hover:text-yellow-600 transition-colors">Tour Packages</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('tour.index', ['category' => $tourPackage->category->slug]) }}" class="hover:text-yellow-600 transition-colors">
                {{ $tourPackage->category->name }}
            </a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-gray-700 font-medium truncate max-w-xs">{{ $tourPackage->title }}</span>
        </nav>
    </div>
</div>

<section class="bg-gray-50 py-8 md:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 xl:gap-10">
            <div class="xl:col-span-2 space-y-6">
                @php
                    $allImages = collect();
                    if ($tourPackage->thumbnail) {
                        $allImages->push(['src' => $tourPackage->thumbnail_url, 'type' => 'thumbnail']);
                    }
                    foreach ($tourPackage->images as $img) {
                        $allImages->push(['src' => $img->image_url, 'type' => 'gallery']);
                    }
                @endphp

                @if($allImages->isNotEmpty())
                    <div class="overflow-hidden rounded-3xl bg-white shadow-md border border-gray-100">
                        <div class="relative w-full aspect-[16/10] bg-gray-100">
                            <img id="mainPhoto" src="{{ $allImages->first()['src'] }}" alt="{{ $tourPackage->title }}" class="h-full w-full object-cover cursor-zoom-in" onclick="openLightbox(0)">
                            @if($allImages->count() > 1)
                                <span class="absolute bottom-4 right-4 rounded-full bg-black/55 px-3 py-1 text-xs font-medium text-white backdrop-blur-sm">
                                    <i class="fas fa-images mr-1"></i> {{ $allImages->count() }} Photos
                                </span>
                            @endif
                        </div>

                        @if($allImages->count() > 1)
                            <div class="flex gap-3 overflow-x-auto border-t border-gray-100 bg-white p-3">
                                @foreach($allImages as $i => $img)
                                    <button type="button" onclick="switchPhoto('{{ $img['src'] }}', {{ $i }})" id="thumb-{{ $i }}" class="gallery-thumb h-20 w-24 shrink-0 overflow-hidden rounded-xl border-2 {{ $i === 0 ? 'border-yellow-500 active' : 'border-transparent' }}">
                                        <img src="{{ $img['src'] }}" alt="Foto {{ $i + 1 }}" class="h-full w-full object-cover">
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @else
                    <div class="flex aspect-[16/10] items-center justify-center rounded-3xl bg-gradient-to-br from-yellow-400 to-orange-500 shadow-md">
                        <i class="fas fa-image text-6xl text-white opacity-40"></i>
                    </div>
                @endif

                <div class="activity-card rounded-3xl border border-yellow-100 p-6 shadow-sm md:p-8">
                    <div class="mb-5 flex flex-wrap items-center gap-3">
                        <span class="rounded-full bg-yellow-100 px-3 py-1 text-[10px] font-bold uppercase tracking-[0.2em] text-yellow-700">
                            {{ $tourPackage->category?->name ?? 'Activity' }}
                        </span>
                        @if($tourPackage->rating)
                            <span class="inline-flex items-center gap-1 rounded-full bg-orange-50 px-3 py-1 text-sm font-semibold text-orange-600">
                                <i class="fas fa-star text-yellow-400"></i> {{ number_format($tourPackage->rating, 1) }}
                            </span>
                        @endif
                        @if($tourPackage->badge_label)
                            <span class="rounded-full border border-gray-200 bg-white px-3 py-1 text-xs font-medium text-gray-700">{{ $tourPackage->badge_label }}</span>
                        @endif
                    </div>
                    <h1 class="text-3xl font-black tracking-tight text-gray-900 md:text-4xl">{{ $tourPackage->title }}</h1>
                    @if($tourPackage->subtitle)
                        <p class="mt-3 text-lg text-gray-600">{{ $tourPackage->subtitle }}</p>
                    @endif
                    <div class="grid gap-3 text-sm text-gray-600 sm:grid-cols-3">
                        @if($tourPackage->duration)
                            <div class="rounded-2xl border border-gray-200 bg-white px-4 py-3">
                                <div class="mb-1 text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400">Duration</div>
                                <div class="font-semibold text-gray-800">{{ $tourPackage->duration }}</div>
                            </div>
                        @endif
                        @if($tourPackage->location)
                            <div class="rounded-2xl border border-gray-200 bg-white px-4 py-3">
                                <div class="mb-1 text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400">Location</div>
                                <div class="font-semibold text-gray-800">{{ $tourPackage->location }}</div>
                            </div>
                        @endif
                        @if($tourPackage->pickup_time)
                            <div class="rounded-2xl border border-gray-200 bg-white px-4 py-3">
                                <div class="mb-1 text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400">Pickup</div>
                                <div class="font-semibold text-gray-800">{{ $tourPackage->pickup_time }}</div>
                            </div>
                        @endif
                    </div>

                    @if($tourPackage->description)
                        <div class="mt-8 text-sm leading-7 text-gray-600">
                            {!! nl2br(e($tourPackage->description)) !!}
                        </div>
                    @endif
                </div>

                @if($tourPackage->price_1_pax || $tourPackage->price_2_4 || $tourPackage->price_5_7 || $tourPackage->price_8_14 || ($tourPackage->is_activity && ($tourPackage->tandem_price_2_4 || $tourPackage->tandem_price_5_7 || $tourPackage->tandem_price_8_14 || $tourPackage->activity_tandem_price)))
                    <div class="activities-pricing rounded-3xl border border-yellow-200 bg-gradient-to-br from-[#fffaf0] via-white to-slate-50 p-6 shadow-md md:p-8">
                        <div class="mb-5">
                            <h2 class="text-xl font-extrabold tracking-tight text-slate-900 md:text-2xl">{{ $tourPackage->is_activity ? 'Activities Pricing' : 'Tour Pricing' }}</h2>
                            <p class="mt-1 text-sm text-slate-600">Prices are based on total participants.</p>
                        </div>
                        @if($tourPackage->is_activity)
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="rounded-2xl border border-amber-200 bg-amber-50/70 p-5 shadow-sm">
                                <div class="flex items-center gap-3">
                                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-500 text-white shadow-sm">
                                        <i class="fas fa-motorcycle"></i>
                                    </span>
                                    <div>
                                        <h3 class="font-bold text-slate-900">Single Ride</h3>
                                        <p class="text-xs text-slate-600">1 participant</p>
                                    </div>
                                </div>
                            </div>
                            <div class="rounded-2xl border border-indigo-200 bg-indigo-50/70 p-5 shadow-sm">
                                <div class="flex items-center gap-3">
                                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-sm">
                                        <i class="fas fa-users"></i>
                                    </span>
                                    <div>
                                        <h3 class="font-bold text-slate-900">Tandem Ride</h3>
                                        <p class="text-xs text-slate-600">2 participants per tandem</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @php
                            $minimumBookingQuantity = $tourPackage->minimum_booking_quantity;
                            $pricingTiers = [];
                            if (filled($tourPackage->price_1_pax)) {
                                $pricingTiers[] = ['label' => '1 Pax', 'single' => $tourPackage->price_1_pax, 'tandem' => null];
                            }
                            if (filled($tourPackage->price_2_4) || ($tourPackage->is_activity && filled($tourPackage->tandem_price_2_4 ?? $tourPackage->activity_tandem_price))) {
                                $pricingTiers[] = [
                                    'label' => $tourPackage->is_activity ? '2-4 Pax' : ($minimumBookingQuantity > 1 ? $minimumBookingQuantity . '-4 Pax' : '2-4 Pax'),
                                    'single' => $tourPackage->price_2_4,
                                    'tandem' => $tourPackage->tandem_price_2_4 ?? $tourPackage->activity_tandem_price,
                                ];
                            }
                            $pricingTiers = array_merge($pricingTiers, [
                                ['label' => '5-7 Pax', 'single' => $tourPackage->price_5_7, 'tandem' => $tourPackage->tandem_price_5_7 ?? $tourPackage->activity_tandem_price],
                                ['label' => '8-14 Pax', 'single' => $tourPackage->price_8_14, 'tandem' => $tourPackage->tandem_price_8_14 ?? $tourPackage->activity_tandem_price],
                            ]);
                            $pricingTiers = array_values(array_filter(
                                $pricingTiers,
                                fn ($tier) => filled($tier['single']) || filled($tier['tandem'])
                            ));
                        @endphp
                        <div class="mt-5 overflow-hidden rounded-2xl border border-slate-200 bg-white sm:hidden">
                            <table class="w-full table-fixed text-left">
                                <thead class="bg-slate-50">
                                    <tr class="border-b border-slate-200">
                                        <th scope="col" class="{{ $tourPackage->is_activity ? 'w-1/4' : 'w-1/2' }} px-3 py-3 text-[10px] font-bold uppercase tracking-wider text-slate-600 sm:px-4 sm:text-xs">Pax</th>
                                        <th scope="col" class="{{ $tourPackage->is_activity ? 'w-[37.5%]' : 'w-1/2' }} px-3 py-3 text-[10px] font-bold uppercase tracking-wider text-amber-700 sm:px-4 sm:text-xs">{{ $tourPackage->is_activity ? 'Single' : 'Price / person' }}</th>
                                        @if($tourPackage->is_activity)<th scope="col" class="w-[37.5%] px-3 py-3 text-[10px] font-bold uppercase tracking-wider text-indigo-700 sm:px-4 sm:text-xs">Tandem</th>@endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pricingTiers as $tier)
                                        <tr class="border-b border-slate-100 last:border-b-0">
                                            <th scope="row" class="px-3 py-4 text-sm font-bold text-slate-900 sm:px-4 sm:text-base">{{ $tier['label'] }}</th>
                                            <td class="px-3 py-4 sm:px-4">
                                                @if($tier['single'])
                                                    <span class="pricing-display text-sm font-black text-[#0A2240] sm:text-lg">Rp {{ number_format($tier['single'], 0, ',', '.') }}</span>
                                                @else
                                                    <span class="text-xs italic text-slate-400 sm:text-sm">Contact us</span>
                                                @endif
                                            </td>
                                            @if($tourPackage->is_activity)
                                            <td class="px-3 py-4 sm:px-4">
                                                @if($tier['tandem'])
                                                    <span class="pricing-display text-sm font-black text-[#0A2240] sm:text-lg">Rp {{ number_format($tier['tandem'], 0, ',', '.') }}</span>
                                                @else
                                                    <span class="text-xs italic text-slate-400 sm:text-sm">Contact us</span>
                                                @endif
                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-5 hidden overflow-hidden rounded-2xl border border-slate-200 bg-white sm:block">
                            <div class="grid grid-cols-4 border-b border-slate-200 bg-slate-50">
                                @foreach($pricingTiers as $tier)
                                    <div class="border-r border-slate-200 p-4 last:border-r-0">
                                        <h3 class="font-bold tracking-tight text-slate-900">{{ $tier['label'] }}</h3>
                                    </div>
                                @endforeach
                            </div>
                            <div class="grid grid-cols-4">
                                @foreach($pricingTiers as $tier)
                                    <div class="border-r border-slate-200 p-4 last:border-r-0">
                                        <p class="text-[10px] font-bold uppercase tracking-wider text-amber-700">{{ $tourPackage->is_activity ? 'Single / person' : 'Price / person' }}</p>
                                        @if($tier['single'])
                                            <p class="pricing-display mt-2 text-xl font-black text-[#0A2240]">Rp {{ number_format($tier['single'], 0, ',', '.') }}</p>
                                        @else
                                            <p class="mt-2 text-sm italic text-slate-400">Contact us</p>
                                        @endif
                                        @if($tourPackage->is_activity)
                                            <p class="mt-4 text-[10px] font-bold uppercase tracking-wider text-indigo-700">Tandem / person</p>
                                            @if($tier['tandem'])
                                                <p class="pricing-display mt-2 text-xl font-black text-[#0A2240]">Rp {{ number_format($tier['tandem'], 0, ',', '.') }}</p>
                                            @else
                                                <p class="mt-2 text-sm italic text-slate-400">Contact us</p>
                                            @endif
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <p class="mt-4 text-xs font-medium text-slate-500">Minimum booking: {{ $minimumBookingQuantity }} pax{{ $tourPackage->is_activity ? '. Each tandem unit carries 2 participants.' : '.' }}</p>
                    </div>
                @endif

                @if($tourPackage->highlights)
                    <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-100 md:p-8">
                        <h2 class="mb-5 flex items-center gap-3 text-xl font-extrabold text-gray-900">
                            <span class="h-6 w-1.5 rounded-full bg-yellow-500"></span>
                            Highlights
                        </h2>
                        <div class="space-y-3">
                            @foreach(explode("\n", str_replace("\r", "", $tourPackage->highlights)) as $line)
                                @php $line = trim($line); @endphp
                                @if($line)
                                    <div class="flex items-start gap-3 rounded-2xl bg-yellow-50/60 px-4 py-3 text-sm text-gray-700">
                                        <span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-full bg-yellow-500 text-xs font-bold text-white">✓</span>
                                        <span>{{ $line }}</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($tourPackage->itinerary)
                    <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-100 md:p-8">
                        <h2 class="mb-5 flex items-center gap-3 text-xl font-extrabold text-gray-900">
                            <span class="h-6 w-1.5 rounded-full bg-indigo-500"></span>
                            itinerary
                        </h2>
                        <div class="space-y-3">
                            @foreach(explode("\n", str_replace("\r", "", $tourPackage->itinerary)) as $line)
                                @php $line = trim($line); @endphp
                                @if($line)
                                    <div class="flex items-start gap-3 rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700">
                                        <span class="mt-0.5 flex h-6 w-6 items-center justify-center rounded-full bg-indigo-100 text-[10px] font-bold text-indigo-700">•</span>
                                        <span>{{ $line }}</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="grid gap-6 md:grid-cols-2">
                    @if($tourPackage->includes)
                        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-100 md:p-8">
                            <h2 class="mb-5 flex items-center gap-3 text-xl font-extrabold text-gray-900">
                                <span class="h-6 w-1.5 rounded-full bg-emerald-500"></span>
                                Include
                            </h2>
                            <div class="space-y-3">
                                @foreach(explode("\n", str_replace("\r", "", $tourPackage->includes)) as $line)
                                    @php $line = trim($line); @endphp
                                    @if($line)
                                        <div class="flex items-start gap-3 text-sm text-gray-700">
                                            <span class="mt-0.5 text-emerald-500">✓</span>
                                            <span>{{ $line }}</span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($tourPackage->excludes)
                        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-100 md:p-8">
                            <h2 class="mb-5 flex items-center gap-3 text-xl font-extrabold text-gray-900">
                                <span class="h-6 w-1.5 rounded-full bg-red-500"></span>
                                Exclude
                            </h2>
                            <div class="space-y-3">
                                @foreach(explode("\n", str_replace("\r", "", $tourPackage->excludes)) as $line)
                                    @php $line = trim($line); @endphp
                                    @if($line)
                                        <div class="flex items-start gap-3 text-sm text-gray-700">
                                            <span class="mt-0.5 text-red-500">×</span>
                                            <span>{{ $line }}</span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                @if($tourPackage->terms)
                    <div class="border-t border-gray-100 pt-8">
                        <h2 class="mb-4 text-lg font-bold text-gray-800">Terms & Conditions</h2>
                        <div class="space-y-2 text-sm italic text-gray-500">
                            {!! nl2br(e($tourPackage->terms)) !!}
                        </div>
                    </div>
                @endif
            </div>

            <aside class="lg:sticky lg:top-24" style="align-self:start;">
                <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white p-5 shadow-lg md:p-6">
                    <div class="mb-5 flex items-center justify-between">
                        <span class="rounded-full bg-yellow-100 px-3 py-1 text-[10px] font-bold uppercase tracking-[0.2em] text-yellow-700">
                            Best Price
                        </span>
                        @if($tourPackage->rating)
                            <span class="inline-flex items-center gap-1 text-sm font-semibold text-orange-500">
                                <i class="fas fa-star text-yellow-400"></i> {{ number_format($tourPackage->rating, 1) }}
                            </span>
                        @endif
                    </div>

                    @php
                        $minimumBookingQuantity = $tourPackage->minimum_booking_quantity;
                        $priceList = collect([
                            $tourPackage->price_1_pax,
                            $tourPackage->price_2_4,
                            $tourPackage->price_5_7,
                            $tourPackage->price_8_14,
                        ])->filter(fn($p) => $p > 0);
                        $lowestPrice = $priceList->min();
                    @endphp

                    <div class="mb-5">
                        <div class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400">Starts from</div>
                        @if($lowestPrice)
                            <div class="mt-2 flex items-end gap-2">
                                <span class="text-3xl font-black tracking-tight text-yellow-700 md:text-4xl">Rp {{ number_format($lowestPrice, 0, ',', '.') }}</span>
                                <span class="pb-1 text-sm text-gray-500">/ person</span>
                            </div>
                        @else
                            <div class="mt-2 text-lg font-semibold text-gray-500">Contact us</div>
                        @endif
                    </div>

                    <div class="mb-5 space-y-3 rounded-2xl bg-gray-50 p-4 text-sm text-gray-600">
                        @if($tourPackage->duration)
                            <div class="flex items-center gap-3">
                                <i class="fas fa-clock text-yellow-500"></i>
                                <span>{{ $tourPackage->duration }}</span>
                            </div>
                        @endif
                        @if($tourPackage->location)
                            <div class="flex items-center gap-3">
                                <i class="fas fa-map-marker-alt text-indigo-500"></i>
                                <span>{{ $tourPackage->location }}</span>
                            </div>
                        @endif
                        @if($tourPackage->pickup_time)
                            <div class="flex items-center gap-3">
                                <i class="fas fa-route text-emerald-500"></i>
                                <span>{{ $tourPackage->pickup_time }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="space-y-3">
                        <a href="{{ route('checkout.index', $tourPackage) }}" class="flex w-full items-center justify-center gap-2 rounded-2xl bg-blue-950 px-5 py-3.5 text-base font-bold text-white shadow-sm transition hover:bg-blue-900">
                            <i class="fas fa-shopping-cart"></i>
                            Book Now
                        </a>
                        <a href="https://wa.me/6281266718008?text={{ urlencode('Hello, I am interested in the ' . $tourPackage->title) }}" target="_blank" class="flex w-full items-center justify-center gap-2 rounded-2xl border border-green-500 px-5 py-3 text-base font-bold text-green-600 transition hover:bg-green-50">
                            <i class="fab fa-whatsapp"></i>
                            WhatsApp
                        </a>
                    </div>

                    <div class="mt-5 rounded-2xl border border-dashed border-yellow-300 bg-yellow-50 p-4 text-sm text-yellow-800">
                        <div class="font-bold">Why travelers choose this</div>
                        <ul class="mt-2 space-y-2 text-xs leading-6">
                            <li>• Instant booking confirmation</li>
                            <li>• Local guide and flexible pickup</li>
                            <li>• Family-friendly and custom group options</li>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════ --}}
{{-- SECTION PAKET TERKAIT --}}
{{-- ═══════════════════════════════════════════════════ --}}
@if($related->isNotEmpty())
<section class="py-14 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <h2 class="text-xl md:text-2xl font-bold text-gray-800 brand-font mb-6 md:mb-8 text-center md:text-left">
            Other Packages <span class="text-yellow-600">{{ $tourPackage->category->name }}</span>
        </h2>

        <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-7">
            @foreach($related as $pkg)
            <article class="bg-gray-50 rounded-xl md:rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 group flex flex-col">
                
                <a href="{{ route('tour.show', $pkg) }}" class="block relative h-36 md:h-52 overflow-hidden">
                    @if($pkg->thumbnail)
                        <img src="{{ $pkg->thumbnail_url }}" alt="{{ $pkg->title }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @elseif($pkg->images->isNotEmpty())
                        <img src="{{ $pkg->images->first()->image_url }}" alt="{{ $pkg->title }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-yellow-300 to-orange-400 flex items-center justify-center">
                            <i class="fas fa-image text-white text-3xl opacity-40"></i>
                        </div>
                    @endif

                    @if($pkg->discounted_price && $pkg->discounted_price < $pkg->price)
                        <span class="absolute top-2 right-2 bg-red-500 text-white text-[10px] md:text-xs font-bold px-2 py-0.5 rounded-full shadow-sm">
                            Disc
                        </span>
                    @endif
                </a>

                <div class="p-3 md:p-5 flex flex-col flex-grow">
                    @if($pkg->duration)
                        <p class="text-[10px] md:text-xs text-gray-400 mb-1 flex items-center gap-1">
                            <i class="fas fa-clock"></i> {{ $pkg->duration }}
                        </p>
                    @endif

                    <h3 class="font-bold text-gray-800 text-xs md:text-base leading-snug mb-1.5 group-hover:text-yellow-600 transition-colors line-clamp-2 h-[2.6em] md:h-[3em]">
                        <a href="{{ route('tour.show', $pkg) }}">
                            {{ $pkg->title }}
                        </a>
                    </h3>

                    @if($pkg->description)
                        <p class="text-gray-500 text-[10px] md:text-sm leading-relaxed mb-3 md:mb-4 line-clamp-2">
                            {{ $pkg->description }}
                        </p>
                    @endif

                    <div class="mt-auto flex items-center justify-between pt-3 border-t border-gray-200/60">
                        <div class="flex flex-col">
                            @php
                                $allRelPrices = collect([
                                    $pkg->price_2_4,
                                    $pkg->price_5_7,
                                    $pkg->price_8_14
                                ])->filter(fn($price) => $price > 0);

                                $lowestRelPrice = $allRelPrices->min();
                            @endphp

                            @if($lowestRelPrice)
                                <span class="text-[9px] md:text-[10px] text-gray-400 uppercase font-bold -mb-1">
                                    Starts From
                                </span>
                                <p class="text-xs md:text-lg font-bold text-yellow-700 leading-tight">
                                    Rp {{ number_format($lowestRelPrice, 0, ',', '.') }}
                                </p>
                            @else
                                <p class="text-[10px] md:text-sm text-gray-400 italic font-medium">Get in Touch</p>
                            @endif
                        </div>
                        
                        <a href="{{ route('tour.show', $pkg) }}"
                            class="text-[10px] md:text-xs bg-yellow-600 hover:bg-yellow-700 text-white font-semibold px-2 py-1.5 md:px-3 md:py-2 rounded-lg transition-colors">
                            Details
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════ --}}
{{-- LIGHTBOX --}}
{{-- ═══════════════════════════════════════════════════ --}}
<div id="lightbox" class="fixed inset-0 z-50 bg-black/90 items-center justify-center p-4"
    onclick="closeLightbox(event)">
    <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white text-3xl hover:text-yellow-400 z-10">
        <i class="fas fa-times"></i>
    </button>
    <button onclick="prevPhoto()"
        class="absolute left-4 top-1/2 -translate-y-1/2 text-white text-3xl hover:text-yellow-400 z-10 px-3 py-2">
        <i class="fas fa-chevron-left"></i>
    </button>
    <button onclick="nextPhoto()"
        class="absolute right-4 top-1/2 -translate-y-1/2 text-white text-3xl hover:text-yellow-400 z-10 px-3 py-2">
        <i class="fas fa-chevron-right"></i>
    </button>
    <img id="lightboxImg" src="" alt="" class="max-w-full max-h-[85vh] object-contain rounded-xl shadow-2xl"
        onclick="event.stopPropagation()">
    <p id="lightboxCounter" class="absolute bottom-4 left-1/2 -translate-x-1/2 text-white/60 text-sm"></p>
</div>

@endsection

@push('scripts')
<script>
    // ── Thumbnail switch ──────────────────────────────
    let currentIndex = 0;
    const photos = @json($allImages -> pluck('src'));
    const totalPhotos = photos.length;

    function switchPhoto(src, index) {
        document.getElementById('mainPhoto').src = src;
        currentIndex = index;

        document.querySelectorAll('.gallery-thumb').forEach((el, i) => {
            el.classList.toggle('border-yellow-500', i === index);
            el.classList.toggle('border-transparent', i !== index);
        });
    }

    // ── Lightbox ─────────────────────────────────────
    function openLightbox(index) {
        currentIndex = index;
        document.getElementById('lightbox').classList.add('open');
        updateLightbox();
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox(e) {
        if (e && e.target !== document.getElementById('lightbox')) return;
        document.getElementById('lightbox').classList.remove('open');
        document.body.style.overflow = '';
    }

    function updateLightbox() {
        document.getElementById('lightboxImg').src = photos[currentIndex];
        document.getElementById('lightboxCounter').textContent = `${currentIndex + 1} / ${totalPhotos}`;
    }

    function prevPhoto() {
        currentIndex = (currentIndex - 1 + totalPhotos) % totalPhotos;
        updateLightbox();
        switchPhoto(photos[currentIndex], currentIndex);
    }

    function nextPhoto() {
        currentIndex = (currentIndex + 1) % totalPhotos;
        updateLightbox();
        switchPhoto(photos[currentIndex], currentIndex);
    }

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (!document.getElementById('lightbox').classList.contains('open')) return;
        if (e.key === 'ArrowLeft') prevPhoto();
        if (e.key === 'ArrowRight') nextPhoto();
        if (e.key === 'Escape') closeLightbox();
    });
</script>
@endpush