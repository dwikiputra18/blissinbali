<?php $__env->startSection('og_title',       $ogTitle); ?>
<?php $__env->startSection('og_description', $ogDescription); ?>
<?php $__env->startSection('og_image',       $ogImage); ?>
<?php $__env->startSection('og_url',         $ogUrl); ?>
<?php $__env->startSection('og_type',        'article'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .gallery-thumb {
        cursor: pointer;
        transition: opacity .2s, transform .2s, border-color .2s;
    }

    .gallery-thumb:hover {
        opacity: .85;
    }

    .gallery-thumb.active {
        border-color: #f59e0b;
        opacity: 1;
    }

    .activity-card {
        background: linear-gradient(180deg, #ffffff 0%, #fffaf0 100%);
    }

    .line-through-price {
        text-decoration: line-through;
    }

    .pricing-display {
        font-family: 'Montserrat', sans-serif;
        letter-spacing: .01em;
    }

    .activities-pricing h2,
    .activities-pricing h3,
    .activities-pricing p {
        font-family: 'Montserrat', sans-serif;
    }

    #lightbox {
        display: none;
    }

    #lightbox.open {
        display: flex;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white border-b border-gray-100 pt-24 pb-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-sm text-gray-400">
            <a href="<?php echo e(url('/')); ?>" class="hover:text-yellow-600 transition-colors">Home</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="<?php echo e(route('tour.index')); ?>" class="hover:text-yellow-600 transition-colors">Tour Packages</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="<?php echo e(route('tour.index', ['category' => $tourPackage->category->slug])); ?>" class="hover:text-yellow-600 transition-colors">
                <?php echo e($tourPackage->category->name); ?>

            </a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-gray-700 font-medium truncate max-w-xs"><?php echo e($tourPackage->title); ?></span>
        </nav>
    </div>
</div>

<section class="bg-gray-50 py-8 md:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 xl:gap-10">
            <div class="xl:col-span-2 space-y-6">
                <?php
                    $allImages = collect();
                    if ($tourPackage->thumbnail) {
                        $allImages->push(['src' => $tourPackage->thumbnail_url, 'type' => 'thumbnail']);
                    }
                    foreach ($tourPackage->images as $img) {
                        $allImages->push(['src' => $img->image_url, 'type' => 'gallery']);
                    }
                ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($allImages->isNotEmpty()): ?>
                    <div class="overflow-hidden rounded-3xl bg-white shadow-md border border-gray-100">
                        <div class="relative w-full aspect-[16/10] bg-gray-100">
                            <img id="mainPhoto" src="<?php echo e($allImages->first()['src']); ?>" alt="<?php echo e($tourPackage->title); ?>" class="h-full w-full object-cover cursor-zoom-in" onclick="openLightbox(0)">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($allImages->count() > 1): ?>
                                <span class="absolute bottom-4 right-4 rounded-full bg-black/55 px-3 py-1 text-xs font-medium text-white backdrop-blur-sm">
                                    <i class="fas fa-images mr-1"></i> <?php echo e($allImages->count()); ?> Photos
                                </span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($allImages->count() > 1): ?>
                            <div class="flex gap-3 overflow-x-auto border-t border-gray-100 bg-white p-3">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $allImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <button type="button" onclick="switchPhoto('<?php echo e($img['src']); ?>', <?php echo e($i); ?>)" id="thumb-<?php echo e($i); ?>" class="gallery-thumb h-20 w-24 shrink-0 overflow-hidden rounded-xl border-2 <?php echo e($i === 0 ? 'border-yellow-500 active' : 'border-transparent'); ?>">
                                        <img src="<?php echo e($img['src']); ?>" alt="Foto <?php echo e($i + 1); ?>" class="h-full w-full object-cover">
                                    </button>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="flex aspect-[16/10] items-center justify-center rounded-3xl bg-gradient-to-br from-yellow-400 to-orange-500 shadow-md">
                        <i class="fas fa-image text-6xl text-white opacity-40"></i>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <div class="activity-card rounded-3xl border border-yellow-100 p-6 shadow-sm md:p-8">
                    <div class="mb-5 flex flex-wrap items-center gap-3">
                        <span class="rounded-full bg-yellow-100 px-3 py-1 text-[10px] font-bold uppercase tracking-[0.2em] text-yellow-700">
                            <?php echo e($tourPackage->category?->name ?? 'Activity'); ?>

                        </span>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tourPackage->rating): ?>
                            <span class="inline-flex items-center gap-1 rounded-full bg-orange-50 px-3 py-1 text-sm font-semibold text-orange-600">
                                <i class="fas fa-star text-yellow-400"></i> <?php echo e(number_format($tourPackage->rating, 1)); ?>

                            </span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tourPackage->badge_label): ?>
                            <span class="rounded-full border border-gray-200 bg-white px-3 py-1 text-xs font-medium text-gray-700"><?php echo e($tourPackage->badge_label); ?></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <h1 class="text-3xl font-black tracking-tight text-gray-900 md:text-4xl"><?php echo e($tourPackage->title); ?></h1>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tourPackage->subtitle): ?>
                        <p class="mt-3 text-lg text-gray-600"><?php echo e($tourPackage->subtitle); ?></p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <div class="grid gap-3 text-sm text-gray-600 sm:grid-cols-3">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tourPackage->duration): ?>
                            <div class="rounded-2xl border border-gray-200 bg-white px-4 py-3">
                                <div class="mb-1 text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400">Duration</div>
                                <div class="font-semibold text-gray-800"><?php echo e($tourPackage->duration); ?></div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tourPackage->location): ?>
                            <div class="rounded-2xl border border-gray-200 bg-white px-4 py-3">
                                <div class="mb-1 text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400">Location</div>
                                <div class="font-semibold text-gray-800"><?php echo e($tourPackage->location); ?></div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tourPackage->pickup_time): ?>
                            <div class="rounded-2xl border border-gray-200 bg-white px-4 py-3">
                                <div class="mb-1 text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400">Pickup</div>
                                <div class="font-semibold text-gray-800"><?php echo e($tourPackage->pickup_time); ?></div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tourPackage->description): ?>
                        <div class="mt-8 text-sm leading-7 text-gray-600">
                            <?php echo nl2br(e($tourPackage->description)); ?>

                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tourPackage->price_1_pax || $tourPackage->price_2_4 || $tourPackage->price_5_7 || $tourPackage->price_8_14 || ($tourPackage->is_activity && ($tourPackage->tandem_price_2_4 || $tourPackage->tandem_price_5_7 || $tourPackage->tandem_price_8_14 || $tourPackage->activity_tandem_price))): ?>
                    <div class="activities-pricing rounded-3xl border border-yellow-200 bg-gradient-to-br from-[#fffaf0] via-white to-slate-50 p-6 shadow-md md:p-8">
                        <div class="mb-5">
                            <h2 class="text-xl font-extrabold tracking-tight text-slate-900 md:text-2xl"><?php echo e($tourPackage->is_activity ? 'Activities Pricing' : 'Tour Pricing'); ?></h2>
                            <p class="mt-1 text-sm text-slate-600">Prices are based on total participants.</p>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tourPackage->is_activity): ?>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="rounded-2xl border border-amber-200 bg-amber-50/70 p-5 shadow-sm">
                                <div class="flex items-center gap-3">
                                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-500 text-white shadow-sm">
                                        <i class="fas fa-motorcycle"></i>
                                    </span>
                                    <div>
                                        <h3 class="font-bold text-slate-900">Single Ride</h3>
                                        <p class="text-xs text-slate-600">1 participant</p>
                                    </div>
                                </div>
                            </div>
                            <div class="rounded-2xl border border-indigo-200 bg-indigo-50/70 p-5 shadow-sm">
                                <div class="flex items-center gap-3">
                                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-sm">
                                        <i class="fas fa-users"></i>
                                    </span>
                                    <div>
                                        <h3 class="font-bold text-slate-900">Tandem Ride</h3>
                                        <p class="text-xs text-slate-600">2 participants per tandem</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php
                            $minimumBookingQuantity = $tourPackage->minimum_booking_quantity;
                            $pricingTiers = [];
                            if (filled($tourPackage->price_1_pax)) {
                                $pricingTiers[] = ['label' => '1 Pax', 'single' => $tourPackage->price_1_pax, 'tandem' => null];
                            }
                            if (filled($tourPackage->price_2_4) || ($tourPackage->is_activity && filled($tourPackage->tandem_price_2_4 ?? $tourPackage->activity_tandem_price))) {
                                $pricingTiers[] = [
                                    'label' => $tourPackage->is_activity ? '2-4 Pax' : ($minimumBookingQuantity > 1 ? $minimumBookingQuantity . '-4 Pax' : '2-4 Pax'),
                                    'single' => $tourPackage->price_2_4,
                                    'tandem' => $tourPackage->tandem_price_2_4 ?? $tourPackage->activity_tandem_price,
                                ];
                            }
                            $pricingTiers = array_merge($pricingTiers, [
                                ['label' => '5-7 Pax', 'single' => $tourPackage->price_5_7, 'tandem' => $tourPackage->tandem_price_5_7 ?? $tourPackage->activity_tandem_price],
                                ['label' => '8-14 Pax', 'single' => $tourPackage->price_8_14, 'tandem' => $tourPackage->tandem_price_8_14 ?? $tourPackage->activity_tandem_price],
                            ]);
                            $pricingTiers = array_values(array_filter(
                                $pricingTiers,
                                fn ($tier) => filled($tier['single']) || filled($tier['tandem'])
                            ));
                        ?>
                        <div class="mt-5 overflow-hidden rounded-2xl border border-slate-200 bg-white sm:hidden">
                            <table class="w-full table-fixed text-left">
                                <thead class="bg-slate-50">
                                    <tr class="border-b border-slate-200">
                                        <th scope="col" class="<?php echo e($tourPackage->is_activity ? 'w-1/4' : 'w-1/2'); ?> px-3 py-3 text-[10px] font-bold uppercase tracking-wider text-slate-600 sm:px-4 sm:text-xs">Pax</th>
                                        <th scope="col" class="<?php echo e($tourPackage->is_activity ? 'w-[37.5%]' : 'w-1/2'); ?> px-3 py-3 text-[10px] font-bold uppercase tracking-wider text-amber-700 sm:px-4 sm:text-xs"><?php echo e($tourPackage->is_activity ? 'Single' : 'Price / person'); ?></th>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tourPackage->is_activity): ?><th scope="col" class="w-[37.5%] px-3 py-3 text-[10px] font-bold uppercase tracking-wider text-indigo-700 sm:px-4 sm:text-xs">Tandem</th><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $pricingTiers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                        <tr class="border-b border-slate-100 last:border-b-0">
                                            <th scope="row" class="px-3 py-4 text-sm font-bold text-slate-900 sm:px-4 sm:text-base"><?php echo e($tier['label']); ?></th>
                                            <td class="px-3 py-4 sm:px-4">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tier['single']): ?>
                                                    <span class="pricing-display text-sm font-black text-[#0A2240] sm:text-lg">Rp <?php echo e(number_format($tier['single'], 0, ',', '.')); ?></span>
                                                <?php else: ?>
                                                    <span class="text-xs italic text-slate-400 sm:text-sm">Contact us</span>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </td>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tourPackage->is_activity): ?>
                                            <td class="px-3 py-4 sm:px-4">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tier['tandem']): ?>
                                                    <span class="pricing-display text-sm font-black text-[#0A2240] sm:text-lg">Rp <?php echo e(number_format($tier['tandem'], 0, ',', '.')); ?></span>
                                                <?php else: ?>
                                                    <span class="text-xs italic text-slate-400 sm:text-sm">Contact us</span>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </td>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </tr>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-5 hidden overflow-hidden rounded-2xl border border-slate-200 bg-white sm:block">
                            <div class="grid grid-cols-4 border-b border-slate-200 bg-slate-50">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $pricingTiers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <div class="border-r border-slate-200 p-4 last:border-r-0">
                                        <h3 class="font-bold tracking-tight text-slate-900"><?php echo e($tier['label']); ?></h3>
                                    </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                            <div class="grid grid-cols-4">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $pricingTiers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <div class="border-r border-slate-200 p-4 last:border-r-0">
                                        <p class="text-[10px] font-bold uppercase tracking-wider text-amber-700"><?php echo e($tourPackage->is_activity ? 'Single / person' : 'Price / person'); ?></p>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tier['single']): ?>
                                            <p class="pricing-display mt-2 text-xl font-black text-[#0A2240]">Rp <?php echo e(number_format($tier['single'], 0, ',', '.')); ?></p>
                                        <?php else: ?>
                                            <p class="mt-2 text-sm italic text-slate-400">Contact us</p>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tourPackage->is_activity): ?>
                                            <p class="mt-4 text-[10px] font-bold uppercase tracking-wider text-indigo-700">Tandem / person</p>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tier['tandem']): ?>
                                                <p class="pricing-display mt-2 text-xl font-black text-[#0A2240]">Rp <?php echo e(number_format($tier['tandem'], 0, ',', '.')); ?></p>
                                            <?php else: ?>
                                                <p class="mt-2 text-sm italic text-slate-400">Contact us</p>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                        </div>
                        <p class="mt-4 text-xs font-medium text-slate-500">Minimum booking: <?php echo e($minimumBookingQuantity); ?> pax<?php echo e($tourPackage->is_activity ? '. Each tandem unit carries 2 participants.' : '.'); ?></p>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tourPackage->highlights): ?>
                    <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-100 md:p-8">
                        <h2 class="mb-5 flex items-center gap-3 text-xl font-extrabold text-gray-900">
                            <span class="h-6 w-1.5 rounded-full bg-yellow-500"></span>
                            Highlights
                        </h2>
                        <div class="space-y-3">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = explode("\n", str_replace("\r", "", $tourPackage->highlights)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <?php $line = trim($line); ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($line): ?>
                                    <div class="flex items-start gap-3 rounded-2xl bg-yellow-50/60 px-4 py-3 text-sm text-gray-700">
                                        <span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-full bg-yellow-500 text-xs font-bold text-white">✓</span>
                                        <span><?php echo e($line); ?></span>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tourPackage->itinerary): ?>
                    <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-100 md:p-8">
                        <h2 class="mb-5 flex items-center gap-3 text-xl font-extrabold text-gray-900">
                            <span class="h-6 w-1.5 rounded-full bg-indigo-500"></span>
                            itinerary
                        </h2>
                        <div class="space-y-3">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = explode("\n", str_replace("\r", "", $tourPackage->itinerary)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <?php $line = trim($line); ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($line): ?>
                                    <div class="flex items-start gap-3 rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700">
                                        <span class="mt-0.5 flex h-6 w-6 items-center justify-center rounded-full bg-indigo-100 text-[10px] font-bold text-indigo-700">•</span>
                                        <span><?php echo e($line); ?></span>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <div class="grid gap-6 md:grid-cols-2">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tourPackage->includes): ?>
                        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-100 md:p-8">
                            <h2 class="mb-5 flex items-center gap-3 text-xl font-extrabold text-gray-900">
                                <span class="h-6 w-1.5 rounded-full bg-emerald-500"></span>
                                Include
                            </h2>
                            <div class="space-y-3">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = explode("\n", str_replace("\r", "", $tourPackage->includes)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <?php $line = trim($line); ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($line): ?>
                                        <div class="flex items-start gap-3 text-sm text-gray-700">
                                            <span class="mt-0.5 text-emerald-500">✓</span>
                                            <span><?php echo e($line); ?></span>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tourPackage->excludes): ?>
                        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-100 md:p-8">
                            <h2 class="mb-5 flex items-center gap-3 text-xl font-extrabold text-gray-900">
                                <span class="h-6 w-1.5 rounded-full bg-red-500"></span>
                                Exclude
                            </h2>
                            <div class="space-y-3">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = explode("\n", str_replace("\r", "", $tourPackage->excludes)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <?php $line = trim($line); ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($line): ?>
                                        <div class="flex items-start gap-3 text-sm text-gray-700">
                                            <span class="mt-0.5 text-red-500">×</span>
                                            <span><?php echo e($line); ?></span>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tourPackage->terms): ?>
                    <div class="border-t border-gray-100 pt-8">
                        <h2 class="mb-4 text-lg font-bold text-gray-800">Terms & Conditions</h2>
                        <div class="space-y-2 text-sm italic text-gray-500">
                            <?php echo nl2br(e($tourPackage->terms)); ?>

                        </div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <aside class="lg:sticky lg:top-24" style="align-self:start;">
                <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white p-5 shadow-lg md:p-6">
                    <div class="mb-5 flex items-center justify-between">
                        <span class="rounded-full bg-yellow-100 px-3 py-1 text-[10px] font-bold uppercase tracking-[0.2em] text-yellow-700">
                            Best Price
                        </span>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tourPackage->rating): ?>
                            <span class="inline-flex items-center gap-1 text-sm font-semibold text-orange-500">
                                <i class="fas fa-star text-yellow-400"></i> <?php echo e(number_format($tourPackage->rating, 1)); ?>

                            </span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <?php
                        $minimumBookingQuantity = $tourPackage->minimum_booking_quantity;
                        $priceList = collect([
                            $tourPackage->price_1_pax,
                            $tourPackage->price_2_4,
                            $tourPackage->price_5_7,
                            $tourPackage->price_8_14,
                        ])->filter(fn($p) => $p > 0);
                        $lowestPrice = $priceList->min();
                    ?>

                    <div class="mb-5">
                        <div class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400">Starts from</div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($lowestPrice): ?>
                            <div class="mt-2 flex items-end gap-2">
                                <span class="text-3xl font-black tracking-tight text-yellow-700 md:text-4xl">Rp <?php echo e(number_format($lowestPrice, 0, ',', '.')); ?></span>
                                <span class="pb-1 text-sm text-gray-500">/ person</span>
                            </div>
                        <?php else: ?>
                            <div class="mt-2 text-lg font-semibold text-gray-500">Contact us</div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="mb-5 space-y-3 rounded-2xl bg-gray-50 p-4 text-sm text-gray-600">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tourPackage->duration): ?>
                            <div class="flex items-center gap-3">
                                <i class="fas fa-clock text-yellow-500"></i>
                                <span><?php echo e($tourPackage->duration); ?></span>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tourPackage->location): ?>
                            <div class="flex items-center gap-3">
                                <i class="fas fa-map-marker-alt text-indigo-500"></i>
                                <span><?php echo e($tourPackage->location); ?></span>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tourPackage->pickup_time): ?>
                            <div class="flex items-center gap-3">
                                <i class="fas fa-route text-emerald-500"></i>
                                <span><?php echo e($tourPackage->pickup_time); ?></span>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="space-y-3">
                        <a href="<?php echo e(route('checkout.index', $tourPackage)); ?>" class="flex w-full items-center justify-center gap-2 rounded-2xl bg-blue-950 px-5 py-3.5 text-base font-bold text-white shadow-sm transition hover:bg-blue-900">
                            <i class="fas fa-shopping-cart"></i>
                            Book Now
                        </a>
                        <a href="https://wa.me/6281266718008?text=<?php echo e(urlencode('Hello, I am interested in the ' . $tourPackage->title)); ?>" target="_blank" class="flex w-full items-center justify-center gap-2 rounded-2xl border border-green-500 px-5 py-3 text-base font-bold text-green-600 transition hover:bg-green-50">
                            <i class="fab fa-whatsapp"></i>
                            WhatsApp
                        </a>
                    </div>

                    <div class="mt-5 rounded-2xl border border-dashed border-yellow-300 bg-yellow-50 p-4 text-sm text-yellow-800">
                        <div class="font-bold">Why travelers choose this</div>
                        <ul class="mt-2 space-y-2 text-xs leading-6">
                            <li>• Instant booking confirmation</li>
                            <li>• Local guide and flexible pickup</li>
                            <li>• Family-friendly and custom group options</li>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>




