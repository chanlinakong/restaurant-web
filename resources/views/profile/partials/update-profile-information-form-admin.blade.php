<form
    method="POST"
    action="{{ route('profile.update') }}"
    enctype="multipart/form-data"
>

    @csrf
    @method('PATCH')


    {{-- ========================================================= --}}
    {{-- PROFILE IMAGE --}}
    {{-- ========================================================= --}}

    <div class="form-group">

        <label>
            Profile Image
        </label>

        <div class="d-flex align-items-center">

            {{-- Current Image --}}
            <div class="mr-4">

                @if(auth()->user()->profile_image)

                    <img
                        id="profile-preview"
                        src="{{ asset('images/profiles/' . auth()->user()->profile_image) }}"
                        alt="{{ auth()->user()->name }}"
                        class="rounded-circle"
                        style="
                            width: 100px;
                            height: 100px;
                            object-fit: cover;
                        "
                    >

                @else

                    <div
                        id="profile-placeholder"
                        class="rounded-circle bg-warning
                               d-flex align-items-center
                               justify-content-center"
                        style="
                            width: 100px;
                            height: 100px;
                        "
                    >

                        <strong
                            class="text-white"
                            style="font-size: 36px;"
                        >
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </strong>

                    </div>


                    <img
                        id="profile-preview"
                        src=""
                        alt="Profile preview"
                        class="rounded-circle"
                        style="
                            width: 100px;
                            height: 100px;
                            object-fit: cover;
                            display: none;
                        "
                    >

                @endif

            </div>


            {{-- Upload --}}
            <div class="flex-grow-1">

                <div class="custom-file">

                    <input
                        type="file"
                        name="profile_image"
                        id="profile_image"
                        class="custom-file-input @error('profile_image') is-invalid @enderror"
                        accept="image/jpeg,image/png,image/jpg,image/webp"
                    >

                    <label
                        class="custom-file-label"
                        for="profile_image"
                    >
                        Choose image
                    </label>

                </div>


                <small class="form-text text-muted">
                    JPG, JPEG, PNG or WEBP. Maximum 2MB.
                </small>


                @error('profile_image')

                    <span class="text-danger">
                        {{ $message }}
                    </span>

                @enderror


                {{-- Remove Image --}}
                @if(auth()->user()->profile_image)

                    <div class="mt-2">

                        <div class="custom-control custom-checkbox">

                            <input
                                type="checkbox"
                                name="remove_image"
                                value="1"
                                id="remove_image"
                                class="custom-control-input"
                            >

                            <label
                                for="remove_image"
                                class="custom-control-label text-danger"
                            >
                                Remove profile image
                            </label>

                        </div>

                    </div>

                @endif

            </div>

        </div>

    </div>



    <hr>



    {{-- ========================================================= --}}
    {{-- NAME --}}
    {{-- ========================================================= --}}

    <div class="form-group">

        <label for="name">
            Full Name
        </label>

        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', auth()->user()->name) }}"
            required
            class="form-control @error('name') is-invalid @enderror"
        >

        @error('name')

            <div class="invalid-feedback">
                {{ $message }}
            </div>

        @enderror

    </div>



    <div class="row">

        {{-- ===================================================== --}}
        {{-- EMAIL --}}
        {{-- ===================================================== --}}

        <div class="col-md-6">

            <div class="form-group">

                <label for="email">
                    Email Address
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', auth()->user()->email) }}"
                    required
                    class="form-control @error('email') is-invalid @enderror"
                >

                @error('email')

                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                @enderror

            </div>

        </div>



        {{-- ===================================================== --}}
        {{-- PHONE --}}
        {{-- ===================================================== --}}

        <div class="col-md-6">

            <div class="form-group">

                <label for="phone">
                    Phone Number
                </label>

                <input
                    type="text"
                    id="phone"
                    name="phone"
                    value="{{ old('phone', auth()->user()->phone) }}"
                    placeholder="Enter your phone number"
                    class="form-control @error('phone') is-invalid @enderror"
                >

                @error('phone')

                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                @enderror

            </div>

        </div>

    </div>



    {{-- ========================================================= --}}
    {{-- ROLE --}}
    {{-- ========================================================= --}}

    <!-- <div class="form-group">

        <label>
            Role
        </label>

        <input
            type="text"
            class="form-control"
            value="{{ auth()->user()->role instanceof \BackedEnum
                ? auth()->user()->role->value
                : auth()->user()->role }}"
            readonly
        >

        <small class="form-text text-muted">
            Your role can only be changed by an administrator.
        </small>

    </div> -->



    {{-- ========================================================= --}}
    {{-- MEMBER SINCE --}}
    {{-- ========================================================= --}}

    <!-- <div class="form-group">

        <label>
            Member Since
        </label>

        <input
            type="text"
            class="form-control"
            value="{{ auth()->user()->created_at?->format('F d, Y') }}"
            readonly
        >

    </div> -->



    {{-- ========================================================= --}}
    {{-- ACTION --}}
    {{-- ========================================================= --}}

    <div class="d-flex justify-content-end mt-4">

        <button
            type="submit"
            class="btn btn-warning"
        >

            <i class="fas fa-save mr-1"></i>

            Save Changes

        </button>

    </div>

</form>



@section('js')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const input = document.getElementById('profile_image');

    const preview = document.getElementById('profile-preview');

    const placeholder =
        document.getElementById('profile-placeholder');

    if (!input) {
        return;
    }


    input.addEventListener('change', function (event) {

        const file = event.target.files[0];

        if (!file) {
            return;
        }


        // Update Bootstrap file name
        const label =
            document.querySelector(
                'label[for="profile_image"]'
            );

        if (label) {
            label.textContent = file.name;
        }


        // Preview image
        const reader = new FileReader();

        reader.onload = function (e) {

            preview.src = e.target.result;

            preview.style.display = 'block';

            if (placeholder) {
                placeholder.style.display = 'none';
            }

        };

        reader.readAsDataURL(file);

    });

});

</script>

@stop