<section id="reviews" class="mb-20">
    <div class="flex justify-between items-end mb-8">
        <div>
            <h2 class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">What Our Customer Says?</h2>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Real feedback from food lovers visiting Bites</p>
        </div>

        <!-- Carousel navigation buttons -->
        <div class="hidden sm:flex items-center gap-2">
            <button class="w-9 h-9 rounded-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 flex items-center justify-center hover:bg-amber-400 hover:text-gray-900 transition">
                ←
            </button>
            <button class="w-9 h-9 rounded-full bg-amber-400 text-gray-900 flex items-center justify-center shadow-md hover:bg-amber-500 transition">
                →
            </button>
        </div>
    </div>

    <!-- Review Cards Container -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @php
            $reviews = [
                [
                    'name' => 'Savannah Nguyen',
                    'role' => 'Food Critic',
                    'avatar' => 'https://i.pravatar.cc/100?img=10',
                    'comment' => 'This place is great! Atmosphere is chill and cool and the staff is also really friendly. They know what they are doing and what they are serving, and you can tell making the customers happy is their main priority.'
                ],
                [
                    'name' => 'Esther Howard',
                    'role' => 'Regular Customer',
                    'avatar' => 'https://i.pravatar.cc/100?img=12',
                    'comment' => 'The food preparation time is super fast and everything arrives hot and fresh! Their signature pasta and refreshing drinks are absolute must-tries.'
                ],
                [
                    'name' => 'Marvin McKinney',
                    'role' => 'Food Blogger',
                    'avatar' => 'https://i.pravatar.cc/100?img=15',
                    'comment' => 'Ordering online through their clean website was smooth. The checkout process took less than a minute. Highly recommend their sweet dessert menu!'
                ],
            ];
        @endphp

        @foreach($reviews as $review)
            <div class="bg-white dark:bg-gray-800 p-6 rounded-3xl border border-gray-100 dark:border-gray-700/60 shadow-sm flex flex-col justify-between hover:shadow-lg transition duration-200">
                <p class="text-xs text-gray-600 dark:text-gray-300 leading-relaxed mb-6 italic">
                    "{{ $review['comment'] }}"
                </p>

                <div class="flex items-center gap-3 pt-4 border-t border-gray-100 dark:border-gray-700/50">
                    <img src="{{ $review['avatar'] }}" alt="{{ $review['name'] }}" class="w-10 h-10 rounded-full object-cover">
                    <div>
                        <h4 class="text-xs font-bold text-gray-900 dark:text-white">{{ $review['name'] }}</h4>
                        <span class="text-[10px] text-gray-400">{{ $review['role'] }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>