<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($related->isNotEmpty()): ?>
<section class="py-14 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <h2 class="text-xl md:text-2xl font-bold text-gray-800 brand-font mb-6 md:mb-8 text-center md:text-left">
            Other Packages <span class="text-yellow-600"><?php echo e($tourPackage->category->name); ?></span>
        </h2>

        <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-7">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pkg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <article class="bg-gray-50 rounded-xl md:rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 group flex flex-col">
                
                <a href="<?php echo e(route('tour.show', $pkg)); ?>" class="block relative h-36 md:h-52 overflow-hidden">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pkg->thumbnail): ?>
                        <img src="<?php echo e($pkg->thumbnail_url); ?>" alt="<?php echo e($pkg->title); ?>"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <?php elseif($pkg->images->isNotEmpty()): ?>
                        <img src="<?php echo e($pkg->images->first()->image_url); ?>" alt="<?php echo e($pkg->title); ?>"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <?php else: ?>
                        <div class="w-full h-full bg-gradient-to-br from-yellow-300 to-orange-400 flex items-center justify-center">
                            <i class="fas fa-image text-white text-3xl opacity-40"></i>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pkg->discounted_price && $pkg->discounted_price < $pkg->price): ?>
                        <span class="absolute top-2 right-2 bg-red-500 text-white text-[10px] md:text-xs font-bold px-2 py-0.5 rounded-full shadow-sm">
                            Disc
                        </span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </a>

                <div class="p-3 md:p-5 flex flex-col flex-grow">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pkg->duration): ?>
                        <p class="text-[10px] md:text-xs text-gray-400 mb-1 flex items-center gap-1">
                            <i class="fas fa-clock"></i> <?php echo e($pkg->duration); ?>

                        </p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <h3 class="font-bold text-gray-800 text-xs md:text-base leading-snug mb-1.5 group-hover:text-yellow-600 transition-colors line-clamp-2 h-[2.6em] md:h-[3em]">
                        <a href="<?php echo e(route('tour.show', $pkg)); ?>">
                            <?php echo e($pkg->title); ?>

                        </a>
                    </h3>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pkg->description): ?>
                        <p class="text-gray-500 text-[10px] md:text-sm leading-relaxed mb-3 md:mb-4 line-clamp-2">
                            <?php echo e($pkg->description); ?>

                        </p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <div class="mt-auto flex items-center justify-between pt-3 border-t border-gray-200/60">
                        <div class="flex flex-col">
                            <?php
                                $allRelPrices = collect([
                                    $pkg->price_2_4,
                                    $pkg->price_5_7,
                                    $pkg->price_8_14
                                ])->filter(fn($price) => $price > 0);

                                $lowestRelPrice = $allRelPrices->min();
                            ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($lowestRelPrice): ?>
                                <span class="text-[9px] md:text-[10px] text-gray-400 uppercase font-bold -mb-1">
                                    Starts From
                                </span>
                                <p class="text-xs md:text-lg font-bold text-yellow-700 leading-tight">
                                    Rp <?php echo e(number_format($lowestRelPrice, 0, ',', '.')); ?>

                                </p>
                            <?php else: ?>
                                <p class="text-[10px] md:text-sm text-gray-400 italic font-medium">Get in Touch</p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        
                        <a href="<?php echo e(route('tour.show', $pkg)); ?>"
                            class="text-[10px] md:text-xs bg-yellow-600 hover:bg-yellow-700 text-white font-semibold px-2 py-1.5 md:px-3 md:py-2 rounded-lg transition-colors">
                            Details
                        </a>
                    </div>
                </div>
            </article>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>

    </div>
