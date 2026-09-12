<?php $__env->startSection('title', 'Search: "' . $query . '" — Bliss in Bali'); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginale924cd00018ec245341f0983301dee92 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale924cd00018ec245341f0983301dee92 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-results','data' => ['query' => $query,'packages' => $packages,'categories' => $categories]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('search-results'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['query' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($query),'packages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($packages),'categories' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($categories)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale924cd00018ec245341f0983301dee92)): ?>
<?php $attributes = $__attributesOriginale924cd00018ec245341f0983301dee92; ?>
<?php unset($__attributesOriginale924cd00018ec245341f0983301dee92); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale924cd00018ec245341f0983301dee92)): ?>
<?php $component = $__componentOriginale924cd00018ec245341f0983301dee92; ?>
<?php unset($__componentOriginale924cd00018ec245341f0983301dee92); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/dwiki/Documents/website/blissinbali/resources/views/tour/search.blade.php ENDPATH**/ ?>