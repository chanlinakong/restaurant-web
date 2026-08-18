<x-guest-layout>

    <h2 class="
text-2xl
font-black
text-gray-900
dark:text-white
mb-2
">
        Create Account 🍽️
    </h2>


    <p class="
text-sm
text-gray-500
dark:text-gray-400
mb-6
">
        Join Bites and start ordering delicious meals
    </p>

    <form method="POST" action="{{ route('register') }}">
        @csrf


        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />

            <x-text-input id="name"
                class="block mt-1 w-full placeholder-gray-400 dark:placeholder-gray-500 dark:bg-gray-800/80 dark:text-white"
                type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />

            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>


        <!-- Email -->
        <div class="mt-4">

            <x-input-label for="email" :value="__('Email')" />

            <x-text-input id="email"
                class="block mt-1 w-full placeholder-gray-400 dark:placeholder-gray-500 dark:bg-gray-800/80 dark:text-white"
                type="email" name="email" :value="old('email')" required autocomplete="username" />

            <x-input-error :messages="$errors->get('email')" class="mt-2" />

        </div>


        <!-- Password -->
        <div class="mt-4">

            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password"
                class="block mt-1 w-full placeholder-gray-400 dark:placeholder-gray-500 dark:bg-gray-800/80 dark:text-white"
                type="password" name="password" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />

        </div>


        <!-- Confirm Password -->
        <div class="mt-4">

            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation"
                class="block mt-1 w-full placeholder-gray-400 dark:placeholder-gray-500 dark:bg-gray-800/80 dark:text-white"
                type="password" name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

        </div>


        <!-- Action Buttons -->
        <div class="mt-6">

            <button type="submit" class="
            w-full

            bg-amber-400
            hover:bg-amber-500

            text-gray-900

            font-black
            text-sm

            py-3

            rounded-2xl

            shadow-lg
            shadow-amber-400/20

            transition
            duration-200
        ">
                {{ __('Register') }}
            </button>


            <p class="
            text-center
            text-sm
            mt-5

            text-gray-600
            dark:text-gray-400
        ">

                {{ __('Already registered?') }}

                <a href="{{ route('login') }}" class="
                ml-1

                text-amber-600
                dark:text-amber-400

                font-bold

                hover:text-amber-700
                dark:hover:text-amber-300

                transition
            ">
                    {{ __('Login') }}
                </a>

            </p>

        </div>
        <!-- <div class="flex items-center justify-end mt-4">

            <a 
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}"
            >
                {{ __('Already registered?') }}
            </a>


            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>

        </div> -->

    </form>

</x-guest-layout>