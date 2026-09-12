{{-- resources/views/components/search-results.blade.php --}}
{{-- Usage: <x-search-results :query="$query" :packages="$packages" :categories="$categories" /> --}}

@props(['query', 'packages', 'categories'])

{{-- Hero --}}
<section class="relative bg-gradient-to-br from-yellow-700 via-orange-600 to-amber-500 pt-32 pb-16 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-72 h-72 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-20 w-96 h-96 bg-white rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-yellow-100 text-sm font-semibold uppercase tracking-widest mb-3">Search Results</p>
        <h1 class="text-3xl md:text-4xl font-bold text-white mb-4 brand-font">
            Results for <span class="text-yellow-300">"{{ $query }}"</span>
        </h1>
        <p class="text-yellow-100 text-base max-w-xl mx-auto">
            Found <strong>{{ $packages->count() }}</strong> {{ Str::plural('package', $packages->count()) }}
            @if($categories->isNotEmpty())
                and <strong>{{ $categories->count() }}</strong> {{ Str::plural('category', $categories->count()) }}
            @endif
        </p>
        <form action="{{ route('search') }}" method="GET" class="mt-8 max-w-xl mx-auto">
            <div class="flex items-center bg-white rounded-full overflow-hidden shadow-lg">
                <div class="pl-5 pr-3 text-gray-400"><i class="fas fa-search"></i></div>
                <input type="text" name="q" value="{{ $query }}"
                       class="w-full py-3.5 bg-transparent border-none focus:outline-none text-gray-700 text-sm font-medium"
                       placeholder="Search destinations, packages, activities...">
                <button type="submit"
                        class="bg-yellow-600 hover:bg-yellow-700 text-white px-7 py-3.5 font-semibold text-sm transition-colors whitespace-nowrap">
                    Search
                </button>
            </div>
        </form>
    </div>
</section>

{{-- Results --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($packages->isEmpty() && $categories->isEmpty())

            {{-- Empty state --}}
            <div class="text-center py-24">
                <div class="w-20 h-20 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-search text-yellow-500 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No results found for "{{ $query }}"</h3>
                <p class="text-gray-400 mb-8 max-w-md mx-auto">
                    Try different keywords like a destination name, activity type, or duration.
                </p>
                <div class="flex flex-wrap gap-3 justify-center mb-8">
                    @foreach(['Ubud', 'Beach', 'Waterfall', 'Sunset', 'Cultural', '1 Day', 'Adventure'] as $suggestion)
                    <a href="{{ route('search', ['q' => $suggestion]) }}"
                       class="px-4 py-2 bg-white border border-gray-200 rounded-full text-sm text-gray-600 hover:border-yellow-500 hover:text-yellow-600 transition-colors shadow-sm">
                        {{ $suggestion }}
                    </a>
                    @endforeach
                </div>
                <a href="{{ route('tour.index') }}"
                   class="inline-flex items-center gap-2 bg-yellow-600 hover:bg-yellow-700 text-white font-semibold px-6 py-3 rounded-full transition-colors">
                    <i class="fas fa-th-large text-sm"></i> Browse All Packages
                </a>
            </div>

        @else

            {{-- Matching Categories --}}
            @if($categories->isNotEmpty())
            <div class="mb-12">
                <h2 class="text-lg font-bold text-gray-700 mb-4 flex items-center gap-2">
                    <i class="fas fa-tag text-yellow-500"></i> Matching Categories
                </h2>
                <div class="flex flex-wrap gap-3">
                    @foreach($categories as $cat)
                    <a href="{{ route('tour.index', ['category' => $cat->slug]) }}"
                       class="flex items-center gap-2 bg-white border border-yellow-200 hover:border-yellow-500 hover:bg-yellow-50 px-5 py-2.5 rounded-full text-sm font-semibold text-yellow-700 transition-all shadow-sm">
                        <i class="fas fa-map-marker-alt text-xs"></i>
                        {{ $cat->name }}
                        <span class="bg-yellow-100 text-yellow-600 text-xs px-2 py-0.5 rounded-full ml-1">View all</span>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Package Results --}}
            @if($packages->isNotEmpty())
            <div>
                <h2 class="text-lg font-bold text-gray-700 mb-6 flex items-center gap-2">
                    <i class="fas fa-suitcase text-yellow-500"></i>
                    {{ $packages->count() }} {{ Str::plural('Package', $packages->count()) }} Found
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($packages as $package)
                    <article class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                        <a href="{{ route('tour.show', $package) }}" class="block relative overflow-hidden h-52">
                            @if($package->thumbnail)
                                <img src="{{ Storage::disk('public')->url($package->thumbnail) }}"
                                     alt="{{ $package->title }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @elseif($package->images->isNotEmpty())
                                <img src="{{ Storage::disk('public')->url($package->images->first()->image) }}"
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
                            <span class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow">SALE</span>
                            @endif
                            @if($package->images->count() > 0)
                            <span class="absolute bottom-3 right-3 bg-black/50 text-white text-xs px-2 py-1 rounded-lg flex items-center gap-1">
                                <i class="fas fa-images text-xs"></i> {{ $package->images->count() }}
                            </span>
                            @endif
                        </a>
                        <div class="p-5">
                            <div class="flex items-center gap-3 text-xs text-gray-400 mb-2">
                                @if($package->duration)
                                <span class="flex items-center gap-1"><i class="fas fa-clock"></i> {{ $package->duration }}</span>
                                @endif
                                @if($package->location)
                                <span class="flex items-center gap-1"><i class="fas fa-map-marker-alt"></i> {{ $package->location }}</span>
                                @endif
                            </div>
                            <h3 class="font-bold text-gray-800 text-base leading-snug mb-2 group-hover:text-yellow-600 transition-colors">
                                <a href="{{ route('tour.show', $package) }}">{{ $package->title }}</a>
                            </h3>
                            @if($package->description)
                            <p class="text-gray-500 text-sm leading-relaxed mb-4 line-clamp-2">{{ $package->description }}</p>
                            @endif
                            <div class="flex items-end justify-between pt-3 border-t border-gray-100">
                                <div>
                                    @if($package->discounted_price && $package->discounted_price < $package->price)
                                        <p class="text-xs text-gray-400 line-through">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                                        <p class="text-xl font-bold text-red-500">Rp {{ number_format($package->discounted_price, 0, ',', '.') }}</p>
                                    @elseif($package->price)
                                        <p class="text-xl font-bold text-yellow-700">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                                    @else
                                        <p class="text-sm text-gray-400 italic">Contact us for pricing</p>
                                    @endif
                                </div>
                                <a href="{{ route('tour.show', $package) }}"
                                   class="inline-flex items-center gap-2 bg-yellow-600 hover:bg-yellow-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors">
                                    View Details <i class="fas fa-arrow-right text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
            @endif

        @endif
    </div>
</section>