<nav id="mainNav"
    class="fixed top-0 left-0 w-full z-50 transition-all duration-500
           bg-transparent border-b border-transparent py-4">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16 items-center">

            
            
            
            <div class="flex-shrink-0 flex items-center">

                <a
                    href="<?php echo e(url('/')); ?>"
                    id="navLogo"
                    class="brand-font text-2xl font-bold tracking-tight
                           text-white flex items-center gap-3
                           group transition-colors duration-300"
                >

                    <div
                        class="bg-white/10 backdrop-blur-sm p-1.5 rounded-xl
                               border border-white/10
                               group-hover:bg-orange-500
                               group-hover:border-orange-400
                               group-hover:-translate-y-0.5
                               transition-all duration-300 shadow-lg"
                    >
                        <img
                            src="<?php echo e(asset('/logo.png')); ?>"
                            alt="Bliss in Bali"
                            class="h-8 w-8 object-contain"
                        >
                    </div>

                    <span class="hidden sm:block">
                        Bliss
                        <span id="navLogoBali" class="text-orange-400">
                            Bali
                        </span>
                        Tours
                    </span>

                </a>

            </div>


            
            
            
            <div
                id="searchWrapper"
                class="hidden md:flex flex-1 ml-8 lg:ml-16
                       justify-end transition-all duration-500"
            >

                <form
                    id="searchForm"
                    action="<?php echo e(route('search')); ?>"
                    method="GET"
                    class="relative w-full max-w-md
                           flex items-center
                           transition-all duration-500 ease-in-out"
                >

                    <div
                        id="searchBox"
                        class="relative w-full flex items-center
                               bg-white/10 backdrop-blur-md
                               rounded-full overflow-hidden
                               border border-white/20
                               shadow-lg shadow-black/5
                               transition-all duration-500"
                    >

                        
                        
                        
                        <div
                            id="searchIcon"
                            class="pl-5 pr-3 text-white
                                   transition-colors duration-300"
                        >
                            <i class="fas fa-search text-sm"></i>
                        </div>


                        
                        
                        
                        <input
                            id="searchInput"
                            type="text"
                            name="q"
                            autocomplete="off"
                            class="w-full py-3 bg-transparent border-none
                                   focus:outline-none focus:ring-0
                                   text-white
                                   placeholder-white/60
                                   text-sm font-medium"
                            placeholder="Search destinations, activities..."
                        >


                        
                        
                        
                        <button
                            type="submit"
                            id="searchButton"
                            class="group relative flex items-center
                                   justify-center gap-2
                                   min-w-[115px]
                                   h-full
                                   px-6
                                   bg-orange-500
                                   hover:bg-orange-400
                                   active:bg-orange-600
                                   text-white
                                   font-semibold
                                   text-sm
                                   rounded-r-full
                                   transition-all duration-300
                                   overflow-hidden
                                   shadow-lg
                                   shadow-orange-500/20
                                   hover:shadow-orange-500/40
                                   hover:-translate-y-[1px]"
                        >

                            
                            <span
                                class="absolute inset-0
                                       bg-gradient-to-r
                                       from-transparent
                                       via-white/20
                                       to-transparent
                                       -translate-x-full
                                       group-hover:translate-x-full
                                       transition-transform duration-700"
                            ></span>


                            
                            <i
                                class="fas fa-search text-xs
                                       relative z-10
                                       transition-transform duration-300
                                       group-hover:scale-110"
                            ></i>


                            
                            <span class="relative z-10">
                                Search
                            </span>

                        </button>

                    </div>


                    
                    
                    
                    <div
                        id="autocompleteDropdown"
                        class="hidden absolute top-full left-0 right-0 mt-2
                               bg-white rounded-2xl shadow-2xl
                               border border-gray-100
                               overflow-hidden z-50"
                    >
                    </div>

                </form>

            </div>


            
            
            
            <div class="flex items-center md:hidden ml-4">

                <button
                    type="button"
                    id="mobileMenuBtn"
                    class="w-11 h-11 rounded-xl
                           border border-white/20
                           bg-white/10 backdrop-blur-sm
                           text-white
                           hover:bg-orange-500
                           hover:border-orange-400
                           focus:outline-none
                           transition-all duration-300"
                >

                    <i
                        id="mobileMenuIcon"
                        class="fas fa-bars text-lg"
                    ></i>

                </button>

            </div>

        </div>

    </div>


    
    
    
    <div
        id="mobileMenu"
        class="hidden md:hidden transition-all duration-300"
    >

        <div
            id="mobileMenuInner"
            class="mx-4 mb-4 rounded-2xl
                   bg-[#0B1F3A]/95 backdrop-blur-xl
                   border border-white/10
                   p-4 space-y-4
                   shadow-2xl"
        >

            
            
            
            <form
                action="<?php echo e(route('search')); ?>"
                method="GET"
                class="flex items-center
                       bg-white/10 rounded-full overflow-hidden
                       border border-white/20"
            >

                <div class="pl-4 pr-2 text-gray-400">
                    <i class="fas fa-search text-sm"></i>
                </div>

                <input
                    type="text"
                    name="q"
                    class="w-full py-3 bg-transparent border-none
                           focus:outline-none focus:ring-0
                           text-white
                           placeholder-gray-500
                           text-sm"
                    placeholder="Search destinations..."
                >

                <button
                    type="submit"
                    class="group flex items-center gap-2
                           bg-orange-500
                           hover:bg-orange-400
                           active:bg-orange-600
                           text-white
                           px-5 py-3
                           text-sm font-semibold
                           transition-all duration-300
                           whitespace-nowrap"
                >

                    <i
                        class="fas fa-search text-xs
                               transition-transform duration-300
                               group-hover:scale-110"
                    ></i>

                    <span>
                        Search
                    </span>

                </button>

            </form>

        </div>

    </div>

</nav>


<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ============================================================
       ELEMENTS
    ============================================================ */

    const nav = document.getElementById('mainNav');

    const navLogo = document.getElementById('navLogo');
    const navLogoBali = document.getElementById('navLogoBali');

    const navPackages = document.getElementById('navPackages');

    const searchInput = document.getElementById('searchInput');
    const searchBox = document.getElementById('searchBox');
    const searchForm = document.getElementById('searchForm');
    const searchIcon = document.getElementById('searchIcon');
    const searchButton = document.getElementById('searchButton');

    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenuIcon = document.getElementById('mobileMenuIcon');
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileMenuInner = document.getElementById('mobileMenuInner');

    const dropdown = document.getElementById('autocompleteDropdown');


    /* ============================================================
       SCROLL HANDLER
    ============================================================ */

    function handleScroll() {

        const scrolled = window.scrollY > 50;


        /* --------------------------------------------------------
           NAVBAR
        -------------------------------------------------------- */

        nav.classList.toggle(
            'bg-[#087F91]/95',
            scrolled
        );

        nav.classList.toggle(
            'backdrop-blur-xl',
            scrolled
        );

        nav.classList.toggle(
            'shadow-xl',
            scrolled
        );

        nav.classList.toggle(
            'border-[#1A3557]',
            scrolled
        );

        nav.classList.toggle(
            'py-2',
            scrolled
        );


        nav.classList.toggle(
            'bg-transparent',
            !scrolled
        );

        nav.classList.toggle(
            'border-transparent',
            !scrolled
        );

        nav.classList.toggle(
            'py-4',
            !scrolled
        );


        /* --------------------------------------------------------
           LOGO
        -------------------------------------------------------- */

        navLogo.classList.add('text-white');

        navLogoBali.classList.add('text-orange-400');


        /* --------------------------------------------------------
           PACKAGES
        -------------------------------------------------------- */

        navPackages?.classList.toggle(
            'text-white',
            !scrolled
        );

        navPackages?.classList.toggle(
            'text-orange-400',
            scrolled
        );


        /* --------------------------------------------------------
           MOBILE BUTTON
        -------------------------------------------------------- */

        mobileMenuBtn?.classList.toggle(
            'text-white',
            !scrolled
        );

        mobileMenuBtn?.classList.toggle(
            'bg-white/10',
            !scrolled
        );


        /* --------------------------------------------------------
           MOBILE MENU
        -------------------------------------------------------- */

        if (scrolled) {

            mobileMenuInner.classList.remove(
                'bg-white/10',
                'border-white/20'
            );

            mobileMenuInner.classList.add(
                'bg-[#087F91]/95',
                'border-white/10',
                'shadow-2xl'
            );

        } else {

            mobileMenuInner.classList.add(
                'bg-[#0B1F3A]/95',
                'border-white/10'
            );

            mobileMenuInner.classList.remove(
                'bg-white',
                'border-gray-100',
                'shadow-lg'
            );

        }


        /* --------------------------------------------------------
           SEARCH BOX
        -------------------------------------------------------- */

        /*
         * Jangan mengubah search box ketika sedang focus.
         * Supaya background putih tetap dipertahankan.
         */

        if (document.activeElement !== searchInput) {

            if (scrolled) {

                searchBox.classList.remove(
                    'bg-white/20',
                    'border-white/30'
                );

                searchBox.classList.add(
                    'bg-white/10',
                    'border-white/10'
                );

            } else {

                searchBox.classList.add(
                    'bg-white/10',
                    'border-white/20'
                );

                searchBox.classList.remove(
                    'bg-gray-100',
                    'border-gray-200'
                );

            }

        }

    }


    window.addEventListener(
        'scroll',
        handleScroll
    );

    handleScroll();


    /* ============================================================
       MOBILE MENU TOGGLE
    ============================================================ */

    mobileMenuBtn.addEventListener('click', () => {

        const isOpen =
            !mobileMenu.classList.contains('hidden');


        mobileMenu.classList.toggle(
            'hidden',
            isOpen
        );


        mobileMenuIcon.classList.toggle(
            'fa-bars',
            isOpen
        );

        mobileMenuIcon.classList.toggle(
            'fa-times',
            !isOpen
        );

    });


    /* ============================================================
       CLOSE MOBILE MENU AFTER CLICK
    ============================================================ */

    mobileMenu.querySelectorAll('a').forEach(link => {

        link.addEventListener('click', () => {

            mobileMenu.classList.add('hidden');

            mobileMenuIcon.classList.add('fa-bars');

            mobileMenuIcon.classList.remove('fa-times');

        });

    });


    /* ============================================================
       SEARCH FOCUS ANIMATION
    ============================================================ */

    searchInput.addEventListener('focus', () => {

        /* Expand Search */

        searchForm.classList.replace(
            'max-w-md',
            'max-w-5xl'
        );


        /* Search Box */

        searchBox.classList.add(
            'bg-white',
            'border-orange-400',
            'shadow-orange-500/10'
        );

        searchBox.classList.remove(
            'bg-white/10',
            'border-white/20',
            'border-white/10'
        );


        /* Input */

        searchInput.classList.replace(
            'text-white',
            'text-gray-800'
        );

        searchInput.classList.replace(
            'placeholder-white/60',
            'placeholder-gray-400'
        );


        /* Icon */

        searchIcon.classList.replace(
            'text-white',
            'text-gray-400'
        );


        /* Button */

        searchButton.classList.add(
            'shadow-orange-500/40'
        );

    });


    /* ============================================================
       SEARCH BLUR
    ============================================================ */

    searchInput.addEventListener('blur', () => {

        setTimeout(() => {

            dropdown.classList.add('hidden');


            /* Restore Width */

            searchForm.classList.replace(
                'max-w-5xl',
                'max-w-md'
            );


            /* Restore Search Box */

            searchBox.classList.remove(
                'bg-white',
                'border-orange-400',
                'shadow-orange-500/10'
            );


            searchBox.classList.add(
                'bg-white/10',
                'border-white/20'
            );


            /* Restore Input */

            searchInput.classList.replace(
                'text-gray-800',
                'text-white'
            );

            searchInput.classList.replace(
                'placeholder-gray-400',
                'placeholder-white/60'
            );


            /* Restore Icon */

            searchIcon.classList.replace(
                'text-gray-400',
                'text-white'
            );


            /* Restore Button Shadow */

            searchButton.classList.remove(
                'shadow-orange-500/40'
            );

        }, 200);

    });


    /* ============================================================
       AUTOCOMPLETE
    ============================================================ */

    let debounceTimer;


    searchInput.addEventListener(
        'input',
        function () {

            clearTimeout(debounceTimer);

            const q = this.value.trim();


            if (q.length < 2) {

                dropdown.classList.add('hidden');

                return;

            }


            debounceTimer = setTimeout(() => {

                fetch(
                    `/search/autocomplete?q=${encodeURIComponent(q)}`
                )

                .then(response => response.json())

                .then(data => {

                    renderDropdown(data, q);

                })

                .catch(() => {

                    dropdown.classList.add('hidden');

                });

            }, 300);

        }
    );


    /* ============================================================
       RENDER AUTOCOMPLETE
    ============================================================ */

    function renderDropdown(data, q) {

        if (
            !data.packages?.length &&
            !data.categories?.length
        ) {

            dropdown.classList.add('hidden');

            return;

        }


        let html = '';


        /* ========================================================
           CATEGORIES
        ======================================================== */

        if (data.categories?.length) {

            html += `
                <div
                    class="px-4 pt-3 pb-1
                           text-xs font-bold
                           text-gray-400 uppercase
                           tracking-wider"
                >
                    Categories
                </div>
            `;


            data.categories.forEach(cat => {

                html += `
                    <a
                        href="/tour-packages?category=${cat.slug}"
                        class="flex items-center gap-3
                               px-4 py-2.5
                               hover:bg-orange-50
                               transition-colors"
                    >

                        <div
                            class="w-7 h-7
                                   bg-orange-100
                                   rounded-lg
                                   flex items-center
                                   justify-center
                                   flex-shrink-0"
                        >

                            <i
                                class="fas fa-tag
                                       text-orange-600 text-xs"
                            ></i>

                        </div>


                        <span
                            class="text-sm font-semibold
                                   text-gray-700"
                        >
                            ${cat.name}
                        </span>


                        <span
                            class="ml-auto
                                   text-xs text-gray-400"
                        >
                            ${cat.packages_count} packages
                        </span>

                    </a>
                `;

            });

        }


        /* ========================================================
           PACKAGES
        ======================================================== */

        if (data.packages?.length) {

            html += `
                <div
                    class="px-4 pt-3 pb-1
                           text-xs font-bold
                           text-gray-400 uppercase
                           tracking-wider
                           border-t border-gray-50"
                >
                    Packages
                </div>
            `;


            data.packages.forEach(pkg => {

                const price = pkg.price_2_4
                    ? `Rp ${Number(pkg.price_2_4)
                        .toLocaleString('id-ID')}`
                    : 'Contact Us';


                html += `
                    <a
                        href="/tour-packages/${pkg.slug}"
                        class="flex items-center gap-3
                               px-4 py-2.5
                               hover:bg-orange-50
                               transition-colors"
                    >

                        <div
                            class="w-10 h-10
                                   rounded-xl
                                   overflow-hidden
                                   bg-gray-100
                                   flex-shrink-0"
                        >

                            ${
                                pkg.thumbnail
                                ? `
                                    <img
                                        src="/storage/${pkg.thumbnail}"
                                        class="w-full h-full object-cover"
                                        alt="${pkg.title}"
                                    >
                                `
                                : `
                                    <div
                                        class="w-full h-full
                                               bg-gradient-to-br
                                               from-orange-300
                                               to-orange-500
                                               flex items-center
                                               justify-center"
                                    >

                                        <i
                                            class="fas fa-image
                                                   text-white text-xs"
                                        ></i>

                                    </div>
                                `
                            }

                        </div>


                        <div
                            class="flex-1 min-w-0"
                        >

                            <p
                                class="text-sm font-semibold
                                       text-gray-800 truncate"
                            >
                                ${pkg.title}
                            </p>


                            <p
                                class="text-xs text-gray-400"
                            >
                                ${pkg.location ??
                                  pkg.category_name ??
                                  ''}
                            </p>

                        </div>


                        <span
                            class="text-xs font-bold
                                   text-orange-600
                                   flex-shrink-0"
                        >
                            ${price}
                        </span>

                    </a>
                `;

            });

        }


        /* ========================================================
           SEE ALL RESULTS
        ======================================================== */

        html += `
            <div
                class="border-t border-gray-100
                       px-4 py-3"
            >

                <a
                    href="/search?q=${encodeURIComponent(q)}"
                    class="group flex items-center
                           justify-center gap-2
                           text-sm
                           text-orange-600
                           font-semibold
                           hover:text-orange-700
                           transition-colors"
                >

                    <i
                        class="fas fa-search text-xs
                               transition-transform
                               duration-300
                               group-hover:scale-110"
                    ></i>

                    <span>
                        See all results for "${q}"
                    </span>

                    <i
                        class="fas fa-arrow-right text-xs
                               transition-transform
                               duration-300
                               group-hover:translate-x-1"
                    ></i>

                </a>

            </div>
        `;


        dropdown.innerHTML = html;

        dropdown.classList.remove('hidden');

    }


    /* ============================================================
       CLOSE DROPDOWN OUTSIDE
    ============================================================ */

    document.addEventListener('click', (e) => {

        if (!e.target.closest('#searchForm')) {

            dropdown.classList.add('hidden');

        }

    });

});
</script><?php /**PATH /home/dwiki/Documents/website/blissinbali/resources/views/partials/front-navbar.blade.php ENDPATH**/ ?>