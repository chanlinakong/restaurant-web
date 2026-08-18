<section id="menu" class="mb-20" x-data="{ selectedCategory: 'food' }">
    <!-- Section Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">Popular Dishes</h2>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Check out our most ordered items this week</p>
        </div>

        <!-- Scroll Controls (Optional visual detail matching image) -->
        <div class="hidden sm:flex items-center gap-2">
            <button class="w-9 h-9 rounded-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 flex items-center justify-center hover:bg-amber-400 hover:text-gray-900 transition">
                ←
            </button>
            <button class="w-9 h-9 rounded-full bg-amber-400 text-gray-900 flex items-center justify-center shadow-md hover:bg-amber-500 transition">
                →
            </button>
        </div>
    </div>

    <!-- 3 Categories Filter Bar (Food, Drink, Sweet) -->
    <div class="overflow-x-auto no-scrollbar py-2 mb-8">
        <div class="flex gap-3 min-w-max">
            @php
                $categories = [
                    ['id' => 'food', 'label' => __('Food'), 'icon' => '🍜'],
                    ['id' => 'drink', 'label' => __('Drink'), 'icon' => '🧋'],
                    ['id' => 'sweet', 'label' => __('Sweet'), 'icon' => '🍨']
                ];
            @endphp

            @foreach($categories as $category)
                <button 
                    @click="selectedCategory = '{{ $category['id'] }}'"
                    :class="selectedCategory === '{{ $category['id'] }}' 
                        ? 'bg-amber-400 text-gray-900 font-bold shadow-lg shadow-amber-400/25 scale-105' 
                        : 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 hover:bg-amber-50 dark:hover:bg-gray-700 font-medium'"
                    class="flex items-center gap-2.5 px-6 py-2.5 rounded-2xl transition-all duration-200 text-sm border border-amber-100/60 dark:border-gray-700">
                    <span class="text-lg">{{ $category['icon'] }}</span>
                    <span>{{ $category['label'] }}</span>
                </button>
            @endforeach
        </div>
    </div>

    <!-- Dish Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($menuItems as $item)
            <div x-show="selectedCategory === '{{ $item->category }}'" x-transition>
                <div class="bg-white dark:bg-gray-800 rounded-3xl p-5 shadow-sm hover:shadow-xl transition-all duration-300 border border-amber-100/50 dark:border-gray-700/60 flex flex-col justify-between group h-full">
                    <div>
                        <!-- Dish Image & Preparation Time Badge -->
                        <div class="relative w-full h-44 mb-4 flex items-center justify-center overflow-hidden rounded-2xl bg-amber-50/50 dark:bg-gray-700/30">
                            <img src="{{ asset($item->image) }}" alt="{{ $item->name }}" class="h-36 w-36 object-contain group-hover:scale-105 transition-transform duration-300 drop-shadow-md">
                            
                            <!-- Prep Time Badge -->
                            <div class="absolute top-2 left-2 bg-black/60 backdrop-blur-md text-white text-[11px] px-2.5 py-1 rounded-full flex items-center gap-1 font-medium">
                                <svg class="w-3.5 h-3.5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span>{{ $item->prep_time }} {{ __('mins') }}</span>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="text-center">
                            <h3 class="font-bold text-lg text-gray-900 dark:text-gray-100 mb-1">{{ $item->name }}</h3>
                            
                            <!-- Star Rating -->
                            <div class="flex items-center justify-center gap-1 mb-2">
                                @for($i = 0; $i < 5; $i++)
                                    <svg class="w-4 h-4 {{ $i < ($item->rating ?? 5) ? 'text-amber-400 fill-amber-400' : 'text-gray-300 dark:text-gray-600' }}" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>

                            <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-2 px-2 leading-relaxed mb-4">
                                {{ $item->description }}
                            </p>
                        </div>
                    </div>

                    <!-- Price & Cart Button -->
                    <div class="flex items-center justify-between pt-3 border-t border-gray-100 dark:border-gray-700/50" x-data="cartStore">
                        <span class="text-xl font-black text-gray-900 dark:text-white">${{ number_format($item->price, 2) }}</span>
                        
                        <button @click="addToCart({{ json_encode($item) }})" 
                                class="bg-amber-400 hover:bg-amber-500 text-gray-900 font-bold px-4 py-2 rounded-xl transition duration-200 text-xs shadow-md shadow-amber-400/20 active:scale-95 flex items-center gap-1">
                            <span>{{ __('Add To Cart') }}</span>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>