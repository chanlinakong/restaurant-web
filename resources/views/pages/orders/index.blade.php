<x-app-layout title="My Orders">

<div class="max-w-5xl mx-auto py-8">


    <h1 class="text-2xl font-black text-gray-900 dark:text-white mb-6">
        {{ __('My Orders') }}
    </h1>



    @if($orders->isEmpty())

        <div class="
            bg-white dark:bg-gray-800
            rounded-3xl
            p-10
            text-center
            border border-gray-200 dark:border-gray-700
        ">

            <div class="text-5xl mb-3">
                🍽️
            </div>

            <p class="text-gray-500 dark:text-gray-400">
                You don't have any orders yet.
            </p>


            <a href="{{ route('menu.index') }}"
                class="
                inline-block
                mt-5
                bg-amber-400
                px-6 py-3
                rounded-xl
                font-bold
                text-gray-900
                ">
                Browse Menu
            </a>

        </div>


    @else


    <div class="space-y-5">


        @foreach($orders as $order)


        <div class="
            bg-white dark:bg-gray-800
            rounded-3xl
            p-6
            border border-gray-200 dark:border-gray-700
            shadow-sm
        ">


            <div class="flex justify-between items-center mb-4">


                <div>

                    <h2 class="
                    font-black
                    text-gray-900
                    dark:text-white
                    ">
                        Order #{{ $order->id }}
                    </h2>


                    <p class="
                    text-sm
                    text-gray-500
                    dark:text-gray-400
                    ">
                        {{ $order->created_at
                            ->timezone('Asia/Phnom_Penh')
                            ->format('d M Y, h:i A')
                        }}
                    </p>

                </div>



                <span class="
                px-4 py-2
                rounded-full
                text-xs
                font-bold
                {{ $order->status_badge_class }} ">

                    {{ ucfirst($order->status->value) }}

                </span>


            </div>



            <div class="space-y-3">


                @foreach($order->orderDetails->take(3) as $detail)


                <div class="
                flex items-center gap-3
                ">


                    <img
                    src="{{ asset($detail->menuItem->image_url) }}"
                    class="
                    w-12 h-12
                    rounded-xl
                    object-cover
                    ">


                    <div class="flex-1">

                        <p class="
                        font-bold
                        text-sm
                        text-gray-900
                        dark:text-white
                        ">

                            {{ $detail->menuItem->name }}

                        </p>


                        <p class="
                        text-xs
                        text-gray-500
                        ">

                            Qty: {{ $detail->quantity }}

                        </p>

                    </div>


                </div>


                @endforeach


            </div>




            <div class="
            mt-5
            pt-4
            border-t
            border-gray-200
            dark:border-gray-700
            flex justify-between items-center
            ">


                <span class="
                font-black
                text-brand-500
                text-lg
                ">

                    ${{ number_format($order->total_amount,2) }}

                </span>



                <a href="{{ route('orders.show',$order) }}"
                class="
                bg-gray-900
                dark:bg-amber-400
                text-white
                dark:text-gray-900
                px-5 py-2
                rounded-xl
                text-sm
                font-bold
                ">

                    View Details

                </a>


            </div>


        </div>


        @endforeach


    </div>


    @endif


</div>

</x-app-layout>