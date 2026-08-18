@extends('layouts.admin')

@section('title', 'Categories')

@section('content_header')
    <!-- <a
        href="{{ route('dashboard') }}"
        class="text-muted"
    >
        <i class="fas fa-arrow-left mr-1"></i>
        Back to Dashboard
    </a> -->

    <h1 class="mt-3 mb-1">
        Categories
    </h1>

    <p class="text-muted mb-0">
        Manage your restaurant categories.
    </p>

@stop

@section('content')

<div class="card card-outline card-primary">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h3 class="card-title">
            <i class="fas fa-tags mr-2"></i>
            Category List
        </h3>

        <a
            href="{{ route('admin.category.create') }}"
            class="btn btn-primary"
        >
            <i class="fas fa-plus mr-1"></i>
            Add Category
        </a>

    </div>

    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle mr-1"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle mr-1"></i>
                {{ session('error') }}
            </div>
        @endif

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead>
                    <tr>
                        <th width="70">#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th width="180">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($categories as $category)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $category->name }}
                            </td>

                            <td>
                                {{ $category->description ?? '-' }}
                            </td>

                            <td>

                                <a
                                    href="{{ route('admin.category.edit', $category) }}"
                                    class="btn btn-warning btn-sm"
                                >
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form
                                    action="{{ route('admin.category.destroy', $category) }}"
                                    method="POST"
                                    class="d-inline"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this category?')"
                                    >
                                        <i class="fas fa-trash"></i>
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td
                                colspan="4"
                                class="text-center text-muted py-4"
                            >
                                <i class="fas fa-tags fa-2x mb-2"></i>

                                <div>
                                    No categories found.
                                </div>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@stop

