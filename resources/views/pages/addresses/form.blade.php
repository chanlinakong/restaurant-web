<x-app-layout title="{{ isset($address) ? __('Edit Address') : __('Add Address') }}">

    <div class="max-w-2xl mx-auto py-6 px-4">

        <div class="mb-6">

            <a href="{{ route('addresses.index') }}"
                class="text-sm font-bold text-amber-600 hover:text-amber-700">
                ← {{ __('Back to Addresses') }}
            </a>

            <h1 class="text-2xl font-black text-gray-900 dark:text-white mt-4">
                {{ isset($address) ? __('Edit Address') : __('Add Address') }}
            </h1>

        </div>

        <form
            method="POST"
            action="{{ isset($address)
                ? route('addresses.update', $address)
                : route('addresses.store') }}"

            class="bg-white dark:bg-gray-800 rounded-3xl p-6 border border-gray-200 dark:border-gray-700 shadow-sm space-y-5">

            @csrf

            @if(isset($address))
                @method('PUT')
            @endif

            {{-- Label --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('Address Label') }}
                </label>

                <input
                    type="text"
                    name="label"
                    value="{{ old('label', $address->label ?? '') }}"
                    placeholder="{{ __('e.g. Home, Work') }}"
                    class="w-full rounded-xl border-gray-300 dark:border-gray-600
                    dark:bg-gray-700 dark:text-white">

                @error('label')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Full Name --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('Full Name') }}
                </label>

                <input
                    type="text"
                    name="full_name"
                    value="{{ old('full_name', $address->full_name ?? auth()->user()->name) }}"
                    class="w-full rounded-xl border-gray-300 dark:border-gray-600
                    dark:bg-gray-700 dark:text-white">

                @error('full_name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Phone --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('Phone Number') }}
                </label>

                <input
                    type="text"
                    name="phone"
                    value="{{ old('phone', $address->phone ?? auth()->user()->phone) }}"
                    class="w-full rounded-xl border-gray-300 dark:border-gray-600
                    dark:bg-gray-700 dark:text-white">

                @error('phone')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Address --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('Address') }}
                </label>

                <textarea
                    name="address_line"
                    rows="3"
                    placeholder="{{ __('House number, street, building, etc.') }}"
                    class="w-full rounded-xl border-gray-300 dark:border-gray-600
                    dark:bg-gray-700 dark:text-white">{{ old('address_line', $address->address_line ?? '') }}</textarea>

                @error('address_line')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- District + City --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('District') }}
                    </label>

                    <input
                        type="text"
                        name="district"
                        value="{{ old('district', $address->district ?? '') }}"
                        class="w-full rounded-xl border-gray-300 dark:border-gray-600
                        dark:bg-gray-700 dark:text-white">

                    @error('district')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('City') }}
                    </label>

                    <input
                        type="text"
                        name="city"
                        value="{{ old('city', $address->city ?? '') }}"
                        class="w-full rounded-xl border-gray-300 dark:border-gray-600
                        dark:bg-gray-700 dark:text-white">

                    @error('city')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- Note --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('Delivery Note') }}
                </label>

                <textarea
                    name="note"
                    rows="2"
                    placeholder="{{ __('Optional delivery instructions') }}"
                    class="w-full rounded-xl border-gray-300 dark:border-gray-600
                    dark:bg-gray-700 dark:text-white">{{ old('note', $address->note ?? '') }}</textarea>

                @error('note')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Default --}}
            <label class="flex items-center gap-3 cursor-pointer">

                <input
                    type="checkbox"
                    name="is_default"
                    value="1"
                    class="rounded border-gray-300 text-amber-500 focus:ring-amber-400"
                    {{ old('is_default', $address->is_default ?? false) ? 'checked' : '' }}>

                <span class="text-sm font-bold text-gray-700 dark:text-gray-300">
                    {{ __('Set as default address') }}
                </span>

            </label>

            {{-- Submit --}}
            <button
                type="submit"
                class="w-full bg-amber-400 hover:bg-amber-500 text-gray-900 font-black py-3.5 rounded-2xl transition shadow-lg">

                {{ isset($address) ? __('Update Address') : __('Save Address') }}

            </button>

        </form>

    </div>

</x-app-layout>