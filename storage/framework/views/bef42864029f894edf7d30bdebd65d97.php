


<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['query', 'packages', 'categories']));

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

foreach (array_filter((['query', 'packages', 'categories']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<section class="relative bg-gradient-to-br from-yellow-700 via-orange-600 to-amber-500 pt-32 pb-16 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-72 h-72 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-20 w-96 h-96 bg-white rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-yellow-100 text-sm font-semibold uppercase tracking-widest mb-3">Search Results</p>
        <h1 class="text-3xl md:text-4xl font-bold text-white mb-4 brand-font">
            Results for <span class="text-yellow-300">"<?php echo e($query); ?>"</span>
        </h1>
        <p class="text-yellow-100 text-base max-w-xl mx-auto">
            Found <strong><?php echo e($packages->count()); ?></strong> <?php echo e(Str::plural('package', $packages->count())); ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($categories->isNotEmpty()): ?>
                and <strong><?php echo e($categories->count()); ?></strong> <?php echo e(Str::plural('category', $categories->count())); ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </p>

        <form action="<?php echo e(route('search')); ?>" method="GET" class="mt-8 max-w-xl mx-auto">
            <div class="flex items-center bg-white rounded-full overflow-hidden shadow-lg">
                <div class="pl-5 pr-3 text-gray-400">
                    <i class="fas fa-search"></i>
                </div>
                <input type="text" name="q" value="<?php echo e($query); ?>"
                       class="w-full py-3.5 bg-transparent border-none focus:outline-none text-gray-700 text-sm font-medium"
                       placeholder="Search destinations, packages, activities...">
                <button type="submit"
                        class="bg-yellow-600 hover:bg-yellow-700 text-white px-7 py-3.5 font-semibold text-sm transition-colors whitespace-nowrap">
                    Search
                </button>
            </div>
        </form>
    </div>
</section><?php /**PATH /home/dwiki/Documents/website/blissinbali/resources/views/components/search-hero.blade.php ENDPATH**/ ?>