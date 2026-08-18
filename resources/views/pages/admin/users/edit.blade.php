@extends('layouts.admin')

@section('title', 'Edit User')

@section('content_header')


<div class="mb-3">

    <a href="{{ route('admin.users.index') }}" class="text-muted">
        <i class="fas fa-arrow-left mr-1"></i>
        Back to Users
    </a>

    <h1 class="mt-3 mb-1">
        Edit User
    </h1>

    <p class="text-muted mb-0">
        Update {{ $user->name }}'s account information.
    </p>

</div>


@stop

@section('content')


<div class="row justify-content-center">

    <div class="col-lg-8 col-md-10">

        <div class="card card-outline card-warning">

            <div class="card-header">

                <h3 class="card-title">
                    <i class="fas fa-user-edit mr-2"></i>
                    User Information
                </h3>

            </div>


            <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="card-body">

                    <div class="row">

                        {{-- ================================================= --}}
                        {{-- PROFILE IMAGE --}}
                        {{-- ================================================= --}}

                        <div class="col-md-12 mb-4">

                            <label>
                                Profile Image
                            </label>

                            <div class="d-flex align-items-center">


                                {{-- Current Avatar --}}
                                <div class="mr-4">

                                    @if($user->profile_image)

                                        <img id="profile-preview"
                                            src="{{ asset('images/profiles/' . $user->profile_image) }}"
                                            alt="{{ $user->name }}" class="rounded-circle" style="
                                                            width: 100px;
                                                            height: 100px;
                                                            object-fit: cover;
                                                        ">

                                    @else
                                        <div id="profile-placeholder" class="rounded-circle bg-warning
                                                               d-flex align-items-center
                                                               justify-content-center" style="
                                                            width: 100px;
                                                            height: 100px;
                                                        ">

                                            <strong class="text-white" style="font-size: 36px;">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </strong>

                                        </div>
                                        <img id="profile-preview" src="" alt="Profile preview" class="rounded-circle" style="
                                                            width: 100px;
                                                            height: 100px;
                                                            object-fit: cover;
                                                            display: none;
                                                        ">

                                    @endif

                                </div>


                                {{-- Upload --}}
                                <div class="flex-grow-1">

                                    <div class="custom-file">

                                        <input type="file" name="profile_image" id="profile_image"
                                            class="custom-file-input @error('profile_image') is-invalid @enderror"
                                            accept="image/jpeg,image/png,image/jpg,image/webp">

                                        <label class="custom-file-label" for="profile_image">
                                            Choose image
                                        </label>

                                    </div>
                                    <small class="form-text text-muted">

                                        JPG, JPEG, PNG or WEBP.
                                        Maximum 2MB.

                                    </small>

                                    @error('profile_image')

                                        <span class="text-danger text-sm">
                                            {{ $message }}
                                        </span>

                                    @enderror


                                    {{-- Remove Image --}}
                                    @if($user->profile_image)

                                        <div class="mt-2">

                                            <div class="custom-control custom-checkbox">

                                                <input type="checkbox" name="remove_image" value="1" id="remove_image"
                                                    class="custom-control-input">
                                                <label for="remove_image" class="custom-control-label text-danger">
                                                    Remove profile image
                                                </label>

                                            </div>

                                        </div>

                                    @endif

                                </div>

                            </div>

                        </div>

                        {{-- Name --}}
                        <div class="col-md-12 mb-3">

                            <label for="name">
                                Full Name
                            </label>

                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                                class="form-control @error('name') is-invalid @enderror">

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Email --}}
                        <div class="col-md-6 mb-3">

                            <label for="email">
                                Email
                            </label>

                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                required class="form-control @error('email') is-invalid @enderror">

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Phone --}}
                        <div class="col-md-6 mb-3">

                            <label for="phone">
                                Phone
                            </label>

                            <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                                class="form-control @error('phone') is-invalid @enderror">

                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Role --}}
                        <div class="col-md-6 mb-3">

                            <label for="role">
                                Role
                            </label>

                            @php
                                $currentRole = $user->role instanceof \BackedEnum
                                    ? $user->role->value
                                    : $user->role;
                            @endphp

                            <select id="role" name="role" required
                                class="form-control @error('role') is-invalid @enderror">

                                @foreach(\App\Enums\UserRole::cases() as $role)

                                    <option value="{{ $role->value }}" @selected(old('role', $currentRole) === $role->value)>
                                        {{ $role->value }}
                                    </option>

                                @endforeach

                            </select>

                            @error('role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Password --}}
                        <div class="col-md-6 mb-3">

                            <label for="password">
                                New Password
                                <small class="text-muted">
                                    (optional)
                                </small>
                            </label>

                            <input type="password" id="password" name="password"
                                placeholder="Leave empty to keep current"
                                class="form-control @error('password') is-invalid @enderror">

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                </div>


                {{-- Actions --}}
                <div class="card-footer d-flex justify-content-end">

                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary mr-2">
                        <i class="fas fa-times mr-1"></i>
                        Cancel
                    </a>

                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save mr-1"></i>
                        Save Changes
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


@stop

@section('js')

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const input = document.getElementById('profile_image');
        const preview = document.getElementById('profile-preview');
        const placeholder = document.getElementById('profile-placeholder');

        if (!input) {
            return;
        }

        input.addEventListener('change', function (event) {

            const file = event.target.files[0];

            if (!file) {
                return;
            }

            // Change file name shown by Bootstrap
            const label = document.querySelector(
                'label[for="profile_image"]'
            );

            if (label) {
                label.textContent = file.name;
            }

            // Preview
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