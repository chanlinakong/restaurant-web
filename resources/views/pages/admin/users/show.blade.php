@extends('adminlte::page')

@section('title', 'User Details')

@section('content_header')

    <a
        href="{{ route('admin.users.index') }}"
        class="text-muted"
    >
        <i class="fas fa-arrow-left mr-1"></i>
        Back to Users
    </a>

    <h1 class="mt-3 mb-1">
        User Details
    </h1>

    <p class="text-muted mb-0">
        View account information and user details.
    </p>

@stop

@section('content')

<div class="row justify-content-center">

    <div class="col-xl-8 col-lg-9 col-md-10">

        <div class="card card-outline card-warning">

            {{-- Header --}}
            <div class="card-header">

                <div class="d-flex align-items-center">

                    {{-- Avatar --}}
                    <div
                        class="rounded-circle bg-warning d-flex
                               align-items-center justify-content-center
                               text-white font-weight-bold mr-3"
                        style="width: 60px; height: 60px; font-size: 24px;"
                    >
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>

                    {{-- User --}}
                    <div class="flex-grow-1">

                        <h3 class="card-title font-weight-bold">
                            {{ $user->name }}
                        </h3>

                        <div class="text-muted small mt-1">
                            {{ $user->email }}
                        </div>

                    </div>

                    <!-- <a
                        href="{{ route('admin.users.edit', $user) }}"
                        class="btn btn-warning"
                    >
                        <i class="fas fa-edit mr-1"></i>
                        Edit
                    </a> -->

                </div>

            </div>


            {{-- Account Information --}}
            <div class="card-body">

                <h5 class="font-weight-bold mb-4">
                    <i class="fas fa-user mr-2"></i>
                    Account Information
                </h5>

                <div class="row">

                    {{-- Full Name --}}
                    <div class="col-md-6 mb-4">

                        <label class="text-muted small text-uppercase">
                            Full Name
                        </label>

                        <div class="font-weight-bold">
                            {{ $user->name }}
                        </div>

                    </div>


                    {{-- Email --}}
                    <div class="col-md-6 mb-4">

                        <label class="text-muted small text-uppercase">
                            Email
                        </label>

                        <div class="font-weight-bold">
                            {{ $user->email }}
                        </div>

                    </div>


                    {{-- Phone --}}
                    <div class="col-md-6 mb-4">

                        <label class="text-muted small text-uppercase">
                            Phone
                        </label>

                        <div class="font-weight-bold">
                            {{ $user->phone ?: 'Not provided' }}
                        </div>

                    </div>


                    {{-- Role --}}
                    <div class="col-md-6 mb-4">

                        <label class="text-muted small text-uppercase">
                            Role
                        </label>

                        @php
                            $role = $user->role instanceof \BackedEnum
                                ? $user->role->value
                                : $user->role;
                        @endphp

                        <div>

                            <span class="badge badge-warning">
                                {{ $role }}
                            </span>

                        </div>

                    </div>


                    {{-- Email Verification --}}
                    <div class="col-md-6 mb-4">

                        <label class="text-muted small text-uppercase">
                            Email Verification
                        </label>

                        <div>

                            @if($user->email_verified_at)

                                <span class="badge badge-success">
                                    <i class="fas fa-check mr-1"></i>
                                    Verified
                                </span>

                            @else

                                <span class="badge badge-secondary">
                                    <i class="fas fa-times mr-1"></i>
                                    Not Verified
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- Registered --}}
                    <div class="col-md-6 mb-4">

                        <label class="text-muted small text-uppercase">
                            Registered
                        </label>

                        <div class="font-weight-bold">
                            {{ $user->created_at?->format('M d, Y h:i A') }}
                        </div>

                    </div>

                </div>

            </div>


            {{-- Footer --}}
            <div class="card-footer d-flex justify-content-end">

                <a
                    href="{{ route('admin.users.index') }}"
                    class="btn btn-secondary mr-3"
                >
                    <i class="fas fa-arrow-left mr-1"></i>
                    Back to Users
                </a>

                <a
                    href="{{ route('admin.users.edit', $user) }}"
                    class="btn btn-warning"
                >
                    <i class="fas fa-edit mr-1"></i>
                    Edit User
                </a>

            </div>

        </div>

    </div>

</div>

@stop



