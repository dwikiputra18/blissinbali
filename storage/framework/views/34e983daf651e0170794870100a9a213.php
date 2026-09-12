<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    
    
    <?php
        // $__env->yieldContent() adalah cara yang benar untuk membaca @section value
        // di dalam blok PHP pada layout Blade.
        $ogTitle       = trim($__env->yieldContent('og_title',       'Bliss in Bali - Your Best Travel Partner'));
        $ogDescription = trim($__env->yieldContent('og_description', 'Discover the best Bali tours and activities with Bliss in Bali. Book your adventure today!'));
        $ogImage       = trim($__env->yieldContent('og_image',        url('logo.png')));
        $ogUrl         = trim($__env->yieldContent('og_url',          url()->current()));
        $ogType        = trim($__env->yieldContent('og_type',         'website'));

        // Fallback jika section kosong setelah trim
        if (blank($ogTitle))       { $ogTitle       = 'Bliss in Bali - Your Best Travel Partner'; }
        if (blank($ogDescription)) { $ogDescription = 'Discover the best Bali tours and activities with Bliss in Bali. Book your adventure today!'; }
        if (blank($ogImage))       { $ogImage       = url('logo.png'); }
        if (blank($ogUrl))         { $ogUrl         = url()->current(); }
        if (blank($ogType))        { $ogType        = 'website'; }
    ?>

    <title><?php echo e($ogTitle); ?></title>
    <meta name="description" content="<?php echo e($ogDescription); ?>">
    <link rel="canonical" href="<?php echo e($ogUrl); ?>">

    
    <meta property="og:type"        content="<?php echo e($ogType); ?>">
    <meta property="og:site_name"   content="Bliss in Bali">
    <meta property="og:title"       content="<?php echo e($ogTitle); ?>">
    <meta property="og:description" content="<?php echo e($ogDescription); ?>">
    <meta property="og:url"         content="<?php echo e($ogUrl); ?>">
    <meta property="og:image"       content="<?php echo e($ogImage); ?>">
    <meta property="og:image:width"  content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale"      content="id_ID">

    
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="<?php echo e($ogTitle); ?>">
    <meta name="twitter:description" content="<?php echo e($ogDescription); ?>">
    <meta name="twitter:image"       content="<?php echo e($ogImage); ?>">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Swiper CSS for Hero Slider -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&family=Playfair+Display:wght@500;600;700&display=swap');
        body {
            font-family: 'Montserrat', sans-serif;
        }
        h1, h2, h3, h4, h5, h6, .brand-font {
            font-family: 'Playfair Display', serif;
        }

        .gate-intro {
            position: fixed;
            inset: 0;
            z-index: 100;
            display: grid;
            place-items: center;
            overflow: hidden;
            background: #fffaf2;
            transition: visibility 0s linear 1.5s;
        }

        .gate-intro.is-opened {
            visibility: hidden;
        }

        .gate-panel {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 50%;
            background: linear-gradient(145deg, #00a7b5, #087f91);
            transition: transform 1.25s cubic-bezier(.77, 0, .18, 1);
        }

        .gate-panel::after {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            width: 1px;
            background: rgba(255, 255, 255, .7);
        }

        .gate-panel-left {
            left: 0;
        }

        .gate-panel-left::after {
            right: 0;
        }

        .gate-panel-right {
            right: 0;
            background: linear-gradient(145deg, #f57c00, #d85600);
        }

        .gate-panel-right::after {
            left: 0;
        }

        .gate-intro.is-opened .gate-panel-left {
            transform: translateX(-100%);
        }

        .gate-intro.is-opened .gate-panel-right {
            transform: translateX(100%);
        }

        .gate-content {
            position: relative;
            z-index: 1;
            display: grid;
            justify-items: center;
            gap: 14px;
            color: #102a43;
            text-align: center;
            transition: opacity .35s ease, transform .6s ease;
        }

        .gate-intro.is-opening .gate-content {
            opacity: 0;
            transform: translateY(-18px) scale(.97);
        }

        .gate-logo {
            width: min(245px, 58vw);
            height: auto;
            filter: drop-shadow(0 16px 22px rgba(16, 42, 67, .18));
        }

        .gate-kicker {
            color: #7b2c83;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .24em;
            text-transform: uppercase;
        }

        .gate-skip {
            position: absolute;
            right: 24px;
            bottom: 24px;
            z-index: 2;
            border: 1px solid rgba(16, 42, 67, .28);
            border-radius: 8px;
            padding: 9px 14px;
            color: #102a43;
            font: 600 11px 'Montserrat', sans-serif;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .gate-loader {
            display: flex;
            gap: 5px;
            height: 18px;
            align-items: end;
        }

        .gate-loader span {
            width: 5px;
            height: 8px;
            border-radius: 999px;
            animation: gatePulse 1s ease-in-out infinite;
        }

        .gate-loader span:nth-child(1) { background: #f57c00; }
        .gate-loader span:nth-child(2) { background: #00a7b5; animation-delay: .12s; }
        .gate-loader span:nth-child(3) { background: #7b2c83; animation-delay: .24s; }
        .gate-loader span:nth-child(4) { background: #2f8b57; animation-delay: .36s; }

        @keyframes gatePulse {
            0%, 100% { height: 8px; opacity: .45; }
            50% { height: 18px; opacity: 1; }
        }

        @media (prefers-reduced-motion: reduce) {
            .gate-intro,
            .gate-panel,
            .gate-content {
                transition: none;
            }
        }

        :root {
            --ink: #102a43;
            --ink-soft: #486581;
            --orange: #f57c00;
            --turquoise: #00a7b5;
            --logo-blue: #00a7b5;
            --logo-blue-dark: #087f91;
            --purple: #7b2c83;
            --green: #2f8b57;
            --coral: #f57c00;
            --coral-dark: #d85600;
            --sand: #f7f3ec;
            --mist: #e8f0ef;
            --line: #d9e2e8;
        }

        body.page-home,
        body.page-tour-index,
        body.page-tour-show {
            background: var(--sand);
            color: var(--ink);
        }

        body.page-home h1,
        body.page-home h2,
        body.page-home h3,
        body.page-home h4,
        body.page-tour-index h1,
        body.page-tour-index h2,
        body.page-tour-index h3,
        body.page-tour-show h1,
        body.page-tour-show h2,
        body.page-tour-show h3 {
            letter-spacing: -.02em;
        }

        body.page-home #mainNav,
        body.page-tour-index #mainNav,
        body.page-tour-show #mainNav {
            background: rgba(8, 127, 145, .96);
            border-bottom-color: rgba(255, 255, 255, .12);
            backdrop-filter: blur(16px);
        }

        body.page-home footer,
        body.page-tour-index footer,
        body.page-tour-show footer {
            background: var(--logo-blue-dark);
        }

        body.page-home footer .text-orange-400,
        body.page-tour-index footer .text-orange-400,
        body.page-tour-show footer .text-orange-400 {
            color: #79e7ed;
        }

        body.page-home footer a:hover,
        body.page-tour-index footer a:hover,
        body.page-tour-show footer a:hover {
            color: #ffffff;
        }

        body.page-home #mainNav #searchBox,
        body.page-tour-index #mainNav #searchBox,
        body.page-tour-show #mainNav #searchBox {
            background: rgba(255, 255, 255, .09);
            border-color: rgba(255, 255, 255, .22);
        }

        body.page-home #mainNav #searchButton,
        body.page-tour-index #mainNav #searchButton,
        body.page-tour-show #mainNav #searchButton {
            background: var(--coral);
        }

        body.page-home .home-hero {
            height: min(78vh, 780px);
            min-height: 560px;
        }

        body.page-home .home-hero::after {
            content: '';
            position: absolute;
            inset: auto 0 0;
            height: 34%;
            background: linear-gradient(transparent, rgba(16, 42, 67, .74));
            pointer-events: none;
            z-index: 2;
        }

        body.page-home .home-hero .swiper-slide > img {
            filter: saturate(.82) contrast(1.05);
        }

        body.page-home .home-hero .swiper-slide > div:nth-child(2) {
            background: linear-gradient(90deg, rgba(16, 42, 67, .78), rgba(16, 42, 67, .12) 72%, transparent);
        }

        body.page-home .home-hero .swiper-slide > div:last-child {
            align-items: flex-start;
            text-align: left;
            max-width: 1280px;
            margin: auto;
        }

        body.page-home .home-hero .swiper-slide > div:last-child h1 {
            max-width: 720px;
            font-size: clamp(2.6rem, 6vw, 6rem);
            line-height: .98;
        }

        body.page-home .home-hero .swiper-slide > div:last-child a {
            background: var(--coral);
            border-radius: 6px;
            box-shadow: 0 14px 28px rgba(231, 111, 81, .24);
        }

        body.page-home main > section {
            background: var(--sand);
        }

        body.page-home main > section:nth-of-type(2n) {
            background: var(--mist);
        }

        body.page-home main .package-card,
        body.page-home main article.group,
        body.page-home main section .bg-white.rounded-2xl {
            border: 1px solid var(--line);
            border-radius: 8px;
            box-shadow: 0 12px 30px rgba(16, 42, 67, .08);
        }

        body.page-home main .package-card:hover,
        body.page-home main article.group:hover {
            box-shadow: 0 18px 38px rgba(16, 42, 67, .14);
        }

        body.page-home #destinasi > div.relative.z-10 > .destination-grid {
            grid-template-columns: repeat(4, minmax(0, 1fr));
            grid-template-rows: auto repeat(3, minmax(150px, 1fr));
            grid-auto-flow: row;
        }

        body.page-home #destinasi > div.relative.z-10 > .destination-grid > :first-child {
            grid-column: 1 / -1 !important;
            grid-row: 1 !important;
            align-items: flex-start;
            text-align: left;
            max-width: none;
            margin-bottom: 1.25rem;
        }

        body.page-home #destinasi > div.relative.z-10 > .destination-grid > :nth-child(2) {
            grid-column: 1 / span 2 !important;
            grid-row: 2 / span 2 !important;
        }

        body.page-home #destinasi > div.relative.z-10 > .destination-grid > article:nth-child(n + 3) a {
            aspect-ratio: 4 / 3;
        }

        body.page-home #destinasi > div.relative.z-10 > .destination-grid > article:nth-child(n + 3) h4 {
            color: var(--ink);
        }

        body.page-home #destinasi > div.relative.z-10 > .destination-grid > article:nth-child(n + 3) a.inline-flex {
            background: var(--turquoise);
        }

        body.page-home main a.bg-yellow-600,
        body.page-home main a.bg-blue-600,
        body.page-home main a.bg-indigo-600 {
            background: var(--ink);
        }

        body.page-tour-index main > section:first-child {
            background: var(--ink);
            padding-top: 11rem;
            padding-bottom: 7rem;
        }

        body.page-tour-index main > section:first-child > div:first-child {
            opacity: .12;
        }

        body.page-tour-index main > section:first-child h1 {
            font-size: clamp(2.7rem, 7vw, 6rem);
            letter-spacing: -.05em;
        }

        body.page-tour-index main > section:first-child p:first-child {
            color: #f2b5a6;
        }

        body.page-tour-index main > section:nth-of-type(2) {
            background: var(--sand);
        }

        body.page-tour-index #packagesGrid > article {
            border: 1px solid var(--line);
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 10px 24px rgba(16, 42, 67, .07);
        }

        body.page-tour-index #packagesGrid > article:hover {
            box-shadow: 0 18px 36px rgba(16, 42, 67, .14);
        }

        body.page-tour-index .cat-btn.active,
        body.page-tour-index .subcat-btn.active {
            background: var(--coral);
            border-color: var(--coral);
        }

        body.page-tour-index main > section:last-child {
            background: var(--coral-dark);
        }

        body.page-tour-show main > div:first-child {
            background: var(--ink);
            border-color: rgba(255, 255, 255, .1);
            padding-top: 7rem;
        }

        body.page-tour-show main > div:first-child nav,
        body.page-tour-show main > div:first-child nav a {
            color: #d9e2e8;
        }

        body.page-tour-show main > section:first-of-type {
            background: var(--sand);
        }

        body.page-tour-show main > section:first-of-type > div > div > div,
        body.page-tour-show main > section:first-of-type aside > div {
            border-radius: 8px;
            box-shadow: 0 14px 34px rgba(16, 42, 67, .09);
        }

        body.page-tour-show .activity-card {
            background: #fff;
            border-color: var(--line);
        }

        body.page-tour-show .activity-card h1 {
            color: var(--ink);
        }

        body.page-tour-show aside > div {
            border-top: 4px solid var(--coral);
        }

        body.page-tour-show aside a.bg-blue-950 {
            background: var(--ink);
        }

        body.page-tour-show aside a.bg-blue-950:hover {
            background: #1d4568;
        }

        @media (max-width: 767px) {
            body.page-home .home-hero {
                min-height: 560px;
                height: 72vh;
            }

            body.page-home .home-hero .swiper-slide > div:last-child {
                padding-left: 1.25rem;
                padding-right: 1.25rem;
            }

            body.page-tour-index main > section:first-child {
                padding-top: 9rem;
            }

            body.page-home #destinasi > div.relative.z-10 > .destination-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                grid-template-rows: auto;
            }

            body.page-home #destinasi > div.relative.z-10 > .destination-grid > :first-child,
            body.page-home #destinasi > div.relative.z-10 > .destination-grid > :nth-child(2) {
                grid-column: 1 / -1 !important;
                grid-row: auto !important;
            }

            body.page-home #destinasi > div.relative.z-10 > .destination-grid > :first-child {
                align-items: center;
                text-align: center;
            }
        }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="bg-[#F8F9FA] text-[#1A1A1A] antialiased overflow-x-hidden selection:bg-[#C68A36] selection:text-white <?php echo e(request()->routeIs('tour.index') ? 'page-tour-index' : (request()->routeIs('tour.show') ? 'page-tour-show' : (request()->routeIs('home') || request()->is('/') ? 'page-home' : ''))); ?>">

    <div id="gateIntro" class="gate-intro" aria-label="Welcome to Bliss in Bali">
        <div class="gate-panel gate-panel-left" aria-hidden="true"></div>
        <div class="gate-panel gate-panel-right" aria-hidden="true"></div>
        <div class="gate-content">
            <img src="<?php echo e(asset('logo.png')); ?>" alt="Bliss in Bali" class="gate-logo">
            <span class="gate-kicker">Discover Bali, your way</span>
            <div class="gate-loader" aria-hidden="true"><span></span><span></span><span></span><span></span></div>
        </div>
        <button id="gateSkip" type="button" class="gate-skip">Skip intro</button>
    </div>
    
    <?php echo $__env->make('partials.front-navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <?php echo $__env->make('partials.front-footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    
    <?php if (isset($component)) { $__componentOriginal4378b2eccec4e8470841be6441e66765 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4378b2eccec4e8470841be6441e66765 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.whatsapp-button','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('whatsapp-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4378b2eccec4e8470841be6441e66765)): ?>
<?php $attributes = $__attributesOriginal4378b2eccec4e8470841be6441e66765; ?>
<?php unset($__attributesOriginal4378b2eccec4e8470841be6441e66765); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4378b2eccec4e8470841be6441e66765)): ?>
<?php $component = $__componentOriginal4378b2eccec4e8470841be6441e66765; ?>
<?php unset($__componentOriginal4378b2eccec4e8470841be6441e66765); ?>
<?php endif; ?>
    
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        (function () {
            const intro = document.getElementById('gateIntro');
            const skip = document.getElementById('gateSkip');
            const introSeenKey = 'blissinbali-gate-intro-seen';

            if (!intro) return;

            const closeIntro = () => {
                intro.classList.add('is-opening');
                window.setTimeout(() => intro.classList.add('is-opened'), 80);
                window.setTimeout(() => intro.remove(), 1700);
                localStorage.setItem(introSeenKey, '1');
            };

            if (localStorage.getItem(introSeenKey) === '1' || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                intro.remove();
                return;
            }

            skip.addEventListener('click', closeIntro);
            window.setTimeout(closeIntro, 1800);
        })();

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH /home/dwiki/Documents/website/blissinbali/resources/views/layouts/front.blade.php ENDPATH**/ ?>