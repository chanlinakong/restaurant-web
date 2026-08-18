@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content_header')


<div class="mb-3">

    <a
        href="{{ route('admin.category.index') }}"
        class="text-muted"
    >
        <i class="fas fa-arrow-left mr-1"></i>
        Back to Categories
    </a>

    <h1 class="mt-3 mb-1">
        Edit Category
    </h1>

    <p class="text-muted mb-0">
        Update category information.
    </p>

</div>


@stop

@section('content')

<div class="row justify-content-center">

    <div class="col-lg-7 col-md-9">

        <div class="card card-outline card-warning">

            <div class="card-header">

                <h3 class="card-title">
                    <i class="fas fa-layer-group mr-2"></i>
                    Category Information
                </h3>

            </div>


            <form
                action="{{ route('admin.category.update', $category) }}"
                method="POST"
            >

                @csrf
                @method('PUT')

                <div class="card-body">

                    {{-- Category Name --}}
                    <div class="form-group">

                        <label for="name">
                            Category Name
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $category->name) }}"
                            required
                            class="form-control @error('name') is-invalid @enderror"
                        >

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Description --}}
                    <div class="form-group mb-0">

                        <label for="description">
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="5"
                            required
                            class="form-control @error('description') is-invalid @enderror"
                        >{{ old('description', $category->description) }}</textarea>

                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>


                {{-- Actions --}}
                <div class="card-footer d-flex justify-content-end">

                    <a
                        href="{{ route('admin.category.index') }}"
                        class="btn btn-secondary mr-2"
                    >
                        <i class="fas fa-times mr-1"></i>
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="btn btn-warning"
                    >
                        <i class="fas fa-save mr-1"></i>
                        Save Changes
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


@stop
