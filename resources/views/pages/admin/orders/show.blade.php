@extends('layouts.admin')

@section('title', 'Order #' . $order->id)

@section('css')
    @vite(['resources/css/app.css'])
@stop

@section('content_header')
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Order #{{ $order->id }}
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                View order details and manage this order.
            </p>
        </div>

        <a
            href="{{ route('admin.orders.index') }}"
            class="inline-flex items-center justify-center px-4 py-2
                   bg-gray-600 text-white rounded-lg
                   hover:bg-gray-700 transition"
        >
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Orders
        </a>
    </div>
@stop

@section('content')

    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-6 px-4 py-3 rounded-lg
                    bg-green-50 border border-green-200
                    text-green-700">

            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="mb-6 px-4 py-3 rounded-lg
                    bg-red-50 border border-red-200
                    text-red-700">

            <div class="flex items-start">
                <i class="fas fa-exclamation-circle mr-2 mt-1"></i>

                <div>
                    <p class="font-semibold">
                        Please check the following:
                    </p>

                    <ul class="mt-1 list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif


    <div class="space-y-6">


        {{-- ========================================================= --}}
        {{-- ORDER INFORMATION --}}
        {{-- ========================================================= --}}

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

            {{-- Header --}}
            <div class="px-6 py-4 border-b border-gray-200">

                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-lg
                                bg-amber-100
                                flex items-center justify-center mr-3">

                        <i class="fas fa-receipt text-amber-600"></i>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">
                            Order Information
                        </h3>

                        <p class="text-sm text-gray-500">
                            Basic information about this order.
                        </p>
                    </div>
                </div>

            </div>


            {{-- Body --}}
            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">


                    {{-- Order ID --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500">
                            Order ID
                        </p>

                        <p class="mt-1 text-lg font-semibold text-gray-900">
                            #{{ $order->id }}
                        </p>
                    </div>


                    {{-- Order Type --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500">
                            Order Type
                        </p>

                        <p class="mt-1 text-lg font-semibold text-gray-900">
                            {{ ucfirst($order->order_type) }}
                        </p>
                    </div>


                    {{-- Table --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500">
                            Table Number
                        </p>

                        <p class="mt-1 text-lg font-semibold text-gray-900">
                            {{ $order->table_number ?? 'Takeaway' }}
                        </p>
                    </div>


                    {{-- Current Status --}}
                    <div>

                        <p class="text-sm font-medium text-gray-500">
                            Current Status
                        </p>

                        @php
                            $statusClass = match($order->status) {
                                \App\Enums\OrderStatus::Pending =>
                                    'bg-yellow-100 text-yellow-800',

                                \App\Enums\OrderStatus::Confirmed =>
                                    'bg-blue-100 text-blue-800',

                                \App\Enums\OrderStatus::Completed =>
                                    'bg-green-100 text-green-800',

                                \App\Enums\OrderStatus::Cancelled =>
                                    'bg-red-100 text-red-800',
                            };
                        @endphp

                        <div class="mt-2">
                            <span
                                class="inline-flex items-center px-3 py-1
                                       rounded-full text-sm font-semibold
                                       {{ $statusClass }}"
                            >
                                <span class="w-2 h-2 rounded-full
                                             bg-current mr-2 opacity-70">
                                </span>

                                {{ ucfirst($order->status->value) }}
                            </span>
                        </div>

                    </div>

                </div>


                {{-- Divider --}}
                <div class="my-6 border-t border-gray-200"></div>


                {{-- Update Status --}}
                <div>

                    <div class="flex items-center mb-3">

                        <i class="fas fa-sync-alt
                                  text-amber-500 mr-2">
                        </i>

                        <h4 class="font-semibold text-gray-900">
                            Update Order Status
                        </h4>

                    </div>


                    <form
                        action="{{ route('admin.orders.update', $order) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PATCH')


                        <div class="flex flex-col sm:flex-row
                                    sm:items-center gap-3">

                            <select
                                name="status"
                                class="w-full sm:w-64
                                       px-4 py-2.5
                                       border border-gray-300
                                       rounded-lg
                                       bg-white
                                       text-gray-700
                                       focus:outline-none
                                       focus:ring-2
                                       focus:ring-amber-500
                                       focus:border-amber-500"
                            >

                                @foreach(\App\Enums\OrderStatus::cases() as $status)

                                    <option
                                        value="{{ $status->value }}"
                                        @selected($order->status === $status)
                                    >
                                        {{ ucfirst($status->value) }}
                                    </option>

                                @endforeach

                            </select>


                            <button
                                type="submit"
                                class="inline-flex items-center
                                       justify-center
                                       px-5 py-2.5
                                       bg-amber-500
                                       text-white
                                       font-medium
                                       rounded-lg
                                       hover:bg-amber-600
                                       focus:outline-none
                                       focus:ring-2
                                       focus:ring-amber-500
                                       transition"
                            >

                                <i class="fas fa-save mr-2"></i>

                                Update Status

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>



        {{-- ========================================================= --}}
        {{-- CUSTOMER INFORMATION --}}
        {{-- ========================================================= --}}

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

            <div class="px-6 py-4 border-b border-gray-200">

                <div class="flex items-center">

                    <div class="w-10 h-10 rounded-lg
                                bg-amber-100
                                flex items-center justify-center mr-3">

                        <i class="fas fa-user text-amber-600"></i>

                    </div>

                    <div>

                        <h3 class="text-lg font-semibold text-gray-900">
                            Customer Information
                        </h3>

                        <p class="text-sm text-gray-500">
                            Customer details for this order.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6">

                @if($order->customer)

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        {{-- Name --}}
                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Name
                            </p>

                            <p class="mt-1 font-semibold text-gray-900">
                                {{ $order->customer->name }}
                            </p>

                        </div>


                        {{-- Email --}}
                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Email
                            </p>

                            <p class="mt-1 font-semibold text-gray-900">
                                {{ $order->customer->email }}
                            </p>

                        </div>


                        {{-- Phone --}}
                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Phone
                            </p>

                            <p class="mt-1 font-semibold text-gray-900">
                                {{ $order->customer->phone ?? 'N/A' }}
                            </p>

                        </div>

                    </div>

                @else

                    <div class="flex items-center
                                p-4 rounded-lg bg-gray-50">

                        <i class="fas fa-user-slash
                                  text-gray-400 mr-3">
                        </i>

                        <p class="text-gray-500">
                            Guest customer
                        </p>

                    </div>

                @endif

            </div>

        </div>



        {{-- ========================================================= --}}
        {{-- ORDER ITEMS --}}
        {{-- ========================================================= --}}

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

            <div class="px-6 py-4 border-b border-gray-200">

                <div class="flex items-center">

                    <div class="w-10 h-10 rounded-lg
                                bg-amber-100
                                flex items-center justify-center mr-3">

                        <i class="fas fa-utensils text-amber-600"></i>

                    </div>

                    <div>

                        <h3 class="text-lg font-semibold text-gray-900">
                            Order Items
                        </h3>

                        <p class="text-sm text-gray-500">
                            Items included in this order.
                        </p>

                    </div>

                </div>

            </div>


            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50">

                        <tr>

                            <th class="px-6 py-3 text-left
                                       text-xs font-semibold
                                       text-gray-500 uppercase">
                                Item
                            </th>

                            <th class="px-6 py-3 text-center
                                       text-xs font-semibold
                                       text-gray-500 uppercase">
                                Quantity
                            </th>

                            <th class="px-6 py-3 text-right
                                       text-xs font-semibold
                                       text-gray-500 uppercase">
                                Unit Price
                            </th>

                            <th class="px-6 py-3 text-right
                                       text-xs font-semibold
                                       text-gray-500 uppercase">
                                Subtotal
                            </th>

                            <th class="px-6 py-3 text-left
                                       text-xs font-semibold
                                       text-gray-500 uppercase">
                                Notes
                            </th>

                        </tr>

                    </thead>


                    <tbody class="bg-white divide-y divide-gray-200">

                        @forelse($order->orderDetails as $item)

                            <tr class="hover:bg-gray-50 transition">


                                {{-- Item --}}
                                <td class="px-6 py-4">

                                    <div class="flex items-center">

                                        @if($item->menuItem?->image_url)

                                            <img
                                                src="{{ asset($item->menuItem->image_url) }}"
                                                alt="{{ $item->menuItem->name }}"
                                                class="w-14 h-14 rounded-lg
                                                       object-cover mr-4"
                                            >

                                        @else

                                            <div
                                                class="w-14 h-14 rounded-lg
                                                       bg-gray-100
                                                       flex items-center
                                                       justify-center mr-4"
                                            >
                                                <i class="fas fa-utensils
                                                          text-gray-400">
                                                </i>
                                            </div>

                                        @endif


                                        <div>

                                            <p class="font-semibold text-gray-900">
                                                {{ $item->menuItem?->name ?? 'Deleted Menu Item' }}
                                            </p>

                                            @if($item->menuItem?->description)

                                                <p class="text-sm text-gray-500 mt-1">
                                                    {{ Str::limit($item->menuItem->description, 60) }}
                                                </p>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- Quantity --}}
                                <td class="px-6 py-4 text-center">

                                    <span
                                        class="inline-flex items-center
                                               justify-center
                                               min-w-[40px]
                                               px-3 py-1
                                               bg-gray-100
                                               rounded-lg
                                               font-semibold
                                               text-gray-800"
                                    >
                                        {{ $item->quantity }}
                                    </span>

                                </td>


                                {{-- Unit Price --}}
                                <td
                                    class="px-6 py-4
                                           text-right
                                           font-medium
                                           text-gray-700"
                                >
                                    ${{ number_format($item->unit_price, 2) }}
                                </td>


                                {{-- Subtotal --}}
                                <td
                                    class="px-6 py-4
                                           text-right
                                           font-semibold
                                           text-gray-900"
                                >
                                    ${{ number_format(
                                        $item->unit_price * $item->quantity,
                                        2
                                    ) }}
                                </td>


                                {{-- Notes --}}
                                <td
                                    class="px-6 py-4
                                           text-sm
                                           text-gray-500"
                                >
                                    {{ $item->notes ?: 'No notes' }}
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="5"
                                    class="px-6 py-12 text-center"
                                >

                                    <div
                                        class="w-14 h-14 mx-auto
                                               rounded-full
                                               bg-gray-100
                                               flex items-center
                                               justify-center"
                                    >
                                        <i
                                            class="fas fa-shopping-basket
                                                   text-2xl
                                                   text-gray-400"
                                        ></i>
                                    </div>

                                    <p class="mt-3 text-gray-500">
                                        No items found for this order.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>



        {{-- ========================================================= --}}
        {{-- ORDER TOTAL --}}
        {{-- ========================================================= --}}

        <div class="flex justify-end">

            <div
                class="w-full md:w-96
                       bg-white
                       rounded-xl
                       shadow-sm
                       border border-gray-200
                       overflow-hidden"
            >

                <div class="px-6 py-4 border-b border-gray-200">

                    <div class="flex items-center">

                        <i class="fas fa-dollar-sign
                                  text-amber-500 mr-2">
                        </i>

                        <h3 class="text-lg font-semibold text-gray-900">
                            Order Total
                        </h3>

                    </div>

                </div>


                <div class="p-6">

                    <div class="flex justify-between items-center">

                        <span class="text-gray-600">
                            Total Amount
                        </span>

                        <span
                            class="text-2xl
                                   font-bold
                                   text-amber-600"
                        >
                            ${{ number_format($order->total_amount, 2) }}
                        </span>

                    </div>

                </div>

            </div>

        </div>



        {{-- ========================================================= --}}
        {{-- ORDER HANDLING --}}
        {{-- ========================================================= --}}

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

            <div class="px-6 py-4 border-b border-gray-200">

                <div class="flex items-center">

                    <div class="w-10 h-10 rounded-lg
                                bg-amber-100
                                flex items-center
                                justify-center mr-3">

                        <i class="fas fa-user-shield
                                  text-amber-600">
                        </i>

                    </div>

                    <div>

                        <h3 class="text-lg font-semibold text-gray-900">
                            Order Handling
                        </h3>

                        <p class="text-sm text-gray-500">
                            Staff member currently handling this order.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6">

                @if($order->handledBy)

                    <div class="flex items-center">

                        <div
                            class="w-12 h-12 rounded-full
                                   bg-amber-100
                                   flex items-center
                                   justify-center mr-4"
                        >

                            <i class="fas fa-user
                                      text-amber-600
                                      text-lg">
                            </i>

                        </div>


                        <div>

                            <p class="font-semibold text-gray-900">
                                {{ $order->handledBy->name }}
                            </p>

                            <p class="text-sm text-gray-500">
                                {{ $order->handledBy->email }}
                            </p>

                        </div>

                    </div>

                @else

                    <div class="flex items-center
                                p-4 rounded-lg bg-gray-50">

                        <i class="fas fa-user-clock
                                  text-gray-400 mr-3">
                        </i>

                        <p class="text-gray-500">
                            This order has not been handled yet.
                        </p>

                    </div>

                @endif

            </div>

        </div>


    </div>

@stop