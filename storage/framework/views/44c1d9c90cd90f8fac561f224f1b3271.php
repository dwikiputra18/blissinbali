<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title', 'value', 'color', 'trend']));

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

foreach (array_filter((['title', 'value', 'color', 'trend']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    // Mapping colors to Tailwind classes
    $colors = [
        'blue' => 'border-blue-950 text-white bg-blue-950',
        'green' => 'border-green-500 text-green-600 bg-green-50',
        'yellow' => 'border-yellow-500 text-yellow-600 bg-yellow-50',
        'red' => 'border-red-500 text-red-600 bg-red-50',
    ];
    $selectedColor = $colors[$color] ?? $colors['blue'];
?>

<div class="bg-white p-6 rounded-xl shadow-sm border-l-4 <?php echo e(explode(' ', $selectedColor)[0]); ?> hover:shadow-md transition-shadow duration-300">
    <div class="flex justify-between items-start">
        <div>
            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider"><?php echo e($title); ?></p>
            <h3 class="text-2xl font-bold text-gray-800 mt-1"><?php echo e($value); ?></h3>
        </div>
        <div class="p-2 rounded-lg <?php echo e($selectedColor); ?>">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($color == 'blue'): ?> <i class="fas fa-shopping-cart"></i>
            <?php elseif($color == 'green'): ?> <i class="fas fa-wallet"></i>
            <?php elseif($color == 'yellow'): ?> <i class="fas fa-hotel"></i>
            <?php else: ?> <i class="fas fa-exclamation-circle"></i>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
    <div class="mt-4 flex items-center">
        <span class="text-xs font-semibold <?php echo e(str_contains($trend, '+') ? 'text-green-600' : (str_contains($trend, '-') ? 'text-red-600' : 'text-gray-400')); ?>">
            <?php echo e($trend); ?>

        </span>
        <span class="text-xs text-gray-400 ml-2 italic text-[10px]">since last month</span>
    </div>
</div>
<?php /**PATH /home/dwiki/Documents/website/blissinbali/resources/views/partials/stats-card.blade.php ENDPATH**/ ?>