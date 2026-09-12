<?php $__env->startSection('title', 'Sewa Mobil di Bali - Bliss in Bali'); ?>

<?php $__env->startSection('content'); ?>
<div class="pt-24 pb-16 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-gray-800 brand-font mb-4 text-center">Premium Car Rental</h1>
        <p class="text-gray-500 text-center mb-12 max-w-2xl mx-auto">Discover Bali at your own pace. Pick a car that fits your trip and enjoy our excellent service.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <article class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow duration-300 flex flex-col group">
                
                <div class="h-56 overflow-hidden relative bg-gray-100 flex-shrink-0">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($car->image): ?>
                        <img src="<?php echo e(Storage::url($car->image)); ?>" alt="<?php echo e($car->name); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <?php else: ?>
                        <div class="w-full h-full bg-gradient-to-br from-yellow-300 to-orange-400 flex items-center justify-center">
                            <i class="fas fa-car text-white text-4xl opacity-50"></i>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($car->discounted_price && $car->discounted_price < $car->price): ?>
                        <?php
                            $discountPerc = round((($car->price - $car->discounted_price) / $car->price) * 100);
                        ?>
                        <div class="absolute top-4 right-4 bg-red-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">
                            Disc <?php echo e($discountPerc); ?>%
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="p-6 flex flex-col flex-grow">
                    
                    <h2 class="text-2xl font-bold text-gray-800 brand-font mb-2 group-hover:text-yellow-600 transition-colors"><?php echo e($car->name); ?></h2>
                    
                    
                    <div class="mb-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($car->discounted_price && $car->discounted_price < $car->price): ?>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-sm text-gray-400 line-through">Rp <?php echo e(number_format($car->price, 0, ',', '.')); ?></span>
                            </div>
                            <p class="text-xl font-bold text-yellow-700">Rp <?php echo e(number_format($car->discounted_price, 0, ',', '.')); ?> <span class="text-sm text-gray-500 font-normal">/ hari</span></p>
                        <?php else: ?>
                            <p class="text-xl font-bold text-yellow-700">Rp <?php echo e(number_format($car->price, 0, ',', '.')); ?> <span class="text-sm text-gray-500 font-normal">/ day</span></p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    
                    <div class="text-sm text-gray-600 mb-6 flex-grow line-clamp-3">
                        <?php echo nl2br(e($car->description)); ?>

                    </div>

                    
                    <a href="<?php echo e(route('car-rental.checkout.index', $car)); ?>" class="mt-auto block w-full bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-3 px-4 rounded-xl text-center transition-colors shadow">
                        Book Now <i class="fas fa-arrow-right ml-1 text-sm"></i>
                    </a>
                </div>
            </article>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cars->isEmpty()): ?>
                <div class="col-span-full text-center py-20 bg-white rounded-2xl border border-gray-100 placeholder-content shadow-sm">
                    <i class="fas fa-car-side text-gray-300 text-5xl mb-4"></i>
                    <p class="text-gray-500">No cars available for rent at the moment.</p>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/dwiki/Documents/website/blissinbali/resources/views/car-rental/index.blade.php ENDPATH**/ ?>