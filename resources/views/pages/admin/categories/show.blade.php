@extends('layouts.admin')

@section('title', $category->name)

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
        Category Details
    </h1>

    <p class="text-muted mb-0">
        View category information.
    </p>

</div>

@stop

@section('content')

<div class="row justify-content-center">

    <div class="col-lg-8 col-md-10">

        <div class="card card-outline card-warning">

            <div class="card-body p-4">

                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-start">

                    <div class="d-flex align-items-center">

                        <div
                            class="bg-warning rounded d-flex align-items-center justify-content-center mr-3"
                            style="width: 56px; height: 56px;"
                        >
                            <i class="fas fa-layer-group fa-lg text-white"></i>
                        </div>

                        <div>

                            <h2 class="h4 font-weight-bold mb-1">
                                {{ $category->name }}
                            </h2>

                            <small class="text-muted">
                                Category #{{ $category->id }}
                            </small>

                        </div>

                    </div>


                    {{-- Edit --}}
                    <a
                        href="{{ route('admin.category.edit', $category) }}"
                        class="btn btn-outline-primary btn-sm"
                        title="Edit Category"
                    >
                        <i class="fas fa-edit mr-1"></i>
                        Edit
                    </a>

                </div>


                <hr>


                {{-- Description --}}
                <div class="mb-4">

                    <h6 class="text-uppercase text-muted font-weight-bold">
                        Description
                    </h6>

                    <p class="text-muted mb-0">
                        {{ $category->description ?: 'No description available.' }}
                    </p>

                </div>


                {{-- Category ID --}}
                <div class="bg-light rounded p-3 mb-3">

                    <small class="text-muted text-uppercase">
                        Category ID
                    </small>

                    <div class="font-weight-bold mt-1">
                        #{{ $category->id }}
                    </div>

                </div>


                {{-- Created --}}
                <div class="text-muted small">

                    <i class="far fa-calendar-alt mr-1"></i>

                    Created:
                    {{ $category->created_at?->format('M d, Y h:i A') }}

                </div>

            </div>

        </div>

    </div>

</div>


@stop
