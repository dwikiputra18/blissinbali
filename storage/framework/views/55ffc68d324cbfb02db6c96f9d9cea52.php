<?php $__env->startSection('title', 'Bliss in Bali'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.hero-slider', ['banners' => $banners], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

Kode yang kamu tampilkan memiliki **2 ukuran card** utama:

1. **Hero Card (Ukuran Besar)**: Card pilihan utama yang mengambil lebar 2 kolom dan 2 baris grid desktop (`col-span-2 lg:row-span-2`).
2. **Remaining Card (Ukuran Kecil / Standar)**: Card destinasi lainnya yang hanya mengambil 1 kolom grid (`col-span-1`).

---

### Perbaikan Kode

Untuk mengatasi masalah gambar pamflet/banner (seperti *"LOVINA SUNRISE"*) yang tulisan kiri-kanannya terpotong, kita menyesuaikan rasio aspek wadah gambarnya di card kecil menjadi **`aspect-[16/10]`** (lebih proporsional untuk banner) dan mengganti `object-cover` menjadi **`object-contain`** dengan latar belakang gelap. Dengan cara ini, seluruh gambar dan teks di dalamnya akan tampil utuh 100% tanpa ada yang terpotong.

Berikut kode lengkapnya yang sudah diperbaiki:

```html
<section id="destinasi" class="py-20 relative overflow-hidden bg-[#dff3e8]">
    
    
    <div class="absolute inset-0 pointer-events-none bg-repeat bg-center" 
         style="background-color: #d8f3dc;">
    </div>

    
    <div class="absolute inset-0 bg-gradient-to-b from-[#effaf3]/70 via-transparent to-[#d2ecdf]/80 pointer-events-none"></div>

    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <?php
            $destinationPackages = $featuredPackages->take(9)->values();
            $heroTitle = 'Ubud ATV & Ayung Rafting Experience';
            $heroPackage = $destinationPackages->first(fn ($package) => $package->title === $heroTitle)
                ?? $destinationPackages->first();
            $remainingPackages = $destinationPackages
                ->reject(fn ($package) => $heroPackage && $package->id === $heroPackage->id)
                ->values();
        ?>

        
        <div class="destination-grid grid grid-cols-2 lg:grid-cols-4 lg:grid-rows-[auto_1fr_1fr] gap-3 lg:gap-6 items-stretch">
            
            
            <div class="col-span-2 lg:col-span-2 lg:col-start-2 lg:row-start-1 flex flex-col justify-center items-center text-center max-w-2xl mx-auto mb-6 lg:mb-4 lg:py-4">
                <span class="text-indigo-600 font-bold uppercase tracking-wider text-[10px] lg:text-xs mb-1">The best picks from locals</span>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gray-900 mb-3 brand-font">Popular Destinations</h2>
                <div class="w-12 h-1 bg-yellow-500 mb-4 rounded-full"></div>
                <p class="text-gray-600 text-xs lg:text-sm leading-relaxed max-w-md mx-auto mb-6">
                    Uncover the wonders of Bali—from its sun-drenched white sands to the misty, emerald highlands.
                </p>
                <a href="<?php echo e(route('tour.index')); ?>"
                    class="inline-block bg-indigo-600 text-white font-semibold py-2.5 px-8 rounded-full text-xs lg:text-sm hover:bg-indigo-700 transition-colors shadow-md hover:shadow-lg">
                    See More
                </a>
            </div>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($heroPackage): ?>
            <?php
                $package = $heroPackage;
            ?>
            <article class="package-card col-span-2 lg:col-span-2 lg:col-start-2 lg:row-start-2 lg:row-span-2 bg-white/90 backdrop-blur-sm rounded-xl lg:rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group flex flex-col">

                
                <a href="<?php echo e(route('tour.show', $package)); ?>" class="flex items-center justify-center relative w-full aspect-video lg:aspect-auto lg:flex-1 overflow-hidden bg-gray-900">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->thumbnail): ?>
                    <img src="<?php echo e($package->thumbnail_url); ?>" alt="<?php echo e($package->title); ?>" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-700">
                    <?php elseif($package->images->isNotEmpty()): ?>
                    <img src="<?php echo e($package->images->first()->image_url); ?>" alt="<?php echo e($package->title); ?>" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-700">
                    <?php else: ?>
                    <div class="w-full h-full bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center">
                        <i class="fas fa-image text-white text-4xl opacity-40"></i>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->discounted_price && $package->discounted_price < $package->price): ?>
                    <span class="absolute top-4 right-4 bg-red-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">Disc</span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </a>

                
                <div class="p-4 lg:p-6 flex flex-col bg-white/95">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->duration): ?>
                    <p class="text-xs font-medium text-gray-500 mb-2 flex items-center gap-1.5">
                        <i class="fas fa-clock text-gray-400"></i> <?php echo e($package->duration); ?>

                    </p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <h4 class="font-bold text-gray-900 text-lg lg:text-2xl leading-tight mb-2 group-hover:text-yellow-600 transition-colors">
                        <a href="<?php echo e(route('tour.show', $package)); ?>" class="block"><?php echo e($package->title); ?></a>
                    </h4>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->description): ?>
                    <p class="text-gray-500 text-xs lg:text-sm mb-4 lg:mb-6 line-clamp-2">
                        <?php echo e($package->description); ?>

                    </p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <div class="flex items-end justify-between pt-3 lg:pt-4 border-t border-gray-100 mt-auto">
                        <div class="flex flex-col">
                            <?php
                                $allPrices = collect([$package->price_2_4, $package->price_5_7, $package->price_8_14])->filter(fn($price) => $price > 0);
                                $lowestPrice = $allPrices->min();
                            ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($lowestPrice): ?>
                            <span class="text-[10px] lg:text-xs text-gray-400 uppercase font-semibold mb-0.5">Starts From</span>
                            <p class="text-base lg:text-2xl font-bold text-yellow-700 leading-none">Rp <?php echo e(number_format($lowestPrice, 0, ',', '.')); ?></p>
                            <?php else: ?>
                            <p class="text-xs lg:text-sm text-gray-400 italic">Get in Touch</p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <a href="<?php echo e(route('tour.show', $package)); ?>" class="inline-flex items-center bg-yellow-600 hover:bg-yellow-700 text-white text-[10px] lg:text-sm font-semibold px-4 py-1.5 lg:px-6 lg:py-2.5 rounded-lg lg:rounded-xl transition-colors shadow-sm">Details</a>
                    </div>
                </div>
            </article>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $remainingPackages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <?php
                $slotClass = match ($loop->index) {
                    0 => 'lg:col-start-3 lg:row-start-2',
                    1 => 'lg:col-start-4 lg:row-start-2',
                    2 => 'lg:col-start-3 lg:row-start-3',
                    3 => 'lg:col-start-4 lg:row-start-3',
                    4 => 'lg:col-start-1 lg:row-start-4',
                    5 => 'lg:col-start-2 lg:row-start-4',
                    6 => 'lg:col-start-3 lg:row-start-4',
                    default => 'lg:col-start-4 lg:row-start-4',
                };
            ?>
            <article class="package-card <?php echo e($slotClass); ?> col-span-1 bg-white/90 backdrop-blur-sm rounded-xl lg:rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group flex flex-col">

                
                <a href="<?php echo e(route('tour.show', $package)); ?>" class="flex items-center justify-center relative w-full aspect-[16/10] overflow-hidden bg-gray-900">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->thumbnail): ?>
                    <img src="<?php echo e($package->thumbnail_url); ?>" alt="<?php echo e($package->title); ?>" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500">
                    <?php elseif($package->images->isNotEmpty()): ?>
                    <img src="<?php echo e($package->images->first()->image_url); ?>" alt="<?php echo e($package->title); ?>" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500">
                    <?php else: ?>
                    <div class="w-full h-full bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center">
                        <i class="fas fa-image text-white text-3xl opacity-40"></i>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->discounted_price && $package->discounted_price < $package->price): ?>
                    <span class="absolute top-2 right-2 lg:top-3 lg:right-3 bg-red-500 text-white text-[9px] lg:text-xs font-bold px-2 py-0.5 lg:px-2.5 lg:py-1 rounded-full shadow">Disc</span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </a>

                <div class="p-2.5 lg:p-4 flex flex-col flex-grow bg-white/95">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->duration): ?>
                    <p class="text-[9px] lg:text-xs font-medium text-gray-500 mb-1 lg:mb-1.5 flex items-center gap-1">
                        <i class="fas fa-clock text-gray-400"></i> <?php echo e($package->duration); ?>

                    </p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <h4 class="font-bold text-gray-900 text-[11px] lg:text-base leading-snug mb-1 lg:mb-2 group-hover:text-yellow-600 transition-colors line-clamp-2 h-[2.8em] flex items-start overflow-hidden">
                        <a href="<?php echo e(route('tour.show', $package)); ?>" class="block"><?php echo e($package->title); ?></a>
                    </h4>

                    
                    <div class="hidden lg:block">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->description): ?>
                        <p class="text-gray-500 text-xs mb-4 line-clamp-2"><?php echo e($package->description); ?></p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="flex items-end justify-between pt-2 lg:pt-3 border-t border-gray-100 mt-auto">
                        <div class="flex flex-col">
                            <?php
                                $allPrices = collect([$package->price_2_4, $package->price_5_7, $package->price_8_14])->filter(fn($price) => $price > 0);
                                $lowestPrice = $allPrices->min();
                            ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($lowestPrice): ?>
                            <span class="text-[8px] lg:text-[10px] text-gray-400 uppercase font-semibold mb-0.5">Starts From</span>
                            <p class="text-[11px] lg:text-base font-bold text-yellow-700 leading-none">Rp <?php echo e(number_format($lowestPrice, 0, ',', '.')); ?></p>
                            <?php else: ?>
                            <p class="text-[9px] lg:text-sm text-gray-400 italic">Get in Touch</p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <a href="<?php echo e(route('tour.show', $package)); ?>" class="inline-flex items-center bg-yellow-600 hover:bg-yellow-700 text-white text-[9px] lg:text-xs font-semibold px-2 py-1 lg:px-3 lg:py-1.5 rounded lg:rounded-lg transition-colors shadow-sm">Details</a>
                    </div>
                </div>
            </article>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

        </div>
    </div>
</section>




<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($featuredPackages->isNotEmpty()): ?>
<section id="tour-packages" class="py-20 bg-gray-50 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
            <div>
                <span class="text-orange-500 font-bold uppercase tracking-wider text-xs">Best Picks</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mt-1 mb-3 brand-font">Featured Travel Packages</h2>
                <div class="w-16 h-1 bg-yellow-500 rounded-full"></div>
            </div>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($categories->isNotEmpty()): ?>
            <div class="flex flex-col gap-4">
                <div class="flex items-center gap-2 overflow-x-auto flex-nowrap pb-2 w-full [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
                    <button onclick="filterCategory('all')" class="cat-btn active px-4 py-2 rounded-full text-sm font-semibold border transition-all duration-200 border-yellow-500 bg-yellow-500 text-white whitespace-nowrap flex-shrink-0" data-cat="all">All</button>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <button onclick="filterCategory('<?php echo e($cat->id); ?>')" class="cat-btn px-4 py-2 rounded-full text-sm font-semibold border transition-all duration-200 border-gray-200 text-gray-600 hover:border-yellow-500 hover:text-yellow-600 whitespace-nowrap flex-shrink-0" data-cat="<?php echo e($cat->id); ?>"><?php echo e(strtoupper($cat->name)); ?></button>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>

                <?php
                $onedayTourId = $categories->first(fn($c) => stripos($c->name, 'oneday') !== false)->id ?? null;
                ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($onedayTourId): ?>
                <div id="subCategoryFilters" class="hidden items-center gap-2 overflow-x-auto flex-nowrap pb-2 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none] pl-6 sm:pl-12 w-full" data-parent-cat="<?php echo e($onedayTourId); ?>">
                    <?php $subCategories = ['Ubud Tour', 'Kintamani Tour', 'Island Tour', 'South Bali', 'East Bali', 'North Bali', 'West Bali']; ?>
                    <button onclick="filterSubCategory('all')" class="subcat-btn active px-4 py-2 rounded-full text-sm font-semibold border transition-all duration-200 border-yellow-500 bg-yellow-500 text-white whitespace-nowrap flex-shrink-0" data-subcat="all">All</button>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <button onclick="filterSubCategory('<?php echo e($subCat); ?>')" class="subcat-btn px-4 py-2 rounded-full text-sm font-semibold border transition-all duration-200 border-gray-200 text-gray-600 hover:border-yellow-500 hover:text-yellow-600 whitespace-nowrap flex-shrink-0" data-subcat="<?php echo e($subCat); ?>"><?php echo e($subCat); ?></button>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-7" id="packagesGrid">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $allPackages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <article
                class="package-card bg-white rounded-xl md:rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group flex flex-col"
                data-cat="<?php echo e($package->tour_category_id); ?>" data-subcat="<?php echo e($package->sub_category ?? 'all'); ?>">

                
                <a href="<?php echo e(route('tour.show', $package)); ?>" class="flex items-center justify-center relative w-full aspect-video overflow-hidden bg-light">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->thumbnail): ?>
                    <img src="<?php echo e($package->thumbnail_url); ?>" alt="<?php echo e($package->title); ?>" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500">
                    <?php elseif($package->images->isNotEmpty()): ?>
                    <img src="<?php echo e($package->images->first()->image_url); ?>" alt="<?php echo e($package->title); ?>" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500">
                    <?php else: ?>
                    <div class="w-full h-full bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center">
                        <i class="fas fa-image text-white text-4xl opacity-40"></i>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->discounted_price && $package->discounted_price < $package->price): ?>
                    <span class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow">Disc</span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </a>

                
                <div class="p-2 md:p-5 flex flex-col flex-grow">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->duration): ?>
                    <p class="text-xs text-gray-400 mb-1.5 flex items-center gap-1">
                        <i class="fas fa-clock"></i> <?php echo e($package->duration); ?>

                    </p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <h4 class="font-bold text-gray-800 text-xs md:text-base leading-snug mb-1 group-hover:text-yellow-600 transition-colors line-clamp-2 h-[2.6em] md:h-[3em] flex items-start overflow-hidden">
                        <a href="<?php echo e(route('tour.show', $package)); ?>" class="block"><?php echo e($package->title); ?></a>
                    </h4>

                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->description): ?>
                    <p class="text-gray-500 text-[10px] md:text-xs mb-4 line-clamp-2 italic">
                        <?php echo e($package->description); ?>

                    </p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <div class="flex items-end justify-between pt-2 md:pt-3 border-t border-gray-100 mt-auto">
                        <div>
                            <div class="flex flex-col">
                                <?php
                                    $allPrices = collect([$package->price_2_4, $package->price_5_7, $package->price_8_14])->filter(fn($price) => $price > 0);
                                    $lowestPrice = $allPrices->min();
                                ?>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($lowestPrice): ?>
                                <span class="text-[9px] md:text-[10px] text-gray-400 uppercase font-semibold -mb-1">Starts From</span>
                                <p class="text-xs md:text-lg font-bold text-yellow-700 leading-tight">Rp <?php echo e(number_format($lowestPrice, 0, ',', '.')); ?></p>
                                <?php else: ?>
                                <p class="text-[10px] md:text-sm text-gray-400 italic">Get in Touch</p>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                        <a href="<?php echo e(route('tour.show', $package)); ?>" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white text-[10px] md:text-sm font-semibold px-2 py-1 md:px-4 md:py-2 rounded-lg md:rounded-xl transition-colors">Details</a>
                    </div>
                </div>
            </article>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>

        
        <div class="text-center mt-12">
            <a href="<?php echo e(route('tour.index')); ?>" class="inline-flex items-center gap-2 border-2 border-yellow-600 text-yellow-700 hover:bg-yellow-600 hover:text-white font-bold px-8 py-3.5 rounded-full transition-all duration-200">
                See More <i class="fas fa-arrow-right text-sm"></i>
            </a>
        </div>
    </div>
</section>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-12">
            <div>
                <span class="text-orange-500 font-bold uppercase tracking-wider text-xs">Our Packages Activities</span>
                <h2 class="text-3xl md:text-5xl font-extrabold text-gray-900 mt-2 mb-3 brand-font">Explore Bali With Us</h2>
                <div class="w-16 h-1 bg-yellow-500 rounded-full"></div>
            </div>
            <a href="<?php echo e(route('tour.index')); ?>" class="inline-flex items-center gap-2 text-sm font-semibold text-yellow-700 hover:text-yellow-800">
                View all packages <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($allPackages->isNotEmpty()): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 md:gap-6 items-stretch">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $allPackages->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <article class="group flex h-full flex-col overflow-hidden rounded-2xl bg-white shadow-sm border border-gray-100 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                        <div class="relative aspect-[4/3] shrink-0 overflow-hidden bg-gray-100">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->thumbnail): ?>
                                <img src="<?php echo e($package->thumbnail_url); ?>" alt="<?php echo e($package->title); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <?php elseif($package->images->isNotEmpty()): ?>
                                <img src="<?php echo e($package->images->first()->image_url); ?>" alt="<?php echo e($package->title); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <?php else: ?>
                                <div class="w-full h-full bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center">
                                    <i class="fas fa-image text-white text-4xl opacity-40"></i>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->badge_label): ?>
                                <span class="absolute left-3 bottom-3 inline-flex items-center gap-1 rounded-full bg-black/60 px-3 py-1 text-[10px] font-semibold text-white">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->badge_icon): ?><i class="fas fa-star text-yellow-300"></i><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php echo e($package->badge_label); ?>

                                </span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <div class="flex flex-1 flex-col p-4 md:p-5">
                            <div class="flex items-center justify-between gap-2 mb-2">
                                <span class="inline-flex items-center rounded-full bg-yellow-100 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide text-yellow-700">
                                    <?php echo e($package->category?->name ?? 'Activity'); ?>

                                </span>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->rating): ?>
                                    <span class="inline-flex items-center gap-1 text-xs font-semibold text-orange-500">
                                        <i class="fas fa-star text-yellow-400"></i> <?php echo e(number_format($package->rating, 1)); ?>

                                    </span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <h3 class="min-h-[3.5rem] text-lg md:text-xl font-extrabold text-gray-900 leading-snug mb-2 line-clamp-2">
                                <a href="<?php echo e(route('tour.show', $package)); ?>" class="hover:text-yellow-600 transition-colors"><?php echo e($package->title); ?></a>
                            </h3>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->location): ?>
                                <p class="mb-3 flex items-center gap-2 text-sm text-gray-500">
                                    <i class="fas fa-map-marker-alt text-indigo-500"></i>
                                    <?php echo e($package->location); ?>

                                </p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <p class="min-h-[4.5rem] text-sm text-gray-600 line-clamp-3 mb-4">
                                <?php echo e($package->description ?? 'Explore a memorable Bali experience with local guidance and unforgettable moments.'); ?>

                            </p>

                            <div class="mt-auto flex items-end justify-between gap-3 pt-3 border-t border-gray-200">
                                <div>
                                    <span class="text-[10px] uppercase tracking-wide text-gray-400 font-semibold">From</span>
                                    <p class="text-lg font-extrabold text-yellow-700">
                                        Rp <?php echo e(number_format($package->price_2_4 ?? $package->price ?? 0, 0, ',', '.')); ?>

                                    </p>
                                </div>
                                <a href="<?php echo e(route('tour.show', $package)); ?>" class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-4 py-2 text-sm font-bold text-white transition hover:bg-blue-700">
                                    Details
                                </a>
                            </div>
                        </div>
                    </article>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        <?php else: ?>
            <div class="rounded-2xl border border-dashed border-gray-300 bg-gray-50 py-12 text-center text-gray-500">
                Paket aktivitas belum tersedia.
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</section>




<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($cars) && $cars->isNotEmpty()): ?>
<section id="car-rental" class="relative py-20 bg-indigo-900 overflow-hidden">
    <div class="absolute inset-0 opacity-20 text-white">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
            <defs>
                <pattern id="pattern" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M0 40L40 0H20L0 20M40 40V20L20 40" fill="none" stroke="currentColor" stroke-width="2" />
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#pattern)" />
        </svg>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-12">
            <span class="text-indigo-300 font-bold uppercase tracking-wider text-xs">Drive Your Own Adventure</span>
            <h2 class="text-3xl md:text-4xl font-extrabold text-white mt-2 mb-3 brand-font">Car Rental</h2>
            <div class="w-16 h-1 bg-yellow-500 rounded-full mx-auto"></div>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-8">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <article
                class="bg-gray-50 rounded-xl md:rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow duration-300 flex flex-col group border border-gray-100">
                <div class="h-36 md:h-56 overflow-hidden relative bg-white flex-shrink-0">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($car->image): ?>
                    <img src="<?php echo e(Storage::url($car->image)); ?>" alt="<?php echo e($car->name); ?>"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <?php else: ?>
                    <div
                        class="w-full h-full bg-gradient-to-br from-yellow-300 to-orange-400 flex items-center justify-center">
                        <i class="fas fa-car text-white text-3xl md:text-4xl opacity-50"></i>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($car->discounted_price && $car->discounted_price < $car->price): ?>
                        <?php
                        $discountPerc = round((($car->price - $car->discounted_price) / $car->price) * 100);
                        ?>
                        <div
                            class="absolute top-2 right-2 md:top-4 md:right-4 bg-red-500 text-white text-[10px] md:text-xs font-bold px-2 md:px-3 py-1 md:py-1.5 rounded-full shadow-lg">
                            Disc <?php echo e($discountPerc); ?>%
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <div class="p-3 md:p-6 flex flex-col flex-grow">
                    <h2
                        class="text-base md:text-xl font-bold text-gray-800 brand-font mb-1 md:mb-2 group-hover:text-yellow-600 transition-colors line-clamp-2">
                        <?php echo e($car->name); ?></h2>
                    <div class="mb-3 md:mb-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($car->discounted_price && $car->discounted_price < $car->price): ?>
                            <div class="flex items-center gap-2 mb-0.5 md:mb-1">
                                <span class="text-[10px] md:text-sm text-gray-400 line-through">Rp <?php echo e(number_format($car->price, 0,
                                    ',', '.')); ?></span>
                            </div>
                            <p class="text-sm md:text-xl font-bold text-yellow-700">Rp <?php echo e(number_format($car->discounted_price, 0,
                                ',', '.')); ?> <span class="text-[10px] md:text-xs text-gray-500 font-normal">/
                                    hari</span></p>
                            <?php else: ?>
                            <p class="text-sm md:text-xl font-bold text-yellow-700">Rp <?php echo e(number_format($car->price, 0,
                                ',', '.')); ?> <span class="text-[10px] md:text-xs text-gray-500 font-normal">/ hari</span></p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <div class="text-[10px] md:text-sm text-gray-600 mb-4 md:mb-6 flex-grow">
                        <?php echo nl2br(e($car->description)); ?>

                    </div>
                    <a href="<?php echo e(route('car-rental.checkout.index', $car)); ?>"
                        class="mt-auto block w-full border-2 border-yellow-600 text-yellow-700 hover:bg-yellow-600 hover:text-white font-bold py-1.5 md:py-2.5 px-3 md:px-4 rounded-lg md:rounded-xl text-center text-xs md:text-base transition-all duration-200">
                        Booking <i class="fas fa-arrow-right ml-1 text-[10px] md:text-sm"></i>
                    </a>
                </div>
            </article>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>

        <div class="text-center mt-12">
            <a href="<?php echo e(route('car-rental.index')); ?>"
                class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-8 py-3.5 rounded-full transition-transform transform hover:-translate-y-1 shadow-md">
                See all
            </a>
        </div>

    </div>
</section>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<section class="py-20 bg-gray-50 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-orange-500 font-bold uppercase tracking-wider text-sm">Why Choose Us</span>
            <h2 class="text-3xl md:text-5xl font-extrabold text-gray-900 mt-2 mb-4 brand-font">Why Choose <span
                    class="text-indigo-600"> Bliss in Bali</span>?</h2>
            <div class="w-96 h-1 bg-orange-500 mx-auto rounded-full"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

            <div
                class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 text-center hover:shadow-xl transition-all duration-300 group">
                <div
                    class="w-16 h-16 bg-indigo-50 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-indigo-600 group-hover:text-white text-indigo-600 transition-colors duration-300">
                    <i class="fas fa-tags text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Best Price Guarantee</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    We offer the most competitive prices for travel packages and hotel bookings in Bali—ensuring great
                    value for your money.
                </p>
            </div>

            <div
                class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 text-center hover:shadow-xl transition-all duration-300 group">
                <div
                    class="w-16 h-16 bg-orange-50 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-orange-500 group-hover:text-white text-orange-500 transition-colors duration-300">
                    <i class="fas fa-headset text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">24/7 Customer Support</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Our dedicated support team is available around the clock to assist you and ensure a smooth travel
                    experience.
                </p>
            </div>

            <div
                class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 text-center hover:shadow-xl transition-all duration-300 group">
                <div
                    class="w-16 h-16 bg-green-50 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-green-500 group-hover:text-white text-green-500 transition-colors duration-300">
                    <i class="fas fa-shield-alt text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Safe & Trusted</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Secure payment systems and carefully verified travel partners give you peace of mind throughout your
                    journey.
                </p>
            </div>

            <div
                class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 text-center hover:shadow-xl transition-all duration-300 group">
                <div
                    class="w-16 h-16 bg-yellow-50 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-yellow-500 group-hover:text-white text-yellow-500 transition-colors duration-300">
                    <i class="fas fa-map-marked-alt text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Wide Range of Choices</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Discover hundreds of destinations, activities, and accommodations tailored to suit every budget and
                    travel style.
                </p>
            </div>

        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    let currentCategory = 'all';
    let currentSubCategory = 'all';

    // ── Filter kategori di dashboard ──────────────────────────
    function filterCategory(catId) {
        currentCategory = catId;
        const btns = document.querySelectorAll('.cat-btn');
        const subCatFilter = document.getElementById('subCategoryFilters');

        // Update tombol aktif
        btns.forEach(btn => {
            const isActive = btn.dataset.cat == catId;
            btn.classList.toggle('bg-yellow-500', isActive);
            btn.classList.toggle('text-white', isActive);
            btn.classList.toggle('border-yellow-500', isActive);
            btn.classList.toggle('border-gray-200', !isActive);
            btn.classList.toggle('text-gray-600', !isActive);
        });

        // Tampilkan/sembunyikan filter subkategori
        if (subCatFilter && catId == subCatFilter.dataset.parentCat) {
            subCatFilter.classList.remove('hidden');
            subCatFilter.classList.add('flex');

            // Auto reset subcategory when category is clicked
            filterSubCategory('all', false);
        } else {
            if (subCatFilter) {
                subCatFilter.classList.add('hidden');
                subCatFilter.classList.remove('flex');
            }
            currentSubCategory = 'all';
        }

        applyFilters();
    }

    function filterSubCategory(subCat, apply = true) {
        currentSubCategory = subCat;
        const btns = document.querySelectorAll('.subcat-btn');

        btns.forEach(btn => {
            const isActive = btn.dataset.subcat === subCat;
            btn.classList.toggle('bg-yellow-500', isActive);
            btn.classList.toggle('text-white', isActive);
            btn.classList.toggle('border-yellow-500', isActive);
            btn.classList.toggle('border-gray-200', !isActive);
            btn.classList.toggle('text-gray-600', !isActive);
        });

        if (apply) {
            applyFilters();
        }
    }

    function applyFilters() {
        const cards = document.querySelectorAll('.package-card');
        const subCatFilter = document.getElementById('subCategoryFilters');
        const isSubCatActive = subCatFilter && !subCatFilter.classList.contains('hidden');

        cards.forEach(card => {
            const matchCat = currentCategory === 'all' || card.dataset.cat == currentCategory;
            const matchSubCat = currentSubCategory === 'all' || card.dataset.subcat === currentSubCategory;

            if (isSubCatActive) {
                card.style.display = (matchCat && matchSubCat) ? '' : 'none';
            } else {
                card.style.display = matchCat ? '' : 'none';
            }
        });
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/dwiki/Documents/website/blissinbali/resources/views/dashboard.blade.php ENDPATH**/ ?>