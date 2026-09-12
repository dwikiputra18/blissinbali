


<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['package']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['package']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    // Kumpulkan semua kolom harga yang mungkin ada
    // Filter nilai yang null atau 0 agar tidak ikut terhitung sebagai harga termurah
    $prices = collect([
        $package->price_2_4,
        $package->price_5_7,
        $package->price_8_14,
        // Tambahkan kolom harga lain di sini jika ada di database Anda
    ])->filter(fn($price) => $price > 0);

    $lowestPrice = $prices->min();
?>

<div class="card bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden group cursor-pointer h-full flex flex-col">

    
    <div class="relative h-44 overflow-hidden bg-gray-200">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->thumbnail): ?>
            <img class="card-img w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                 src="<?php echo e($package->thumbnail_url); ?>"
                 alt="<?php echo e($package->title); ?>">
        <?php elseif($package->images->isNotEmpty()): ?>
            <img class="card-img w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                 src="<?php echo e($package->images->first()->image_url); ?>"
                 alt="<?php echo e($package->title); ?>">
        <?php else: ?>
            <div class="w-full h-full bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center">
                <i class="fas fa-image text-white text-4xl opacity-40"></i>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->rating): ?>
        <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-2 py-0.5 rounded-full text-xs font-bold text-orange-600 shadow">
            <i class="fas fa-star text-yellow-400 text-xs"></i> <?php echo e(number_format($package->rating, 1)); ?>

        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->badge_label): ?>
        <div class="absolute bottom-3 left-3">
            <span class="bg-black/60 text-white px-2 py-0.5 rounded-full text-[10px]">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->badge_icon): ?><i class="fas <?php echo e($package->badge_icon); ?> mr-1"></i><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php echo e($package->badge_label); ?>

            </span>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    
    <div class="p-3 md:p-4 flex flex-col flex-grow">
        <h4 class="font-bold text-gray-800 text-xs md:text-base leading-snug mb-1 md:mb-2 group-hover:text-yellow-600 transition-colors 
                    /* Mengunci tinggi box judul agar selalu setara 2 baris */
                    line-clamp-2 h-[2.6em] md:h-[3em] flex items-start overflow-hidden">
    
                        <a href="<?php echo e(route('tour.show', $package)); ?>" class="block">
                        <?php echo e($package->title); ?>

                        </a>
                    </h4>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->location): ?>
        <p class="text-gray-400 text-[10px] md:text-xs flex items-center gap-1 mb-2">
            <i class="fas fa-map-marker-alt text-indigo-400"></i>
            <?php echo e($package->location); ?>

        </p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->description): ?>
        <p class="text-gray-500 text-[10px] md:text-xs mb-4 line-clamp-2"><?php echo e($package->description); ?></p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <div class="mt-auto pt-3 border-t border-gray-100 flex flex-col gap-3">
            <div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($lowestPrice): ?>
                    <span class="text-[9px] uppercase font-bold text-gray-400 block mb-0.5">Starts from</span>
                    <span class="text-sm md:text-lg font-extrabold text-orange-600 leading-tight">
                        Rp <?php echo e(number_format($lowestPrice, 0, ',', '.')); ?>

                    </span>
                    <span class="text-[10px] text-gray-400 font-medium">/pax</span>
                <?php else: ?>
                    <span class="text-xs text-gray-400 italic">Contact for price</span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div class="flex items-center justify-between gap-2">
                <a href="<?php echo e(route('tour.show', $package)); ?>"
                    class="flex-1 bg-yellow-600 hover:bg-yellow-700 text-white text-[10px] md:text-xs font-bold py-2 md:py-2.5 rounded-xl text-center transition-all shadow-sm active:scale-95">
                    Details
                </a>
            </div>
        </div>
    </div>

</div><?php /**PATH /home/dwiki/Documents/website/blissinbali/resources/views/components/destination-card.blade.php ENDPATH**/ ?>