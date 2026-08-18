@props(['categories'])

<div class="flex gap-3 mb-6 overflow-x-auto pb-2">

    {{-- All button --}}
    <button
        @click="selectedCategory = 'all'"
        :class="selectedCategory === 'all'
            ? 'bg-amber-400 text-gray-900'
            : 'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300'"
        class="px-5 py-2 rounded-full font-semibold transition-all duration-200 whitespace-nowrap">
        All
    </button>

    {{-- Dynamic categories --}}
    @foreach($categories as $category)
        <button
            @click="selectedCategory = '{{ $category->id }}'"
            :class="selectedCategory == '{{ $category->id }}'
                ? 'bg-amber-400 text-gray-900'
                : 'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300'"
            class="px-5 py-2 rounded-full font-semibold transition-all duration-200 whitespace-nowrap">

            {{ $category->name }}

        </button>
    @endforeach

</div>