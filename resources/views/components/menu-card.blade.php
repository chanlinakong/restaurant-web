@props(['item'])

<div
    class="bg-white dark:bg-gray-800 rounded-3xl p-5 shadow-sm hover:shadow-xl transition-all duration-300 border border-amber-100/50 dark:border-gray-700/60 flex flex-col justify-between group">

    <div>
        <!-- Food Image -->
        <div class="relative w-full h-48 mb-4 overflow-hidden rounded-2xl 
                    bg-gray-100 dark:bg-gray-700">

            <img src="{{ asset($item->image_url) }}" alt="{{ $item->name }}" class="w-full h-full object-cover 
                       group-hover:scale-110 
                       transition-transform duration-500">

            <!-- Preparation Time -->
            <div class="absolute top-3 left-3 
                        bg-black/60 backdrop-blur-sm 
                        text-white text-xs 
                        px-3 py-1.5 rounded-full">

                {{ $item->preparation_time ?? 15 }} mins

            </div>

        </div>


        <div class="text-center">

            <h3 class="font-bold text-lg text-gray-900 dark:text-gray-100 mb-2">
                {{ $item->name }}
            </h3>


            <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-2 mb-4">
                {{ $item->description }}
            </p>

        </div>

    </div>


    <div class="flex items-center justify-between 
                pt-3 border-t border-gray-100 dark:border-gray-700/50">

        <span class="text-xl font-black text-gray-900 dark:text-white">
            ${{ number_format($item->price, 2) }}
        </span>


        <button @click="$store.cart.addToCart({
    id: {{ $item->id }},
    name: @js($item->name),
    price: {{ $item->price }},
    image: @js(asset($item->image_url)),
    qty: 1
})" class="bg-amber-400 hover:bg-amber-500 text-gray-900 font-bold px-4 py-2 rounded-xl text-xs">

            Add To Cart

        </button>

    </div>

</div>