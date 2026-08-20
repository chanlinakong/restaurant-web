<x-app-layout title="Bites - Restaurant & Service">

    <!-- 1. Hero Section -->
    <section id="home"
        class="relative bg-amber-100/40 dark:bg-gray-800/50 rounded-3xl p-8 lg:p-12 mb-16 overflow-hidden flex flex-col lg:flex-row items-center justify-between gap-8 border border-amber-200/50 dark:border-gray-700">
        <div class="max-w-lg">
            <h1 class="text-4xl lg:text-5xl font-black text-gray-900 dark:text-white leading-tight mb-4">
                {{ __('We Serve The Taste You Love') }} 😍
            </h1>
            <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed mb-6">
                {{ __('This is a type of restaurant which typically serves food and drinks, in addition to light refreshments such as baked goods or snacks.') }}
            </p>
            <div class="flex items-center gap-4">
                <a href="#menu"
                    class="bg-amber-400 hover:bg-amber-500 text-gray-900 font-bold px-6 py-3 rounded-full text-sm shadow-md transition">
                    {{ __('Explore Food') }}
                </a>
                <button
                    class="bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-800 dark:text-white font-bold px-5 py-3 rounded-full text-sm shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Search
                </button>
            </div>
        </div>

        <div class="relative w-72 h-72 lg:w-96 lg:h-96 flex items-center justify-center">
            <!-- Glowing Orange Background Circle -->
            <div class="absolute inset-0 bg-amber-400/40 rounded-full blur-2xl transform scale-110"></div>

            <!-- Dish Image shifted to the left -->
            <img src="{{ asset('images/hero-salad1.png') }}" alt="Featured Dish"
                class="relative z-10 w-full h-full object-contain scale-125 -translate-x-8 lg:-translate-x-14 drop-shadow-2xl">
        </div>
    </section>

    <!-- 2. Menu Section -->
    <section id="menu" class="mb-20" x-data="{ selectedCategory: 'all' }">

        <h2 class="text-2xl font-black text-gray-900 dark:text-white mb-2">
            {{ __('Popular Dishes') }}
        </h2>


        <x-category-bar :categories="$categories" />


        <div class="
        max-h-[70vh]
        overflow-y-auto
        pr-3

        scrollbar-thin
        scrollbar-thumb-amber-400
        scrollbar-track-gray-100

        dark:scrollbar-track-gray-800
        ">

            <div class="
            grid
            grid-cols-1
            sm:grid-cols-2
            lg:grid-cols-3
            xl:grid-cols-4

            gap-6
            ">

                @foreach($menuItems as $item)

                    <div x-show="
                            selectedCategory === 'all'
                            ||
                            selectedCategory == '{{ $item->category_id }}'
                            " x-transition>

                        <x-menu-card :item="$item" />

                    </div>

                @endforeach


            </div>

        </div>


    </section>

    <!-- 3. About Us / Multiple Services Section -->
    <section id="about" class="mb-20 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="relative flex justify-center">
            <div
                class="w-72 h-72 lg:w-96 lg:h-96 rounded-full overflow-hidden border-8 border-white dark:border-gray-800 shadow-2xl">
                <img src="{{ asset('images/chef-main.jpg') }}" alt="Head Chef" class="w-full h-full object-cover">
            </div>
        </div>
        <div>
    <h2 class="text-3xl font-black text-gray-900 dark:text-white mb-4">
        {{ __('We Are More Than Multiple Service') }}
    </h2>

    <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed mb-8">
        {{ __('This is a type of restaurant which typically serves food and drinks, in addition to light refreshments such as baked goods or snacks. The term comes from the French word meaning food.') }}
    </p>

    <div class="grid grid-cols-2 gap-6 text-sm font-bold text-gray-800 dark:text-gray-200">

        <!-- Online Order -->
        <div class="flex items-center gap-3">
            <span class="w-8 h-8 rounded-full bg-amber-100 dark:bg-gray-700 text-amber-600 flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 7h13M7 13l-2-8" />
                </svg>
            </span>

            <span>{{ __('Online Order') }}</span>
        </div>

        <!-- Reservation -->
        <div class="flex items-center gap-3">
            <span class="w-8 h-8 rounded-full bg-amber-100 dark:bg-gray-700 text-amber-600 flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3M5 11h14M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </span>

            <span>{{ __('Pre-Reservation') }}</span>
        </div>

        <!-- 24/7 Service -->
        <div class="flex items-center gap-3">
            <span class="w-8 h-8 rounded-full bg-amber-100 dark:bg-gray-700 text-amber-600 flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </span>

            <span>{{ __('24/7 Service') }}</span>
        </div>

        <!-- Super Chefs -->
        <div class="flex items-center gap-3">
            <span class="w-8 h-8 rounded-full bg-amber-100 dark:bg-gray-700 text-amber-600 flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 14c3 0 5-2 5-5a5 5 0 00-10 0c0 3 2 5 5 5zm0 0v7m-4 0h8" />
                </svg>
            </span>

            <span>{{ __('Super Chefs') }}</span>
        </div>

    </div>
