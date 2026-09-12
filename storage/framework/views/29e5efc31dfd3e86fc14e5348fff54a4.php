


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

<article class="card-hover bg-white rounded-2xl overflow-hidden shadow-md group">

    
    <a href="<?php echo e(route('tour.show', $package)); ?>" class="block relative overflow-hidden h-52">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->thumbnail): ?>
            <img src="<?php echo e($package->thumbnail_url); ?>"
                 alt="<?php echo e($package->title); ?>"
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
        <?php elseif($package->images->isNotEmpty()): ?>
            <img src="<?php echo e($package->images->first()->image_url); ?>"
                 alt="<?php echo e($package->title); ?>"
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
        <?php else: ?>
            <div class="w-full h-full bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center">
                <i class="fas fa-image text-white text-4xl opacity-50"></i>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <span class="absolute top-3 left-3 bg-white/90 backdrop-blur text-yellow-700 text-xs font-bold px-3 py-1 rounded-full shadow">
            <?php echo e($package->category->name); ?>

        </span>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->discounted_price && $package->discounted_price < $package->price): ?>
        <span class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow">
            SALE
        </span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->images->count() > 0): ?>
        <span class="absolute bottom-3 right-3 bg-black/50 text-white text-xs px-2 py-1 rounded-lg flex items-center gap-1">
            <i class="fas fa-images text-xs"></i> <?php echo e($package->images->count()); ?>

        </span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </a>

    
    <div class="p-5">
        <div class="flex items-center gap-3 text-xs text-gray-400 mb-2">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->duration): ?>
            <span class="flex items-center gap-1">
                <i class="fas fa-clock"></i> <?php echo e($package->duration); ?>

            </span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->location): ?>
            <span class="flex items-center gap-1">
                <i class="fas fa-map-marker-alt"></i> <?php echo e($package->location); ?>

            </span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <h4 class="font-bold text-gray-800 text-base leading-snug mb-2 group-hover:text-yellow-600 transition-colors line-clamp-2 min-h-[2.8em]">
        <a href="<?php echo e(route('tour.show', $package)); ?>"><?php echo e($package->title); ?></a>
        </h4>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->description): ?>
        <p class="text-gray-500 text-sm leading-relaxed mb-4 line-clamp-2">
            <?php echo e($package->description); ?>

        </p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="flex items-end justify-between pt-3 border-t border-gray-100">
            <div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->price_2_4): ?>
                    <div class="flex flex-col">
                        <span class="text-xs text-gray-400 uppercase tracking-widest font-semibold mb-0.5">Starts from</span>
                        <div class="flex items-baseline gap-1">
                            <span class="text-xl md:text-2xl font-bold text-yellow-700">
                                Rp <?php echo e(number_format($package->price_2_4, 0, ',', '.')); ?>

                            </span>
                            <span class="text-xs text-gray-400 font-medium">/ pax</span>
                        </div>
                    </div>
                <?php else: ?>
                    <span class="text-sm text-gray-400 italic font-medium">Contact Us</span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <a href="<?php echo e(route('tour.show', $package)); ?>"
               class="inline-flex items-center gap-2 bg-yellow-600 hover:bg-yellow-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors">
                Details <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
    </div>

</article><?php /**PATH /home/dwiki/Documents/website/blissinbali/resources/views/components/package-card.blade.php ENDPATH**/ ?>