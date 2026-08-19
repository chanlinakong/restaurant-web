<x-app-layout title="{{ __('My Addresses') }}">

    <div class="max-w-4xl mx-auto py-6 px-4">

        <div class="flex items-center justify-between mb-6">

            <div>
                <h1 class="text-2xl font-black text-gray-900 dark:text-white">
                    {{ __('My Addresses') }}
                </h1>

                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    {{ __('Manage your delivery addresses.') }}
                </p>
            </div>

            <a href="{{ route('addresses.create') }}"
                class="bg-amber-400 hover:bg-amber-500 text-gray-900 px-5 py-3 rounded-xl font-bold text-sm transition">
                + {{ __('Add Address') }}
            </a>

        </div>

        @if(session('success'))
            <div class="mb-5 p-4 rounded-xl bg-green-50 text-green-700 border border-green-200">
                {{ session('success') }}
            </div>
        @endif

        @if($addresses->count())

            <div class="space-y-4">

                @foreach($addresses as $address)

                    <div
                        class="bg-white dark:bg-gray-800 border
                        {{ $address->is_default
                            ? 'border-amber-400 ring-1 ring-amber-400'
                            : 'border-gray-200 dark:border-gray-700' }}
                        rounded-2xl p-5 shadow-sm">

                        <div class="flex items-start justify-between gap-4">

                            <div class="flex gap-4">

                                <div
                                    class="w-11 h-11 rounded-xl bg-amber-100
                                    dark:bg-amber-900/30 flex items-center justify-center text-xl">
                                    📍
                                </div>

                                <div>

                                    <div class="flex items-center gap-2">

                                        <h3 class="font-black text-gray-900 dark:text-white">
                                            {{ $address->label }}
                                        </h3>

                                        @if($address->is_default)
                                            <span
                                                class="text-xs font-bold px-2 py-1 rounded-full bg-amber-100 text-amber-700">
                                                {{ __('Default') }}
                                            </span>
                                        @endif

                                    </div>

                                    <p class="font-bold text-sm text-gray-800 dark:text-gray-200 mt-1">
                                        {{ $address->full_name }}
                                    </p>

                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $address->phone }}
                                    </p>

                                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">
                                        {{ $address->address_line }},
                                        {{ $address->district }},
                                        {{ $address->city }}
                                    </p>

                                    @if($address->note)
                                        <p class="text-xs text-gray-400 mt-1">
                                            {{ __('Note') }}:
                                            {{ $address->note }}
                                        </p>
                                    @endif

                                </div>

                            </div>

                            <div class="flex items-center gap-2">

                                <a href="{{ route('addresses.edit', $address) }}"
                                    class="px-3 py-2 rounded-lg bg-gray-100 dark:bg-gray-700 text-sm font-bold">
                                    {{ __('Edit') }}
                                </a>

                                <form method="POST"
                                    action="{{ route('addresses.destroy', $address) }}"
                                    onsubmit="return confirm('{{ __('Are you sure you want to delete this address?') }}')">
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="px-3 py-2 rounded-lg bg-red-50 text-red-600 text-sm font-bold">
                                        {{ __('Delete') }}
                                    </button>
                                </form>

                            </div>

                        </div>

                        @if(!$address->is_default)

                            <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">

                                <form method="POST"
                                    action="{{ route('addresses.default', $address) }}">

                                    @csrf
                                    @method('PUT')

                                    <button
                                        class="text-sm font-bold text-amber-600 hover:text-amber-700">
                                        {{ __('Set as Default') }}
                                    </button>

                                </form>

                            </div>

                        @endif

                    </div>

                @endforeach

            </div>

        @else

            <div
                class="text-center py-16 bg-white dark:bg-gray-800 rounded-3xl border border-gray-200 dark:border-gray-700">

                <div class="text-5xl mb-4">
                    📍
                </div>

                <h3 class="text-lg font-black text-gray-900 dark:text-white">
                    {{ __('No addresses yet') }}
                </h3>

                <p class="text-sm text-gray-500 mt-2">
                    {{ __('Add a delivery address to make checkout faster.') }}
                </p>

                <a href="{{ route('addresses.create') }}"
                    class="inline-block mt-5 bg-amber-400 px-6 py-3 rounded-xl font-bold text-sm text-gray-900">
                    {{ __('Add Your First Address') }}
                </a>

            </div>

        @endif

    </div>

</x-app-layout>