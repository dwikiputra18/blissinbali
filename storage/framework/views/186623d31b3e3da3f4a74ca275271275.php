<?php $__env->startSection('title', ($activeCategory ? $activeCategory->name . ' — ' : '') . 'Tour Packages — Bliss in Bali'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .card-hover { transition: transform .3s ease, box-shadow .3s ease; }
    .card-hover:hover { transform: translateY(-6px); box-shadow: 0 20px 40px rgba(0,0,0,.12); }
    .category-pill.active { background-color: #d97706; color: #fff; border-color: #d97706; }
    .line-through-price { text-decoration: line-through; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


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
            <?php echo e($activeCategory ? $activeCategory->name : 'All Tour Packages'); ?>

        </h1>
        <p class="text-yellow-100 text-lg max-w-2xl mx-auto">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeCategory): ?>
                Showing <strong><?php echo e($packages->count()); ?></strong> curated packages in <strong><?php echo e($activeCategory->name); ?></strong>
            <?php else: ?>
                Explore <strong><?php echo e($packages->count()); ?></strong> unforgettable journeys across Bali's most breathtaking destinations
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </p>
    </div>
</section>



<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($packages->isNotEmpty()): ?>
<section id="tour-packages" class="py-20 bg-gray-50 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
            <div>
                <span class="text-orange-500 font-bold uppercase tracking-wider text-xs">Best Picks</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mt-1 mb-3 brand-font">
                    Featured Travel Packages
                </h2>
                <div class="w-16 h-1 bg-yellow-500 rounded-full"></div>
            </div>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($categories->isNotEmpty()): ?>
            <div class="flex flex-col gap-4 w-full md:w-auto">
                <div class="flex items-center gap-2 overflow-x-auto flex-nowrap pb-2 w-full [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
                    <button onclick="filterCategory('all')"
                        class="cat-btn active px-4 py-2 rounded-full text-sm font-semibold border transition-all duration-200 border-yellow-500 bg-yellow-500 text-white whitespace-nowrap flex-shrink-0"
                        data-cat="all">
                        All
                    </button>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <button onclick="filterCategory('<?php echo e($cat->id); ?>')"
                        class="cat-btn px-4 py-2 rounded-full text-sm font-semibold border transition-all duration-200 border-gray-200 text-gray-600 hover:border-yellow-500 hover:text-yellow-600 whitespace-nowrap flex-shrink-0"
                        data-cat="<?php echo e($cat->id); ?>">
                        <?php echo e(strtoupper($cat->name)); ?>

                    </button>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>

                
                <?php
                    $onedayTourId = $categories->first(fn($c) => stripos($c->name, 'oneday') !== false)->id ?? null;
                ?>
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($onedayTourId): ?>
                <div id="subCategoryFilters"
                    class="hidden items-center gap-2 overflow-x-auto flex-nowrap pb-2 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none] pl-4 sm:pl-8 w-full border-l-2 border-yellow-200"
                    data-parent-cat="<?php echo e($onedayTourId); ?>">
                    <?php
                        $subCategories = ['Ubud Tour', 'Kintamani Tour', 'Island Tour', 'South Bali', 'East Bali', 'North Bali', 'West Bali'];
                    ?>
                    <button onclick="filterSubCategory('all')"
                        class="subcat-btn active px-4 py-2 rounded-full text-[10px] md:text-xs font-bold border transition-all duration-200 border-yellow-500 bg-yellow-500 text-white whitespace-nowrap flex-shrink-0"
                        data-subcat="all">
                        ALL TYPES
                    </button>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <button onclick="filterSubCategory('<?php echo e($subCat); ?>')"
                        class="subcat-btn px-4 py-2 rounded-full text-[10px] md:text-xs font-bold border transition-all duration-200 border-gray-200 text-gray-500 hover:border-yellow-500 hover:text-yellow-600 whitespace-nowrap flex-shrink-0"
                        data-subcat="<?php echo e($subCat); ?>">
                        <?php echo e(strtoupper($subCat)); ?>

                    </button>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-7" id="packagesGrid">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <article
                class="package-card bg-white rounded-xl md:rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group flex flex-col"
                data-cat="<?php echo e($package->tour_category_id); ?>" 
                data-subcat="<?php echo e($package->sub_category ?? 'all'); ?>">

                
                <a href="<?php echo e(route('tour.show', $package)); ?>" class="flex items-center justify-center relative w-full aspect-video overflow-hidden bg-light">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->thumbnail): ?>
                        <img src="<?php echo e($package->thumbnail_url); ?>" alt="<?php echo e($package->title); ?>"
                            class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500">
                    <?php elseif($package->images->isNotEmpty()): ?>
                        <img src="<?php echo e($package->images->first()->image_url); ?>" alt="<?php echo e($package->title); ?>"
                            class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500">
                    <?php else: ?>
                        <div class="w-full h-full bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center">
                            <i class="fas fa-image text-white text-4xl opacity-40"></i>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->discounted_price && $package->discounted_price < $package->price): ?>
                        <span class="absolute top-2 right-2 md:top-3 md:right-3 bg-red-500 text-white text-[10px] md:text-xs font-bold px-2 py-0.5 md:px-3 md:py-1 rounded-full shadow">
                            Disc
                        </span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->images->count() > 0): ?>
                        <span class="absolute bottom-2 right-2 md:bottom-3 md:right-3 bg-black/50 text-white text-[10px] px-2 py-0.5 rounded flex items-center gap-1">
                            <i class="fas fa-images"></i> <?php echo e($package->images->count()); ?>

                        </span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </a>

                
                <div class="p-3 md:p-5 flex-grow flex flex-col">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->duration): ?>
                        <p class="text-[10px] md:text-xs text-gray-400 mb-1.5 flex items-center gap-1">
                            <i class="fas fa-clock"></i> <?php echo e($package->duration); ?>

                        </p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <h4 class="font-bold text-gray-800 text-sm md:text-base leading-snug mb-2 group-hover:text-yellow-600 transition-colors line-clamp-2 h-[2.8em] md:h-[3em]">
                        <a href="<?php echo e(route('tour.show', $package)); ?>">
                            <?php echo e($package->title); ?>

                        </a>
                    </h4>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->description): ?>
                        <p class="text-gray-500 text-[10px] md:text-sm leading-relaxed mb-4 line-clamp-2 italic">
                            <?php echo e($package->description); ?>

                        </p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <div class="mt-auto pt-3 border-t border-gray-100 flex items-end justify-between">
                        <div class="flex flex-col">
                            <?php
                                $lowestPrice = collect([$package->price_2_4, $package->price_5_7, $package->price_8_14])
                                               ->filter(fn($p) => $p > 0)->min();
                            ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($lowestPrice): ?>
                                <span class="text-[9px] md:text-[10px] text-gray-400 uppercase font-semibold">Starts From</span>
                                <p class="text-sm md:text-lg font-bold text-yellow-700 leading-none">
                                    Rp <?php echo e(number_format($lowestPrice, 0, ',', '.')); ?>

                                </p>
                            <?php else: ?>
                                <p class="text-[10px] md:text-sm text-gray-400 italic">Contact Us</p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        
                        <a href="<?php echo e(route('tour.show', $package)); ?>"
                            class="inline-flex items-center bg-yellow-600 hover:bg-yellow-700 text-white text-[10px] md:text-sm font-semibold px-3 py-1.5 md:px-4 md:py-2 rounded-lg md:rounded-xl transition-all">
                            Details
                        </a>
                    </div>
                </div>

            </article>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>

        
        <div id="emptyState" class="hidden text-center py-20">
            <i class="fas fa-search text-gray-300 text-5xl mb-4"></i>
            <p class="text-gray-500">No packages found for this category.</p>
        </div>

    </div>
</section>


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
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


<section class="bg-gradient-to-r from-yellow-600 to-orange-500 py-16">
    <div class="max-w-3xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-white mb-4 brand-font">Can't Find What You're Looking For?</h2>
        <p class="text-yellow-100 mb-8">
            Our travel experts are ready to craft a personalized Bali experience just for you — tell us your dream trip and we'll make it happen.
        </p>
        <a href="https://wa.me/6281266718008"
           target="_blank"
           class="inline-flex items-center gap-3 bg-white text-yellow-700 hover:bg-yellow-50 font-bold px-8 py-4 rounded-full shadow-lg transition-all duration-200 hover:shadow-xl">
            <i class="fab fa-whatsapp text-green-500 text-xl"></i>
            Chat with Us on WhatsApp
        </a>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/dwiki/Documents/website/blissinbali/resources/views/tour/index.blade.php ENDPATH**/ ?>