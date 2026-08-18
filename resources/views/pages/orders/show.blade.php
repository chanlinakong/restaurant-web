<x-app-layout title="Order Details">

    <div class="max-w-4xl mx-auto py-8">


        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">


            <div class="flex justify-between items-center mb-6">

                <div>

                    <h1 class="text-2xl font-black text-gray-900 dark:text-white">
                        Order #{{ $order->id }}
                    </h1>

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $order->created_at ->timezone('Asia/Phnom_Penh') ->format('d M Y, h:i A') }}
                    </p>

                    

                </div>


                <span class="px-4 py-2 rounded-full text-xs font-bold
                bg-amber-100 text-amber-700
                dark:bg-amber-900 dark:text-amber-300">

                    {{ ucfirst($order->status->value) }}

                </span>

            </div>




            <!-- Items -->

            <div class="space-y-4">


                @foreach($order->orderDetails as $detail)


                                <div class="flex items-center justify-between
                            bg-gray-50 dark:bg-gray-700/50
                            rounded-2xl p-4">


                                    <div class="flex items-center gap-4">


                                        <img src="{{ asset($detail->menuItem->image_url) }}" class="w-16 h-16 rounded-xl object-cover">


                                        <div>

                                            <h3 class="font-bold text-gray-900 dark:text-white">

                                                {{ $detail->menuItem->name }}

                                            </h3>


                                            <p class="text-sm text-gray-500 dark:text-gray-400">

                                                Qty:
                                                {{ $detail->quantity }}

                                            </p>

                                        </div>


                                    </div>



                                    <div class="text-right">


                                        <p class="font-black text-gray-900 dark:text-white">

                                            ${{ number_format(
                        $detail->unit_price *
                        $detail->quantity,
                        2
                    ) }}

                                        </p>


                                    </div>


                                </div>


                @endforeach


            </div>




            <!-- Summary -->

            <!-- Summary -->

            @php

                $subtotal = $order->orderDetails->sum(function ($detail) {

                    return $detail->unit_price * $detail->quantity;

                });


                $tax = $subtotal * 0.10;


                $total = $subtotal + $tax;

            @endphp


            <div class="mt-6 pt-5 border-t border-gray-200 dark:border-gray-700 space-y-3">


                <div class="flex justify-between text-sm">

                    <span class="text-gray-500 dark:text-gray-400">
                        Subtotal
                    </span>

                    <span class="font-bold text-gray-900 dark:text-white">
                        ${{ number_format($subtotal, 2) }}
                    </span>

                </div>



                <div class="flex justify-between text-sm">

                    <span class="text-gray-500 dark:text-gray-400">
                        Tax (10%)
                    </span>

                    <span class="font-bold text-gray-900 dark:text-white">
                        ${{ number_format($tax, 2) }}
                    </span>

                </div>



                <div class="flex justify-between pt-3 border-t border-gray-200 dark:border-gray-700">

                    <span class="font-black text-gray-900 dark:text-white">
                        Total
                    </span>


                    <span class="text-2xl font-black text-brand-500">

                        ${{ number_format($total, 2) }}

                    </span>

                </div>


            </div>


        </div>


    </div>


</x-app-layout>