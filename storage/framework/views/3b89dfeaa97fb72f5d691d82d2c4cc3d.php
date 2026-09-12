<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['active', 'icon']));

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

foreach (array_filter((['active', 'icon']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$classes = ($active ?? false)
            ? 'flex items-center py-3 px-6 bg-indigo-800 text-white border-l-4 border-indigo-400'
            : 'flex items-center py-3 px-6 text-indigo-300 hover:bg-indigo-800 hover:text-white transition duration-200';
?>

<a <?php echo e($attributes->merge(['class' => $classes])); ?>>
    <i class="<?php echo e($icon); ?> mr-3 w-5"></i>
    <span class="text-sm font-medium"><?php echo e($slot); ?></span>
</a>
<?php /**PATH /home/dwiki/Documents/website/blissinbali/resources/views/components/nav-link.blade.php ENDPATH**/ ?>