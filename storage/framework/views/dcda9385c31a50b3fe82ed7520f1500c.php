<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($banners->count() >= 3): ?>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    <div class="home-hero relative w-full h-[420px] md:h-screen min-h-[420px] md:min-h-[500px] overflow-hidden">
        <div class="swiper myHeroSwiper h-full w-full">
            <div class="swiper-wrapper">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <div class="swiper-slide relative">
                    <img src="<?php echo e(asset('storage/' . $banner->image)); ?>"
                         class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/60 to-transparent"></div>

                    <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-4 pt-12 md:pt-0">
                        <span class="text-orange-400 font-bold uppercase tracking-widest text-xs md:text-base mb-2 md:mb-3 drop-shadow-md">
                            <?php echo e($banner->subtitle); ?>

                        </span>
                        <h1 class="text-3xl md:text-7xl font-extrabold text-white mb-4 md:mb-6 drop-shadow-xl leading-tight">
                            <?php echo e($banner->title); ?><br>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r <?php echo e($banner->gradient_color); ?>">
                                <?php echo e($banner->highlight_text); ?>

                            </span>
                        </h1>
                        <p class="text-sm md:text-2xl text-gray-200 mb-6 md:mb-10 max-w-2xl drop-shadow-lg font-light line-clamp-2 md:line-clamp-none">
                            <?php echo e($banner->description); ?>

                        </p>
                        <a href="<?php echo e($banner->button_link); ?>"
                           class="bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-2.5 px-8 md:py-4 md:px-10 rounded-full shadow-xl transition-all duration-300 text-sm md:text-base">
                            <?php echo e($banner->button_text ?? 'Selengkapnya'); ?>

                        </a>
                    </div>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>

            
            <div class="swiper-pagination"></div>


        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const heroSwiper = new Swiper('.myHeroSwiper', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            speed: 800,
            effect: 'fade',
            fadeEffect: {
                crossFade: true,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },

        });
    </script>

<?php else: ?>
    <div class="h-[500px] flex items-center justify-center bg-gray-200 text-gray-500">
        Silakan tambahkan minimal 3 banner di Admin Panel.
    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?><?php /**PATH /home/dwiki/Documents/website/blissinbali/resources/views/partials/hero-slider.blade.php ENDPATH**/ ?>