</section>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>




<div id="lightbox" class="fixed inset-0 z-50 bg-black/90 items-center justify-center p-4"
    onclick="closeLightbox(event)">
    <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white text-3xl hover:text-yellow-400 z-10">
        <i class="fas fa-times"></i>
    </button>
    <button onclick="prevPhoto()"
        class="absolute left-4 top-1/2 -translate-y-1/2 text-white text-3xl hover:text-yellow-400 z-10 px-3 py-2">
        <i class="fas fa-chevron-left"></i>
    </button>
    <button onclick="nextPhoto()"
        class="absolute right-4 top-1/2 -translate-y-1/2 text-white text-3xl hover:text-yellow-400 z-10 px-3 py-2">
        <i class="fas fa-chevron-right"></i>
    </button>
    <img id="lightboxImg" src="" alt="" class="max-w-full max-h-[85vh] object-contain rounded-xl shadow-2xl"
        onclick="event.stopPropagation()">
    <p id="lightboxCounter" class="absolute bottom-4 left-1/2 -translate-x-1/2 text-white/60 text-sm"></p>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // ── Thumbnail switch ──────────────────────────────
    let currentIndex = 0;
    const photos = <?php echo json_encode($allImages -> pluck('src'), 15, 512) ?>;
    const totalPhotos = photos.length;

    function switchPhoto(src, index) {
        document.getElementById('mainPhoto').src = src;
        currentIndex = index;

        document.querySelectorAll('.gallery-thumb').forEach((el, i) => {
            el.classList.toggle('border-yellow-500', i === index);
            el.classList.toggle('border-transparent', i !== index);
        });
    }

    // ── Lightbox ─────────────────────────────────────
    function openLightbox(index) {
        currentIndex = index;
        document.getElementById('lightbox').classList.add('open');
        updateLightbox();
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox(e) {
        if (e && e.target !== document.getElementById('lightbox')) return;
        document.getElementById('lightbox').classList.remove('open');
        document.body.style.overflow = '';
    }

    function updateLightbox() {
        document.getElementById('lightboxImg').src = photos[currentIndex];
        document.getElementById('lightboxCounter').textContent = `${currentIndex + 1} / ${totalPhotos}`;
    }

    function prevPhoto() {
        currentIndex = (currentIndex - 1 + totalPhotos) % totalPhotos;
        updateLightbox();
        switchPhoto(photos[currentIndex], currentIndex);
    }

    function nextPhoto() {
        currentIndex = (currentIndex + 1) % totalPhotos;
        updateLightbox();
        switchPhoto(photos[currentIndex], currentIndex);
    }

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (!document.getElementById('lightbox').classList.contains('open')) return;
        if (e.key === 'ArrowLeft') prevPhoto();
        if (e.key === 'ArrowRight') nextPhoto();
        if (e.key === 'Escape') closeLightbox();
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/dwiki/Documents/website/blissinbali/resources/views/tour/show.blade.php ENDPATH**/ ?>