</div>
    </section>

    <!-- 4. Customer Reviews Section -->
    <section id="reviews" class="mb-20">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-2xl font-black text-gray-900 dark:text-white">What Our Customer Says?</h2>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @for($i = 0; $i < 3; $i++)
                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm">
                    <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed mb-6">
                        "This place is great! Atmosphere is chill and cool and the staff is also really friendly. They know
                        what they're doing and what they're serving, and you can tell making the customers happy is their
                        main priority."
                    </p>
                    <div class="flex items-center gap-3">
                        <img src="https://i.pravatar.cc/100?img={{ $i + 10 }}" class="w-10 h-10 rounded-full object-cover">
                        <div>
                            <h4 class="text-xs font-bold text-gray-900 dark:text-white">Savannah Nguyen</h4>
                            <span class="text-[10px] text-gray-400">Food Critic</span>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </section>

    <!-- 5. Blog / Our Chefs Section -->
    <section id="blog" class="mb-20">
        <h2 class="text-2xl font-black text-gray-900 dark:text-white mb-8">
            {{ __('Meet Our Chefs') }}
        </h2>

        @php
            $chefs = [
                [
                    'name' => 'Savannah Nguyen',
                    'image' => 'https://images.unsplash.com/photo-1600565193348-f74bd3c7ccdf?auto=format&fit=crop&w=600&q=80',
                ],
                [
                    'name' => 'Esther Howard',
                    'image' => 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?auto=format&fit=crop&w=600&q=80',
                ],
                [
                    'name' => 'Marvin McKinney',
                    'image' => 'https://images.unsplash.com/photo-1577219491135-ce391730fb2c?auto=format&fit=crop&w=600&q=80',
                ],
                [
                    'name' => 'Albert Flores',
                    'image' => 'https://images.unsplash.com/photo-1512485800893-b08ec1ea59b1?auto=format&fit=crop&w=600&q=80',
                ],
            ];
        @endphp

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($chefs as $chef)
                <div
                    class="bg-white dark:bg-gray-800 p-4 rounded-3xl border border-gray-100 dark:border-gray-700 text-center shadow-sm hover:shadow-lg transition-all duration-300">

                    <div class="h-52 rounded-2xl overflow-hidden mb-4 bg-gray-100 dark:bg-gray-700">
                        <img src="{{ $chef['image'] }}" alt="{{ $chef['name'] }}"
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                    </div>

                    <h3 class="font-bold text-sm text-gray-900 dark:text-white">
                        {{ $chef['name'] }}
                    </h3>

                    <span class="text-xs text-amber-500 font-medium">
                        {{  __('Master Chef')}}
                    </span>
                </div>
            @endforeach
        </div>
    </section>

</x-app-layout>