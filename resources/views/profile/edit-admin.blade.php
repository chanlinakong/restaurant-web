@extends('layouts.admin')

@section('title', 'Profile')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-1">
                <i class="fas fa-user-circle text-warning mr-2"></i>
                Profile
            </h1>

            <p class="text-muted mb-0">
                Manage your account information, password, and account settings.
            </p>
        </div>
    </div>
@stop


@section('content')

    @php
        $user = auth()->user();

        $role = $user->role instanceof \BackedEnum
            ? $user->role->value
            : $user->role;
    @endphp


    {{-- ========================================================= --}}
    {{-- PROFILE HEADER --}}
    {{-- ========================================================= --}}

    <div class="card card-outline card-warning shadow-sm mb-4">

        <div class="card-body">

            <div class="d-flex align-items-center">

                {{-- Avatar --}}
                <div class="mr-4">

                    @if($user->profile_image)

                        <img
                            src="{{ asset('images/profiles/' . $user->profile_image) }}"
                            alt="{{ $user->name }}"
                            class="rounded-circle"
                            style="
                                width: 90px;
                                height: 90px;
                                object-fit: cover;
                            "
                        >

                    @else

                        <div
                            class="rounded-circle bg-warning
                                   d-flex align-items-center
                                   justify-content-center"
                            style="
                                width: 90px;
                                height: 90px;
                            "
                        >
                            <strong
                                class="text-white"
                                style="font-size: 36px;"
                            >
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </strong>
                        </div>

                    @endif

                </div>


                {{-- User Information --}}
                <div class="flex-grow-1">

                    <h3 class="mb-1 font-weight-bold">
                        {{ $user->name }}
                    </h3>

                    <p class="text-muted mb-1">
                        <i class="fas fa-envelope mr-2"></i>
                        {{ $user->email }}
                    </p>

                    @if($user->phone)

                        <p class="text-muted mb-2">
                            <i class="fas fa-phone mr-2"></i>
                            {{ $user->phone }}
                        </p>

                    @endif


                    {{-- Role --}}
                    @if($role === 'Admin')

                        <span class="badge badge-danger">
                            <i class="fas fa-shield-alt mr-1"></i>
                            Admin
                        </span>

                    @elseif($role === 'Staff')

                        <span class="badge badge-primary">
                            <i class="fas fa-user-tie mr-1"></i>
                            Staff
                        </span>

                    @else

                        <span class="badge badge-secondary">
                            <i class="fas fa-user mr-1"></i>
                            {{ $role }}
                        </span>

                    @endif

                </div>


                {{-- Account Status --}}
                <div class="text-right d-none d-md-block">

                    <small class="text-muted d-block">
                        Member since
                    </small>

                    <strong>
                        {{ $user->created_at?->format('M d, Y') }}
                    </strong>

                </div>

            </div>

        </div>

    </div>



    {{-- ========================================================= --}}
    {{-- PROFILE INFORMATION --}}
    {{-- ========================================================= --}}

    <div class="card shadow-sm mb-4">

        <div class="card-header bg-white">

            <h3 class="card-title font-weight-bold">
                <i class="fas fa-user-edit text-warning mr-2"></i>
                Profile Information
            </h3>

            <div class="card-tools">

                <span class="text-muted small">
                    Update your personal information
                </span>

            </div>

        </div>


        <div class="card-body">

            @include('profile.partials.update-profile-information-form-admin')

        </div>

    </div>



    {{-- ========================================================= --}}
    {{-- PASSWORD --}}
    {{-- ========================================================= --}}

    <div class="card shadow-sm mb-4">

        <div class="card-header bg-white">

            <h3 class="card-title font-weight-bold">
                <i class="fas fa-lock text-primary mr-2"></i>
                Update Password
            </h3>

            <div class="card-tools">

                <span class="text-muted small">
                    Keep your account secure
                </span>

            </div>

        </div>


        <div class="card-body">

            @include('profile.partials.update-password-form-admin')

        </div>

    </div>



    {{-- ========================================================= --}}
    {{-- DANGER ZONE --}}
    {{-- ========================================================= --}}

    <div class="card card-outline card-danger shadow-sm mb-4">

        <div class="card-header">

            <h3 class="card-title font-weight-bold text-danger">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                Danger Zone
            </h3>

        </div>


        <div class="card-body">

            <div class="alert alert-danger">

                <i class="fas fa-info-circle mr-2"></i>

                Deleting your account is permanent and cannot be undone.
                Please make sure you really want to perform this action.

            </div>


            @include('profile.partials.delete-user-form-admin')

        </div>

    </div>

@stop