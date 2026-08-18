@extends('layouts.admin')

@section('title', 'Add User')

@section('content_header')

<div class="mb-3">

    <a
        href="{{ route('admin.users.index') }}"
        class="text-muted"
    >
        <i class="fas fa-arrow-left mr-1"></i>
        Back to Users
    </a>

    <h1 class="mt-3 mb-1">
        Add User
    </h1>

    <p class="text-muted mb-0">
        Create a new restaurant system account.
    </p>

</div>

@stop

@section('content')


<div class="row justify-content-center">

    <div class="col-lg-8 col-md-10">

        <div class="card card-outline card-warning">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user-plus mr-2"></i>
                    User Information
                </h3>
            </div>

            <form
                action="{{ route('admin.users.store') }}"
                method="POST"
            >

                @csrf

                <div class="card-body">

                    <div class="row">

                        {{-- Name --}}
                        <div class="col-md-12 mb-3">

                            <label for="name">
                                Full Name
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                placeholder="Enter full name"
                                class="form-control @error('name') is-invalid @enderror"
                            >

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

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                placeholder="example@email.com"
                                class="form-control @error('email') is-invalid @enderror"
                            >

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

                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                value="{{ old('phone') }}"
                                placeholder="+855 12 345 678"
                                class="form-control @error('phone') is-invalid @enderror"
                            >

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

                            <select
                                id="role"
                                name="role"
                                required
                                class="form-control @error('role') is-invalid @enderror"
                            >

                                @foreach(\App\Enums\UserRole::cases() as $role)

                                    <option
                                        value="{{ $role->value }}"
                                        @selected(old('role') === $role->value)
                                    >
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
                                Password
                            </label>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                required
                                placeholder="Enter password"
                                class="form-control @error('password') is-invalid @enderror"
                            >

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

                    <a
                        href="{{ route('admin.users.index') }}"
                        class="btn btn-secondary mr-2"
                    >
                        <i class="fas fa-times mr-1"></i>
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="btn btn-warning"
                    >
                        <i class="fas fa-user-plus mr-1"></i>
                        Create User
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


@stop
