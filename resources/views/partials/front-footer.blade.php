{{-- resources/views/components/footer.blade.php --}}

<footer class="bg-[#087F91] text-gray-300 pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ========================================================= --}}
        {{-- ① CONTACT US - HORIZONTAL --}}
        {{-- ========================================================= --}}
        <div class="mb-14">

            {{-- Logo + Title --}}
            <div class="flex flex-col md:flex-row md:items-center gap-6 mb-8">

                {{-- Logo --}}
                <a
                    href="{{ url('/') }}"
                    class="inline-flex items-center no-underline group flex-shrink-0"
                >
                    <div
                        class="bg-white/95 p-2 rounded-xl shadow-lg shadow-black/20
                               group-hover:shadow-orange-500/20
                               transition-all duration-300"
                    >
                        <img
                            src="{{ asset('/logo-footer.PNG') }}"
                            alt="Bliss in Bali"
                            class="h-24 w-32 object-contain"
                        >
                    </div>
                </a>

                {{-- Contact Title --}}
                <div>
                    <h4
                        class="text-sm font-bold text-white uppercase
                               tracking-[0.18em] mb-2"
                    >
                        Contact Us
                    </h4>

                    <p class="text-gray-400 text-sm">
                        Get in touch with us for your Bali journey.
                    </p>
                </div>

            </div>


            {{-- Contact Information Horizontal (Minimalist & Natural) --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-6 sm:gap-8">

    {{-- Address --}}
    <div class="flex items-start gap-3">
        <i class="fas fa-map-marker-alt text-orange-400 text-base mt-0.5 flex-shrink-0"></i>
        <div>
            <span class="block text-xs uppercase tracking-wider text-gray-400 mb-1">
                Address
            </span>
            <p class="text-gray-300 text-sm leading-relaxed">
                South Denpasar, Denpasar City,<br>
                Bali 80224, Indonesia
            </p>
        </div>
    </div>

    {{-- Phone --}}
    <div class="flex items-start gap-3">
        <i class="fas fa-phone text-orange-400 text-base mt-0.5 flex-shrink-0"></i>
        <div>
            <span class="block text-xs uppercase tracking-wider text-gray-400 mb-1">
                Phone
            </span>
            <a href="tel:+628216087623" class="text-gray-300 text-sm hover:text-orange-400 transition-colors">
                +628216087623
            </a>
        </div>
    </div>

    {{-- Email --}}
    <div class="flex items-start gap-3 min-w-0">
        <i class="fas fa-envelope text-orange-400 text-base mt-0.5 flex-shrink-0"></i>
        <div class="min-w-0">
            <span class="block text-xs uppercase tracking-wider text-gray-400 mb-1">
                Email
            </span>
            <a
                href="mailto:blissinbali92@gmail.com"
                class="text-gray-300 text-sm hover:text-orange-400 transition-colors break-all"
            >
                blissinbali92@gmail.com
            </a>
        </div>
    </div>

</div>
        </div>


        {{-- Decorative Divider --}}
        <div
            class="h-px bg-gradient-to-r
                   from-transparent via-white/10 to-transparent mb-12"
        ></div>


        {{-- ========================================================= --}}
        {{-- ② FOOTER CONTENT --}}
        {{-- ========================================================= --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 lg:gap-16">


            {{-- ===================================================== --}}
            {{-- ABOUT --}}
            {{-- ===================================================== --}}
            <div>

                <h3
                    class="text-sm font-bold text-white mb-7 uppercase
                           tracking-[0.18em]"
                >
                    About
                </h3>

                <ul class="space-y-5">

                    {{-- Terms --}}
                    <li>
                        <a
                            href="{{ route('terms') }}"
                            class="group flex items-center gap-3
                                   text-gray-400 hover:text-white
                                   transition-all duration-300 text-sm"
                        >
                            <span
                                class="w-5 h-5 rounded-full border border-gray-600
                                       group-hover:border-orange-400
                                       group-hover:bg-orange-400
                                       flex items-center justify-center
                                       transition-all duration-300"
                            >
                                <i
                                    class="fas fa-chevron-right text-[8px]
                                           group-hover:text-[#0B1F3A]"
                                ></i>
                            </span>

                            Terms &amp; Conditions
                        </a>
                    </li>


                    {{-- Help Center --}}
                    <li>
                        <a
                            href="{{ route('help') }}"
                            class="group flex items-center gap-3
                                   text-gray-400 hover:text-white
                                   transition-all duration-300 text-sm"
                        >
                            <span
                                class="w-5 h-5 rounded-full border border-gray-600
                                       group-hover:border-orange-400
                                       group-hover:bg-orange-400
                                       flex items-center justify-center
                                       transition-all duration-300"
                            >
                                <i
                                    class="fas fa-chevron-right text-[8px]
                                           group-hover:text-[#0B1F3A]"
                                ></i>
                            </span>

                            Help Center
                        </a>
                    </li>


                    {{-- About Us --}}
                    <li>
                        <a
                            href="{{ route('about') }}"
                            class="group flex items-center gap-3
                                   text-gray-400 hover:text-white
                                   transition-all duration-300 text-sm"
                        >
                            <span
                                class="w-5 h-5 rounded-full border border-gray-600
                                       group-hover:border-orange-400
                                       group-hover:bg-orange-400
                                       flex items-center justify-center
                                       transition-all duration-300"
                            >
                                <i
                                    class="fas fa-chevron-right text-[8px]
                                           group-hover:text-[#0B1F3A]"
                                ></i>
                            </span>

                            About Us
                        </a>
                    </li>

                </ul>

            </div>


            {{-- ===================================================== --}}
            {{-- FOLLOW US --}}
            {{-- ===================================================== --}}
            <div>

                <h3
                    class="text-sm font-bold text-white mb-7 uppercase
                           tracking-[0.18em]"
                >
                    Follow Us On
                </h3>

                <p class="text-gray-400 text-sm leading-relaxed mb-6">
                    Follow our journey and discover beautiful experiences
                    from Bali.
                </p>


                {{-- Social Media --}}
                <div class="flex items-center gap-3 flex-wrap">

                    {{-- TikTok --}}
                    <a
                        href="https://www.tiktok.com/@blissinbali"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="TikTok"
                        class="w-11 h-11 rounded-xl border border-white/10
                               bg-white/5 flex items-center justify-center
                               text-gray-400 hover:text-white
                               hover:border-orange-400 hover:bg-orange-500
                               hover:-translate-y-1
                               transition-all duration-300"
                    >
                        <i class="fab fa-tiktok text-base"></i>
                    </a>


                    {{-- Facebook --}}
                    <a
                        href="https://www.facebook.com/share/1AfJNHonWe/?mibextid=wwXIfr"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="Facebook"
                        class="w-11 h-11 rounded-xl border border-white/10
                               bg-white/5 flex items-center justify-center
                               text-gray-400 hover:text-white
                               hover:border-orange-400 hover:bg-orange-500
                               hover:-translate-y-1
                               transition-all duration-300"
                    >
                        <i class="fab fa-facebook-f text-base"></i>
                    </a>


                    {{-- Instagram --}}
                    <a
                        href="https://www.instagram.com/blissinbali/"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="Instagram"
                        class="w-11 h-11 rounded-xl border border-white/10
                               bg-white/5 flex items-center justify-center
                               text-gray-400 hover:text-white
                               hover:border-orange-400 hover:bg-orange-500
                               hover:-translate-y-1
                               transition-all duration-300"
                    >
                        <i class="fab fa-instagram text-base"></i>
                    </a>


                    {{-- YouTube --}}
                    <a
                        href="https://www.youtube.com/@blissinbali"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="YouTube"
                        class="w-11 h-11 rounded-xl border border-white/10
                               bg-white/5 flex items-center justify-center
                               text-gray-400 hover:text-white
                               hover:border-orange-400 hover:bg-orange-500
                               hover:-translate-y-1
                               transition-all duration-300"
                    >
                        <i class="fab fa-youtube text-base"></i>
                    </a>

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- ACCEPTED PAYMENT --}}
            {{-- ===================================================== --}}
            <div>

                <h3
                    class="text-sm font-bold text-white mb-7 uppercase
                           tracking-[0.18em]"
                >
                    Accepted Payment
                </h3>

                <p class="text-gray-400 text-sm leading-relaxed mb-6">
                    We accept secure and convenient payment methods.
                </p>


                <div class="flex items-center gap-3 flex-wrap">

                    {{-- Mastercard --}}
                    <div
                        class="bg-white rounded-lg px-3 py-2
                               flex items-center justify-center
                               h-11 min-w-[62px]
                               shadow-lg shadow-black/10"
                    >
                        <div class="flex items-center">
                            <div class="w-6 h-6 rounded-full bg-red-600"></div>

                            <div
                                class="w-6 h-6 rounded-full bg-yellow-400
                                       -ml-3 opacity-90"
                            ></div>
                        </div>
                    </div>


                    {{-- Visa --}}
                    <div
                        class="bg-white rounded-lg px-3 py-2
                               flex items-center justify-center
                               h-11 min-w-[62px]
                               shadow-lg shadow-black/10"
                    >
                        <span
                            class="font-bold text-lg tracking-tight"
                            style="color:#1a1f71; font-family:serif;"
                        >
                            VISA
                        </span>
                    </div>


                    {{-- JCB Logo (Presisi & Tajam) --}}
                    <div
                        class="bg-white rounded-lg px-3 py-2
                               flex items-center justify-center
                               h-11 min-w-[62px]
                               shadow-lg shadow-black/10"
                        aria-label="JCB"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 432.37 324.5"><defs><style>.a{fill:url(#a);}.b{fill:url(#b);}.c{fill:url(#c);}.d{fill:url(#d);}.e{fill:url(#e);}</style><linearGradient id="a" x1="148.19" y1="270.12" x2="213.35" y2="270.12" gradientTransform="matrix(2.05, 0, 0, -2.05, -4.47, 736.29)" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#007940"/><stop offset="0.23" stop-color="#00873f"/><stop offset="0.74" stop-color="#40a737"/><stop offset="1" stop-color="#5cb531"/></linearGradient><linearGradient id="b" x1="148.18" y1="280.2" x2="213.29" y2="280.2" xlink:href="#a"/><linearGradient id="c" x1="148.18" y1="291.29" x2="213.35" y2="291.29" xlink:href="#a"/><linearGradient id="d" x1="2.3" y1="280.27" x2="68.47" y2="280.27" gradientTransform="matrix(2.05, 0, 0, -2.05, -4.47, 736.29)" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#1f286f"/><stop offset="0.48" stop-color="#004e94"/><stop offset="0.83" stop-color="#0066b1"/><stop offset="1" stop-color="#006fbc"/></linearGradient><linearGradient id="e" x1="74.89" y1="280.13" x2="139.16" y2="280.13" gradientTransform="matrix(2.05, 0, 0, -2.05, -4.47, 736.29)" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#6c2c2f"/><stop offset="0.17" stop-color="#882730"/><stop offset="0.57" stop-color="#be1833"/><stop offset="0.86" stop-color="#dc0436"/><stop offset="1" stop-color="#e60039"/></linearGradient></defs><title>jcb</title><path class="a" d="M325.69,197h31.2c.89,0,3-.3,3.86-.3a13.92,13.92,0,0,0,11-14,14.41,14.41,0,0,0-11-14,15.52,15.52,0,0,0-3.86-.3h-31.2V197Z"/><path class="b" d="M353.32,0a54.09,54.09,0,0,0-54.08,54.08v56.17h76.37a31.36,31.36,0,0,1,5.35.29c17.24.9,30,9.81,30,25.26,0,12.19-8.61,22.59-24.66,24.67v.59c17.53,1.19,30.9,11,30.9,26.15,0,16.35-14.85,27-34.47,27h-83.8v110h79.35a54.09,54.09,0,0,0,54.08-54.08V0Z"/><path class="c" d="M367.89,139.37a12.65,12.65,0,0,0-11-12.78c-.59,0-2.08-.3-3-.3H325.69v26.15h28.23c.89,0,2.67,0,3-.29A12.66,12.66,0,0,0,367.89,139.37Z"/><path class="d" d="M54.38,0A54.08,54.08,0,0,0,.3,54.08V187.51c15.15,7.43,30.9,12.18,46.65,12.18,18.72,0,28.83-11.29,28.83-26.74V110h46.35v62.7c0,24.37-15.15,44.28-66.56,44.28A228,228,0,0,1,0,210.09V323.91H79.34a54.09,54.09,0,0,0,54.09-54.09V0Z"/><path class="e" d="M203.85,0a54.09,54.09,0,0,0-54.08,54.08v70.73c13.67-11.59,37.44-19,75.78-17.24,20.5.89,42.49,6.54,42.49,6.54V137c-11-5.64-24.07-10.7-41-11.89-29.12-2.08-46.65,12.19-46.65,37.15,0,25.26,17.53,39.52,46.65,37.14,16.94-1.18,30-6.53,41-11.88v22.88s-21.69,5.65-42.49,6.54c-38.34,1.78-62.11-5.65-75.78-17.24V324.5h79.34a54.08,54.08,0,0,0,54.08-54.08V0Z"/></svg>
                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- BOTTOM DIVIDER --}}
        {{-- ========================================================= --}}
        <div
            class="mt-14 h-px bg-gradient-to-r
                   from-transparent via-white/10 to-transparent"
        ></div>


        {{-- ========================================================= --}}
        {{-- BOTTOM BAR --}}
        {{-- ========================================================= --}}
        <div
            class="pt-7 flex flex-col md:flex-row
                   justify-between items-center
                   text-sm text-gray-500 gap-5"
        >

            {{-- Copyright --}}
            <p class="text-center md:text-left leading-relaxed">

                &copy; {{ date('Y') }} Bliss in Bali.
                All rights reserved.

                <span class="hidden md:inline mx-2 text-gray-700">
                    |
                </span>

                <span class="block md:inline mt-1 md:mt-0">

                    Created by

                    <a
                        href="https://wiklycode.vercel.app/"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="text-orange-400 hover:text-orange-300
                               transition-colors duration-200
                               font-semibold"
                    >
                        WiklyCode.dev
                    </a>

                </span>

            </p>


            {{-- Bottom Links --}}
            <div
                class="flex flex-wrap justify-center
                       gap-x-6 gap-y-2"
            >

                <a
                    href="{{ route('terms') }}"
                    class="hover:text-orange-400
                           transition-colors duration-200"
                >
                    Terms &amp; Conditions
                </a>

                <a
                    href="#"
                    class="hover:text-orange-400
                           transition-colors duration-200"
                >
                    Privacy Policy
                </a>

                <a
                    href="{{ route('help') }}"
                    class="hover:text-orange-400
                           transition-colors duration-200"
                >
                    Help Center
                </a>

            </div>

        </div>

    </div>
</footer>
