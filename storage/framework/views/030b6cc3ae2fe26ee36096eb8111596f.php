<?php $__env->startSection('title', 'About Us | Bliss in Bali'); ?>

<?php $__env->startSection('content'); ?>
<div class="pt-32 pb-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-orange-500 font-bold uppercase tracking-wider text-sm">About Us</span>
            <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 brand-font mt-2 mb-4">About Bliss in Bali</h1>
            <div class="w-24 h-1 bg-yellow-500 rounded-full mx-auto"></div>
        </div>

        <div class="bg-gray-50 p-8 md:p-12 rounded-3xl shadow-sm border border-gray-100 flex flex-col md:flex-row gap-8 items-start">
            <div class="md:w-1/3 flex-shrink-0">
                <img src="<?php echo e(asset('/logo-footer.PNG')); ?>" alt="Bliss in Bali Logo" class="w-full h-auto rounded-xl object-contain bg-white pb-1 pt-1 pl-4 pr-4 shadow-sm border border-gray-200">
            </div>
            <div class="md:w-2/3 prose prose-lg prose-indigo max-w-none text-gray-600">
                <p>Welcome to <strong>Bliss in Bali</strong>, your trusted travel partner in discovering the magic, serenity, and vibrant culture of Bali. We are a professional travel agency dedicated to delivering personalized, high-quality, and enriching travel experiences that go far beyond the ordinary.</p>
                <p>Bali is a land of breathtaking landscapes, sacred traditions, and warm hospitality — and at Bliss in Bali, we make it our mission to help you experience it in the most authentic, comfortable, and meaningful way possible. Whether you're seeking relaxation, adventure, spiritual awakening, or romantic moments, we offer a diverse range of services tailored to meet every traveler’s needs and desires.</p>
                <p>Every journey with us is crafted with passion and precision. From hidden waterfalls tucked deep in the emerald jungles to iconic golden sunsets over ancient coastal temples, we don't just show you Bali—we immerse you in its beautiful soul.</p>
                <p>Our team of knowledgeable local guides brings every destination to life with fascinating stories, rich history, and insider tips. With us, you're not just a tourist; you're a welcomed guest exploring the <em>Island of the Gods</em> with trusted friends. Let us handle all the details while you focus on creating memories that will last a lifetime. Your unforgettable Bali adventure starts right here!</p>
                
                <div class="mt-8 pt-6 border-t border-gray-200 flex flex-col sm:flex-row items-center gap-4">
                    <span class="text-gray-900 font-bold brand-font text-xl">Follow Our Journey:</span>
                    <div class="flex items-center gap-3">
                        <a href="https://www.tiktok.com/@blissinbali" target="_blank" rel="noopener noreferrer" aria-label="TikTok" class="w-12 h-12 rounded-full border border-gray-300 flex items-center justify-center text-gray-500 hover:text-white hover:border-black hover:bg-black transition-all duration-300 shadow-sm hover:shadow-md">
                            <i class="fab fa-tiktok text-xl"></i>
                        </a>
                        <a href="https://www.instagram.com/blissinbali" target="_blank" rel="noopener noreferrer" aria-label="Instagram"
                        class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center text-gray-500 hover:text-orange-500 hover:border-orange-400 hover:bg-orange-50 transition-all duration-300">
                        <i class="fab fa-instagram text-base"></i>
                        </a>
                        <a href="https://www.facebook.com/people/Bliss-Bali-Tours/61591537294816/" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="w-12 h-12 rounded-full border border-gray-300 flex items-center justify-center text-gray-500 hover:text-white hover:border-blue-950 hover:bg-blue-950 transition-all duration-300 shadow-sm hover:shadow-md">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" target="_blank" rel="noopener noreferrer" aria-label="YouTube"
                        class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center text-gray-500 hover:text-red-500 hover:border-red-400 hover:bg-red-50 transition-all duration-300">
                        <i class="fab fa-youtube text-base"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/dwiki/Documents/website/blissinbali/resources/views/pages/about.blade.php ENDPATH**/ ?>