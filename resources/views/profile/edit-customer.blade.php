<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-6 sm:p-8 bg-white dark:bg-gray-800
                       shadow sm:rounded-lg">

                <div class="flex items-center gap-5">

                    {{-- Avatar --}}
                    <div class="w-20 h-20 rounded-full
                               bg-amber-400
                               flex items-center justify-center
                               overflow-hidden
                               flex-shrink-0">

                        @if(auth()->user()->profile_image)

                            <img src="{{ asset('images/profiles/' . auth()->user()->profile_image) }}"
                                alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">

                        @else

                            <span class="text-3xl font-bold text-gray-900">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>

                        @endif

                    </div>


                    {{-- Information --}}
                    <div>

                        <h2 class="text-xl font-bold
                                   text-gray-900 dark:text-white">
                            {{ auth()->user()->name }}
                        </h2>


                        <p class="text-sm text-gray-500
                                   dark:text-gray-400 mt-1">
                            {{ auth()->user()->email }}
                        </p>


                        @if(auth()->user()->phone)

                            <p class="text-sm text-gray-500
                                           dark:text-gray-400 mt-1">
                                {{ auth()->user()->phone }}
                            </p>

                        @endif


                        <span class="inline-flex items-center
                                   mt-2 px-3 py-1
                                   rounded-full
                                   text-xs font-semibold
                                   bg-amber-100
                                   text-amber-700
                                   dark:bg-amber-900/30
                                   dark:text-amber-400">
                            Customer
                        </span>

                    </div>

                </div>

            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>