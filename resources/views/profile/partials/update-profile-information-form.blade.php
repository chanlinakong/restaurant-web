<section>

    <header>

        <h2
            class="text-lg font-medium
                   text-gray-900 dark:text-gray-100"
        >
            Profile Information
        </h2>

        <p
            class="mt-1 text-sm
                   text-gray-600 dark:text-gray-400"
        >
            Update your account's profile information,
            email address, and phone number.
        </p>

    </header>


    <form
        method="post"
        action="{{ route('profile.update') }}"
        enctype="multipart/form-data"
        class="mt-6 space-y-6"
    >

        @csrf
        @method('patch')


        {{-- ====================================================== --}}
        {{-- PROFILE IMAGE --}}
        {{-- ====================================================== --}}

        <div>

            <x-input-label
                for="profile_image"
                value="Profile Image"
            />


            <div class="mt-3 flex items-center gap-5">

                {{-- Preview --}}
                <div>

                    @if(auth()->user()->profile_image)

                        <img
                            id="profile-preview"
                            src="{{ asset('images/profiles/' . auth()->user()->profile_image) }}"
                            alt="{{ auth()->user()->name }}"
                            class="w-20 h-20 rounded-full
                                   object-cover"
                        >

                    @else

                        <div
                            id="profile-placeholder"
                            class="w-20 h-20 rounded-full
                                   bg-amber-400
                                   flex items-center
                                   justify-center"
                        >

                            <span
                                class="text-2xl font-bold
                                       text-gray-900"
                            >
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>

                        </div>


                        <img
                            id="profile-preview"
                            src=""
                            alt="Profile preview"
                            class="w-20 h-20 rounded-full
                                   object-cover hidden"
                        >

                    @endif

                </div>


                {{-- Upload --}}
                <div class="flex-1">

                    <input
                        type="file"
                        name="profile_image"
                        id="profile_image"
                        accept="image/jpeg,image/png,image/jpg,image/webp"
                        class="block w-full text-sm
                               text-gray-500
                               dark:text-gray-400

                               file:mr-4
                               file:py-2
                               file:px-4
                               file:rounded-lg
                               file:border-0
                               file:text-sm
                               file:font-semibold

                               file:bg-amber-50
                               file:text-amber-700

                               hover:file:bg-amber-100"
                    >


                    <p
                        class="mt-1 text-xs
                               text-gray-500
                               dark:text-gray-400"
                    >
                        JPG, JPEG, PNG or WEBP.
                        Maximum 2MB.
                    </p>


                    @if(auth()->user()->profile_image)

                        <div class="mt-3">

                            <label
                                class="inline-flex items-center"
                            >

                                <input
                                    type="checkbox"
                                    name="remove_image"
                                    value="1"
                                    class="rounded
                                           border-gray-300
                                           text-red-600
                                           shadow-sm
                                           focus:ring-red-500"
                                >

                                <span
                                    class="ml-2 text-sm
                                           text-red-600
                                           dark:text-red-400"
                                >
                                    Remove profile image
                                </span>

                            </label>

                        </div>

                    @endif


                    @error('profile_image')

                        <p
                            class="mt-2 text-sm
                                   text-red-600
                                   dark:text-red-400"
                        >
                            {{ $message }}
                        </p>

                    @enderror

                </div>

            </div>

        </div>



        {{-- ====================================================== --}}
        {{-- NAME --}}
        {{-- ====================================================== --}}

        <div>

            <x-input-label
                for="name"
                value="Name"
            />

            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-1 block w-full"
                value="{{ old('name', auth()->user()->name) }}"
                required
                autofocus
                autocomplete="name"
            />

            <x-input-error
                class="mt-2"
                :messages="$errors->get('name')"
            />

        </div>



        {{-- ====================================================== --}}
        {{-- EMAIL --}}
        {{-- ====================================================== --}}

        <div>

            <x-input-label
                for="email"
                value="Email"
            />

            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full"
                value="{{ old('email', auth()->user()->email) }}"
                required
                autocomplete="username"
            />

            <x-input-error
                class="mt-2"
                :messages="$errors->get('email')"
            />


            @if(auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail
                && !auth()->user()->hasVerifiedEmail())

                <div class="mt-2">

                    <p
                        class="text-sm text-gray-800
                               dark:text-gray-200"
                    >

                        Your email address is unverified.

                        <button
                            form="send-verification"
                            class="underline text-sm
                                   text-gray-600
                                   dark:text-gray-400
                                   hover:text-gray-900
                                   dark:hover:text-gray-100
                                   rounded-md
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-offset-2
                                   focus:ring-indigo-500"
                        >
                            Click here to re-send
                            the verification email.
                        </button>

                    </p>


                    @if(session('status') === 'verification-link-sent')

                        <p
                            class="mt-2 font-medium text-sm
                                   text-green-600
                                   dark:text-green-400"
                        >
                            A new verification link has been sent
                            to your email address.
                        </p>

                    @endif

                </div>

            @endif

        </div>



        {{-- ====================================================== --}}
        {{-- PHONE --}}
        {{-- ====================================================== --}}

        <div>

            <x-input-label
                for="phone"
                value="Phone Number"
            />

            <x-text-input
                id="phone"
                name="phone"
                type="text"
                class="mt-1 block w-full"
                value="{{ old('phone', auth()->user()->phone) }}"
                placeholder="Enter your phone number"
                autocomplete="tel"
            />

            <x-input-error
                class="mt-2"
                :messages="$errors->get('phone')"
            />

        </div>



        {{-- ====================================================== --}}
        {{-- ROLE --}}
        {{-- ====================================================== --}}

        <div>

            <x-input-label
                for="role"
                value="Account Type"
            />

            <x-text-input
                id="role"
                type="text"
                class="mt-1 block w-full bg-gray-100
                       dark:bg-gray-700
                       text-gray-500
                       dark:text-gray-400"
                value="Customer"
                readonly
            />

            <p
                class="mt-1 text-xs
                       text-gray-500
                       dark:text-gray-400"
            >
                Your account type cannot be changed here.
            </p>

        </div>



        {{-- ====================================================== --}}
        {{-- ACTION --}}
        {{-- ====================================================== --}}

        <div class="flex items-center gap-4">

            <x-primary-button>
                Save
            </x-primary-button>


            @if(session('status') === 'profile-updated')

                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm text-gray-600
                           dark:text-gray-400"
                >
                    Saved.
                </p>

            @endif

        </div>

    </form>


    {{-- Email verification form --}}
    @if(auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail
        && !auth()->user()->hasVerifiedEmail())

        <form
            id="send-verification"
            method="post"
            action="{{ route('verification.send') }}"
        >
            @csrf
        </form>

    @endif

</section>



{{-- ========================================================== --}}
{{-- IMAGE PREVIEW --}}
{{-- ========================================================== --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const input =
        document.getElementById('profile_image');

    const preview =
        document.getElementById('profile-preview');

    const placeholder =
        document.getElementById('profile-placeholder');


    if (!input || !preview) {
        return;
    }


    input.addEventListener('change', function (event) {

        const file =
            event.target.files[0];


        if (!file) {
            return;
        }


        // Check file type
        if (!file.type.startsWith('image/')) {

            input.value = '';

            return;
        }


        // Preview
        const reader =
            new FileReader();


        reader.onload = function (e) {

            preview.src =
                e.target.result;

            preview.classList.remove('hidden');

            if (placeholder) {

                placeholder.classList.add('hidden');

            }

        };


        reader.readAsDataURL(file);

    });

});

</script>