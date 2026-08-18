@extends('layouts.admin')

@section('title', 'Add Menu Items')

@section('content_header')

<div class="d-flex align-items-center">


    <a href="{{ route('admin.menu-items.index') }}" class="btn btn-default mr-3">
        <i class="fas fa-arrow-left"></i>
    </a>

    <div>
        <h1 class="mb-1">Add Menu Item</h1>

        <p class="text-muted mb-0">
            Add a new dish to your restaurant menu.
        </p>
    </div>


</div>

@stop

@section('content')

<div class="col-md-10 offset-md-1">


    <form action="{{ route('admin.menu-items.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="card card-outline card-warning">

            {{-- Header --}}
            <div class="card-header">

                <h3 class="card-title">

                    <i class="fas fa-utensils mr-1"></i>

                    Menu Item Information

                </h3>

            </div>


            {{-- Body --}}
            <div class="card-body">

                {{-- Name --}}
                <div class="form-group">

                    <label>
                        Menu Item Name
                    </label>

                    <input type="text" name="name" value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid @enderror" placeholder="e.g. Classic Beef Burger"
                        required>

                    @error('name')

                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>

                    @enderror

                </div>


                {{-- Category + Price --}}
                <div class="row">

                    {{-- Category --}}
                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Category
                            </label>

                            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror"
                                required>

                                <option value="">
                                    Select category
                                </option>

                                @foreach($categories as $category)

                                    <option value="{{ $category->id }}" @selected(
                                        old('category_id') == $category->id
                                    )>
                                        {{ $category->name }}
                                    </option>

                                @endforeach

                            </select>

                            @error('category_id')

                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>

                            @enderror

                        </div>

                    </div>


                    {{-- Price --}}
                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Price
                            </label>

                            <div class="input-group">

                                <div class="input-group-prepend">

                                    <span class="input-group-text">
                                        $
                                    </span>

                                </div>

                                <input type="number" name="price" value="{{ old('price') }}" step="0.01" min="0"
                                    class="form-control @error('price') is-invalid @enderror" placeholder="0.00"
                                    required>

                            </div>

                            @error('price')

                                <span class="text-danger small">
                                    {{ $message }}
                                </span>

                            @enderror

                        </div>

                    </div>

                </div>


                {{-- Preparation + Image --}}
                <div class="row">

                    {{-- Preparation --}}
                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Preparation Time
                            </label>

                            <div class="input-group">

                                <input type="number" name="preparation_time" value="{{ old('preparation_time') }}"
                                    min="0" class="form-control @error('preparation_time') is-invalid @enderror"
                                    placeholder="15">

                                <div class="input-group-append">

                                    <span class="input-group-text">
                                        minutes
                                    </span>

                                </div>

                            </div>

                            @error('preparation_time')

                                <span class="invalid-feedback d-block">
                                    {{ $message }}
                                </span>

                            @enderror

                        </div>

                    </div>


                    {{-- Image URL --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image">Menu Image</label>

                            <input type="file" name="image" id="image"
                                class="form-control-file @error('image') is-invalid @enderror"
                                accept="image/jpeg,image/png,image/jpg,image/webp">

                            @error('image')
                                <span class="invalid-feedback d-block">
                                    {{ $message }}
                                </span>
                            @enderror

                            <small class="form-text text-muted">
                                JPG, JPEG, PNG, or WebP. Maximum size: 2MB.
                            </small>
                        </div>
                    </div>

                </div>


                {{-- Description --}}
                <div class="form-group">

                    <label>
                        Description
                    </label>

                    <textarea name="description" rows="5"
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="Describe the dish...">{{ old('description') }}</textarea>

                    @error('description')

                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>

                    @enderror

                </div>


                {{-- Availability --}}
                <div class="form-group mb-0">

                    <div class="custom-control custom-checkbox">

                        <input type="checkbox" name="is_available" value="1" id="is_available"
                            class="custom-control-input" @checked(old('is_available', true))>

                        <label class="custom-control-label" for="is_available">

                            <strong>
                                Available for customers
                            </strong>

                            <small class="d-block text-muted mt-1">

                                Customers can order this item when it
                                is available.

                            </small>

                        </label>

                    </div>

                </div>

            </div>


            {{-- Footer --}}
            <div class="card-footer text-right">

                <a href="{{ route('admin.menu-items.index') }}" class="btn btn-default mr-2">
                    Cancel
                </a>

                <button type="submit" class="btn btn-warning">

                    <i class="fas fa-plus mr-1"></i>

                    Add Menu Item

                </button>

            </div>

        </div>

    </form>


</div>

@stop