@extends('layouts.admin')

@section('title', $menuItem->name)

@section('content_header')

<div class="d-flex align-items-center justify-content-between">


<div>
    <h1 class="mb-1 font-weight-bold">
        Menu Item Details
    </h1>

    <p class="text-muted mb-0">
        View menu item information.
    </p>
</div>

<!-- <a
    href="{{ route('admin.menu-items.index') }}"
    class="btn btn-default"
>
    <i class="fas fa-arrow-left mr-1"></i>
    Back to Menu Items
</a> -->

</div>

@stop

@section('content')

<div class="card card-outline card-warning shadow-sm">


<div class="row no-gutters">

    {{-- Image --}}
    <div class="col-md-6">

        @if($menuItem->image_url)

            <img
                src="{{ asset($menuItem->image_url) }}"
                alt="{{ $menuItem->name }}"
                class="img-fluid w-100"
                style="height: 100%; min-height: 420px; object-fit: cover;"
            >

        @else

            <div
                class="d-flex align-items-center justify-content-center bg-light"
                style="min-height: 420px;"
            >

                <div class="text-center text-muted">

                    <div
                        class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded"
                        style="
                            width: 80px;
                            height: 80px;
                            background: #f3f4f6;
                        "
                    >
                        <i class="fas fa-utensils fa-2x"></i>
                    </div>

                    <p class="mb-0">
                        No image available
                    </p>

                </div>

            </div>

        @endif

    </div>


    {{-- Details --}}
    <div class="col-md-6">

        <div class="card-body p-4 p-lg-5">

            {{-- Category --}}
            <div class="mb-3">

                <span class="badge badge-warning px-3 py-2">
                    <i class="fas fa-layer-group mr-1"></i>

                    {{ $menuItem->category->name }}

                </span>

            </div>


            {{-- Name --}}
            <h2 class="font-weight-bold mb-3">

                {{ $menuItem->name }}

            </h2>


            {{-- Price --}}
            <div class="mb-4">

                <span class="text-warning font-weight-bold"
                      style="font-size: 2rem;">

                    ${{ number_format($menuItem->price, 2) }}

                </span>

            </div>


            {{-- Description --}}
            <div class="mb-4">

                <h6 class="text-uppercase text-muted font-weight-bold">
                    Description
                </h6>

                <p class="text-secondary mb-0"
                   style="line-height: 1.7;">

                    {{ $menuItem->description ?: 'No description provided.' }}

                </p>

            </div>


            {{-- Information --}}
            <div class="row">

                {{-- Preparation --}}
                <div class="col-6">

                    <div class="bg-light rounded p-3 h-100">

                        <div class="text-warning mb-2">
                            <i class="far fa-clock fa-lg"></i>
                        </div>

                        <small class="text-muted d-block">
                            Preparation
                        </small>

                        <strong class="d-block mt-1">

                            {{ $menuItem->preparation_time
                                ? $menuItem->preparation_time . ' minutes'
                                : 'Not specified' }}

                        </strong>

                    </div>

                </div>


                {{-- Status --}}
                <div class="col-6">

                    <div class="bg-light rounded p-3 h-100">

                        <div class="
                            mb-2
                            {{ $menuItem->is_available
                                ? 'text-success'
                                : 'text-danger' }}
                        ">

                            <i class="fas fa-circle fa-sm"></i>

                        </div>

                        <small class="text-muted d-block">
                            Status
                        </small>

                        <strong
                            class="
                                d-block
                                mt-1
                                {{ $menuItem->is_available
                                    ? 'text-success'
                                    : 'text-danger' }}
                            "
                        >

                            {{ $menuItem->is_available
                                ? 'Available'
                                : 'Unavailable' }}

                        </strong>

                    </div>

                </div>

            </div>


            {{-- Actions --}}
            <div class="d-flex justify-content-end mt-4 pt-4 border-top">

                <a
                    href="{{ route('admin.menu-items.index') }}"
                    class="btn btn-default mr-2"
                >
                    <i class="fas fa-arrow-left mr-1"></i>
                    Back
                </a>


                <a
                    href="{{ route('admin.menu-items.edit', $menuItem) }}"
                    class="btn btn-warning"
                >
                    <i class="fas fa-edit mr-1"></i>
                    Edit Menu Item
                </a>

            </div>

        </div>

    </div>

</div>


</div>

@stop
