@extends('layouts.admin')

@section('title', 'Users')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <div>
        <h1 class="mb-1">Users</h1>
        <p class="text-muted mb-0">
            Manage customers, staff and administrator accounts. </p>
    </div>


    <a href="{{ route('admin.users.create') }}" class="btn btn-warning">
        <i class="fas fa-plus mr-1"></i>
        Add User
    </a>
</div>


@stop

@section('content')


{{-- Main Card --}}
<div class="card card-outline card-warning">

    {{-- Filters --}}
    <div class="card-header">

        <form method="GET" action="{{ route('admin.users.search') }}">

            <div class="row">

                {{-- Search --}}
                <div class="col-md-8 mb-2 mb-md-0">

                    <div class="input-group">

                        <input type="text" name="search" class="form-control" placeholder="Search users..."
                            value="{{ request('search') }}">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>

                    </div>

                </div>


                {{-- Role --}}
                <div class="col-md-4">

                    <select name="role" class="form-control" onchange="this.form.submit()">
                        <option value="">
                            All Roles
                        </option>

                        <option value="Admin" {{ request('role') === 'Admin' ? 'selected' : '' }}>
                            Admin
                        </option>

                        <option value="Staff" {{ request('role') === 'Staff' ? 'selected' : '' }}>
                            Staff
                        </option>

                        <option value="Customer" {{ request('role') === 'Customer' ? 'selected' : '' }}>
                            Customer
                        </option>
                    </select>

                </div>

            </div>

        </form>

    </div>

    {{-- Table --}}
    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover mb-0">

                <thead class="thead-light">
                    <tr>
                        <th>User</th>
                        <th>Contact</th>
                        <th>Role</th>
                        <th>Verification</th>
                        <th>Joined</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($users as $user)

                        @php
                            $role = $user->role instanceof \BackedEnum
                                ? $user->role->value
                                : $user->role;
                        @endphp

                        <tr>

                            {{-- User --}}
                            <td class="align-middle">

                                <!-- <div class="d-flex align-items-center">

                                                        <div class="rounded-circle bg-warning d-flex align-items-center justify-content-center mr-3"
                                                            style="width: 40px; height: 40px;">
                                                            <strong class="text-white">
                                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                                            </strong>
                                                        </div>

                                                        <div>
                                                            <div class="font-weight-bold">
                                                                {{ $user->name }}
                                                            </div>

                                                            <small class="text-muted">
                                                                #{{ $user->id }}
                                                            </small>
                                                        </div>

                                                    </div> -->
                            <td class="align-middle">

                                <div class="d-flex align-items-center">

                                    @if($user->profile_image)

                                        <img src="{{ asset('images/profiles/' . $user->profile_image) }}" alt="{{ $user->name }}"
                                            class="rounded-circle mr-3" style="
                                                                            width: 40px;
                                                                            height: 40px;
                                                                            object-fit: cover;
                                                                        ">

                                    @else

                                        <div class="rounded-circle bg-warning d-flex align-items-center justify-content-center mr-3"
                                            style="width: 40px; height: 40px;">
                                            <strong class="text-white">

                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </strong>
                                        </div>

                                    @endif

                                    <div>

                                        <div class="font-weight-bold">
                                            {{ $user->name }}
                                        </div>

                                        <small class="text-muted">
                                            #{{ $user->id }}
                                        </small>

                                    </div>

                                </div>

                            </td>

                            </td>

                            {{-- Contact --}}
                            <td class="align-middle">

                                <div>
                                    {{ $user->email }}
                                </div>

                                @if($user->phone)
                                    <small class="text-muted">
                                        {{ $user->phone }}
                                    </small>
                                @endif

                            </td>

                            {{-- Role --}}
                            <td class="align-middle">

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

                            </td>

                            {{-- Verification --}}
                            <td class="align-middle">

                                @if($user->email_verified_at)

                                    <span class="text-success">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Verified
                                    </span>

                                @else

                                    <span class="text-muted">
                                        <i class="fas fa-clock mr-1"></i>
                                        Pending
                                    </span>

                                @endif

                            </td>

                            {{-- Joined --}}
                            <td class="align-middle text-muted">

                                {{ $user->created_at?->format('M d, Y') }}

                            </td>

                            {{-- Actions --}}
                            <td class="align-middle">

                                <div class="d-flex justify-content-end">

                                    {{-- View --}}
                                    <a href="{{ route('admin.users.show', $user) }}"
                                        class="btn btn-sm btn-outline-secondary mr-1" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    {{-- Edit --}}
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                        class="btn btn-sm btn-outline-primary mr-1" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                        onsubmit="return confirm('Delete this user?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="text-center py-5">

                                <div class="text-muted">

                                    <i class="fas fa-users fa-3x mb-3"></i>

                                    <h5>No users found</h5>

                                    <p class="mb-3">
                                        Create your first user to get started.
                                    </p>

                                    <a href="{{ route('admin.users.create') }}" class="btn btn-warning">
                                        <i class="fas fa-plus mr-1"></i>
                                        Add User
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- Pagination --}}
    @if(method_exists($users, 'links'))
        <div class="card-footer">
            {{ $users->links() }}
        </div>
    @endif

</div>

@stop