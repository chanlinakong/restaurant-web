@extends('adminlte::page')

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

    {{-- Profile Header --}}
    <div class="card card-outline card-warning shadow-sm mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">

                {{-- Avatar --}}
                <div class="mr-4">
                    <div
                        class="rounded-circle bg-warning d-flex align-items-center justify-content-center"
                        style="width: 80px; height: 80px;"
                    >
                        <i class="fas fa-user fa-2x text-white"></i>
                    </div>
                </div>

                {{-- User Information --}}
                <div>
                    <h3 class="mb-1 font-weight-bold">
                        {{ auth()->user()->name }}
                    </h3>

                    <p class="text-muted mb-1">
                        <i class="fas fa-envelope mr-2"></i>
                        {{ auth()->user()->email }}
                    </p>

                    <span class="badge badge-warning">
                        <i class="fas fa-user-shield mr-1"></i>
                        {{ auth()->user()->role->value ?? auth()->user()->role }}
                    </span>
                </div>

            </div>
        </div>
    </div>


    {{-- Profile Information --}}
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
            @include('profile.partials.update-profile-information-form')
        </div>

    </div>


    {{-- Password --}}
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
            @include('profile.partials.update-password-form')
        </div>

    </div>


    {{-- Delete Account --}}
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

            @include('profile.partials.delete-user-form')

        </div>

    </div>

@stop