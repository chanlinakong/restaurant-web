<x-app-layout title="Order Checkout">
    <div class="max-w-4xl mx-auto py-4">
        <h1 class="text-2xl font-black text-gray-900 dark:text-white mb-6">{{ __('Order Checkout') }}</h1>

        <div x-show="$store.cart.cart.length === 0"
            class="text-center py-16 bg-white dark:bg-gray-800 rounded-3xl border border-gray-200 dark:border-gray-700 shadow-sm">
            <div class="text-5xl mb-3">🛒</div>
            <p class="text-gray-500 dark:text-gray-400 text-base font-medium">{{ __('Your cart is currently empty.') }}
            </p>
            <a href="{{ route('menu.index') }}"
                class="mt-5 inline-block bg-amber-400 text-gray-900 px-6 py-2.5 rounded-full font-bold text-sm shadow-md">
                {{ __('Browse Menu') }}
            </a>
        </div>

        <div x-show="$store.cart.cart.length > 0" class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Items List -->
            <div class="lg:col-span-2 space-y-4">
                <template x-for="item in $store.cart.cart" :key="item.id">
                    <div
                        class="flex items-center justify-between p-4 bg-white dark:bg-gray-800 rounded-2xl border border-gray-200/80 dark:border-gray-700 shadow-sm">
                        <div class="flex items-center gap-4">
                            <img :src="item.image" :alt="item.name"
                                class="w-16 h-16 object-cover rounded-xl bg-amber-50">
                            <div>
                                <h4 class="font-bold text-gray-900 dark:text-white text-sm" x-text="item.name"></h4>
                                <span class="text-xs text-amber-600 font-extrabold"
                                    x-text="'$' + parseFloat(item.price).toFixed(2)"></span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <button @click="$store.cart.decreaseQty(item.id)"
                                class="w-8 h-8 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white font-black hover:bg-amber-400 transition">-</button>
                            <span x-text="item.qty" class="font-bold text-sm text-gray-800 dark:text-gray-100"></span>
                            <button @click="$store.cart.increaseQty(item.id)"
                                class="w-8 h-8 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white font-black hover:bg-amber-400 transition">+</button>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Order Total & Submit -->
            <div
                class="bg-white dark:bg-gray-800 p-6 rounded-3xl border border-gray-200/80 dark:border-gray-700 shadow-sm h-fit space-y-4">
                <h3
                    class="text-base font-black text-gray-900 dark:text-white border-b border-gray-100 dark:border-gray-700 pb-3">
                    {{ __('Summary') }}
                </h3>

                <div class="space-y-2 text-xs font-medium">
                    <div class="flex justify-between text-gray-500 dark:text-gray-400">
                        <span>{{ __('Subtotal') }}</span>
                        <span class="font-bold text-gray-900 dark:text-white"
                            x-text="'$' + $store.cart.subtotal.toFixed(2)"></span>
                    </div>
                    <div class="flex justify-between text-gray-500 dark:text-gray-400">
                        <span>{{ __('Tax (10%)') }}</span>
                        <span class="font-bold text-gray-900 dark:text-white"
                            x-text="'$' + ($store.cart.subtotal * 0.1).toFixed(2)"></span>
                    </div>
                    <div
                        class="border-t border-gray-100 dark:border-gray-700 pt-3 flex justify-between text-sm font-black text-gray-900 dark:text-white">
                        <span>{{ __('Total') }}</span>
                        <span class="text-amber-500" x-text="'$' + ($store.cart.subtotal * 1.1).toFixed(2)"></span>
                    </div>
                </div>


                @if(auth()->check())

                    <button @click="$store.cart.goToPayment()"
                        class="w-full bg-amber-400 hover:bg-amber-500 text-gray-900 font-extrabold py-3 rounded-2xl transition duration-200 shadow-lg shadow-amber-400/20 text-sm">
                        {{ __('Checkout Now') }}
                    </button>

                @else

                    <a href="{{ route('login') }}" class="checkout-btn">
                        {{ __('Login to Checkout') }}
                    </a>

                @endif
            </div>
        </div>
    </div>
</x-app-layout>