<div 
    x-data="menuCarousel"
    class="relative group"
>


    <!-- Left Arrow -->

    <button
        @click="previous"
        class="
        absolute left-0 top-1/2 -translate-y-1/2
        z-10
        w-10 h-10
        rounded-full
        bg-white dark:bg-gray-800
        shadow-lg
        border border-gray-200 dark:border-gray-700
        flex items-center justify-center
        text-gray-700 dark:text-gray-200
        hover:bg-amber-400
        transition
        opacity-0
        group-hover:opacity-100
        "
    >

        <svg class="w-5 h-5"
             fill="none"
             stroke="currentColor"
             viewBox="0 0 24 24">

            <path 
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M15 19l-7-7 7-7"/>

        </svg>

    </button>



    <!-- Cards Container -->


    <div
        x-ref="container"
        class="
        flex
        gap-6
        overflow-x-auto
        scroll-smooth
        snap-x
        snap-mandatory

        scrollbar-thin
        scrollbar-thumb-amber-400

        pb-5

        "
    >

        {{ $slot }}

    </div>



    <!-- Right Arrow -->

    <button
        @click="next"
        class="
        absolute right-0 top-1/2 -translate-y-1/2
        z-10
        w-10 h-10
        rounded-full
        bg-white dark:bg-gray-800
        shadow-lg
        border border-gray-200 dark:border-gray-700
        flex items-center justify-center
        text-gray-700 dark:text-gray-200
        hover:bg-amber-400
        transition

        opacity-0
        group-hover:opacity-100
        "
    >

        <svg class="w-5 h-5"
             fill="none"
             stroke="currentColor"
             viewBox="0 0 24 24">

            <path 
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M9 5l7 7-7 7"/>

        </svg>

    </button>


</div>