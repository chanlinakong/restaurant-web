<nav
    class="sticky top-0 z-50 bg-[#faf8f5]/90 dark:bg-gray-900/90 backdrop-blur-md border-b border-gray-200/60 dark:border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">

        <!-- 1. Left: Logo -->
        <a href="{{ route('menu.index') }}" class="flex items-center gap-2.5">
            <div class="w-10 h-10 rounded-full bg-amber-400 flex items-center justify-center shadow-md">
                <span class="text-xl">🍴</span>
            </div>
            <span class="font-extrabold text-2xl tracking-tight text-gray-900 dark:text-white">Bites</span>
        </a>

        <!-- 2. Center: Navigation Links -->
        <div class="hidden md:flex items-center gap-8 font-semibold text-sm text-gray-600 dark:text-gray-300">
            <a href="#about" class="hover:text-amber-500 transition">{{ __('About Us') }}</a>
            <a href="#menu" class="hover:text-amber-500 transition">{{ __('Menu') }}</a>
            <a href="#reviews" class="hover:text-amber-500 transition">{{ __('Reviews') }}</a>
            <a href="#blog" class="hover:text-amber-500 transition">{{ __('Blog') }}</a>
            <a href="#contacts" class="hover:text-amber-500 transition">{{ __('Contacts') }}</a>
        </div>

        <!-- 3. Right: Action Controls (Language, Dark Mode, Cart) -->
        <div class="flex items-center gap-3">

            <!-- Language Switcher Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                    class="px-3.5 py-2 rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-xs font-semibold flex items-center gap-2 shadow-sm hover:border-amber-400 transition">
                    <svg class="w-4 h-4 text-sky-500 dark:text-sky-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 21a9 9 0 100-18 9 9 0 000 18zm0 0c2.21 0 4-4.03 4-9s-1.79-9-4-9-4 4.03-4 9 1.79 9 4 9zM3 12h18" />
                    </svg>

                    <span>
                        {{ app()->getLocale() == 'km' ? 'KH' : 'EN' }}
                    </span>
                </button>

                <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    class="absolute right-0 mt-2 w-32 bg-white dark:bg-gray-800 rounded-xl shadow-xl border border-gray-200 dark:border-gray-700 py-1.5 z-50 text-xs font-medium">

                    <a href="{{ route('lang.switch', 'en') }}"
                        class="flex items-center gap-2 px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <!-- UK Flag -->
                        <svg class="w-5 h-5 rounded-sm" viewBox="0 0 60 30">
                            <rect width="60" height="30" fill="#012169" />
                            <path d="M0 0L60 30M60 0L0 30" stroke="white" stroke-width="6" />
                            <path d="M0 0L60 30M60 0L0 30" stroke="#C8102E" stroke-width="2" />
                            <path d="M30 0V30M0 15H60" stroke="white" stroke-width="10" />
                            <path d="M30 0V30M0 15H60" stroke="#C8102E" stroke-width="6" />
                        </svg>
                        English
                    </a>

                    <a href="{{ route('lang.switch', 'km') }}"
                        class="flex items-center gap-2 px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <!-- Cambodia Flag -->
                        <svg class="w-5 h-5 rounded-sm" viewBox="0 0 60 40">
                            <rect width="60" height="10" fill="#032EA1" />
                            <rect y="10" width="60" height="20" fill="#E00025" />
                            <rect y="30" width="60" height="10" fill="#032EA1" />
                            <path d="M20 26L22 18L25 15L28 18L30 12L32 18L35 15L38 18L40 26Z" fill="white" />
                        </svg>

                        Khmer
                    </a>

                </div>
            </div>

            <!-- Dark Mode Switcher -->
            <button @click="darkMode = !darkMode; localStorage.setItem('theme', darkMode ? 'dark' : 'light')"
                class="p-2.5 rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 hover:bg-amber-50 dark:hover:bg-gray-700 shadow-sm transition">
                <svg x-show="!darkMode" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
                <svg x-show="darkMode" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </button>

            <!-- Cart Badge Icon -->
            <a href="{{ route('checkout.index') }}"
                class="relative p-2.5 rounded-xl bg-amber-400 text-gray-900 shadow-md shadow-amber-400/20 hover:bg-amber-500 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <span x-text="$store.cart.totalItems" x-show="$store.cart.totalItems > 0"
                    class="absolute -top-1.5 -right-1.5 bg-gray-900 text-amber-400 text-[10px] font-black w-5 h-5 rounded-full border-2 border-white dark:border-gray-900 flex items-center justify-center">
                </span>
            </a>

            @auth

                <!-- User Dropdown -->
                <div class="relative" x-data="{ open: false }">

                    <button @click="open = !open" class="flex items-center gap-2 px-3 py-2 rounded-xl
                   bg-white dark:bg-gray-800
                   border border-gray-200 dark:border-gray-700
                   text-sm font-semibold
                   text-gray-700 dark:text-gray-200
                   hover:border-amber-400 transition">

                        <!-- Avatar -->
                        <div
                            class="w-8 h-8 rounded-full bg-amber-400 flex items-center justify-center text-gray-900 font-bold overflow-hidden">

                            @if(auth()->user()->profile_image)

                                <img src="{{ asset('images/profiles/' . auth()->user()->profile_image) }}"
                                    alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">

                            @else

                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                            @endif

                        </div>


                        <!-- Name -->
                        <span>
                            {{ auth()->user()->name }}
                        </span>


                        <!-- Arrow -->
                        <svg class="w-4 h-4 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />

                        </svg>

                    </button>


                    <!-- Dropdown -->
                    <div x-show="open" @click.away="open=false" x-transition class="absolute right-0 mt-2 w-48
                   bg-white dark:bg-gray-800
                   rounded-xl shadow-xl
                   border border-gray-200 dark:border-gray-700
                   py-2 z-50">

                        <!-- Profile -->
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2
                       text-sm text-gray-700 dark:text-gray-200
                       hover:bg-gray-100 dark:hover:bg-gray-700">

                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 12a4 4 0 100-8 4 4 0 000 8z" />

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 20a8 8 0 0116 0" />

                            </svg>

                            Profile

                        </a>


                        @if(auth()->user()->isCustomer())

                            <a href="{{ route('orders.index') }}" class="flex items-center gap-2 px-4 py-2
                               text-sm text-gray-700 dark:text-gray-200
                               hover:bg-gray-100 dark:hover:bg-gray-700">

                                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 14h6m-6-4h6m2-6H7a2 2 0 00-2 2v16l3-2 3 2 3-2 3 2 3-2V6a2 2 0 00-2-2z" />

                                </svg>

                                My Orders

                            </a>

                        @endif


                        <div class="border-t border-gray-200 dark:border-gray-700 my-2"></div>


                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">

                            @csrf

                            <button type="submit" class="w-full flex items-center gap-2 px-4 py-2
                           text-sm text-red-500
                           hover:bg-red-50 dark:hover:bg-gray-700">

                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />

                                </svg>

                                Logout

                            </button>

                        </form>

                    </div>

                </div>



            @else


                <!-- Login Button -->
                <a href="{{ route('login') }}" class="px-5 py-2.5 rounded-xl
                        bg-amber-400 
                        text-gray-900
                        font-bold text-sm
                        shadow-md shadow-amber-400/20
                        hover:bg-amber-500 transition">

                    Login

                </a>


            @endauth

            <!-- <a href="{{ route('orders.index') }}"
                class="text-sm font-semibold text-gray-600 dark:text-gray-300 hover:text-amber-500">
                My Orders
            </a> -->

            <!-- @auth

                @if(auth()->user()->isCustomer())

                    <a href="{{ route('orders.index') }}"
                        class="text-sm font-semibold text-gray-600 dark:text-gray-300 hover:text-amber-500">

                        My Orders

                    </a>

                @endif

            @endauth -->
        </div>
    </div>
</nav>