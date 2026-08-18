@extends('layouts.admin')

@section('title', 'Edit Menu Item')

@section('content_header')

<div class="d-flex align-items-center">


    <a href="{{ route('admin.menu-items.index') }}" class="btn btn-default mr-3">
        <i class="fas fa-arrow-left"></i>
    </a>

    <div>
        <h1 class="mb-1">Edit Menu Item</h1>

        <p class="text-muted mb-0">
            Update {{ $menuItem->name }}.
        </p>
    </div>


</div>

@stop

@section('content')

<div class="row">


    <div class="col-lg-10 mx-auto">

        <form action="{{ route('admin.menu-items.update', $menuItem) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')


            <div class="card card-outline card-warning">

                <div class="card-header">

                    <h3 class="card-title">
                        <i class="fas fa-utensils mr-1"></i>
                        Menu Item Information
                    </h3>

                </div>


                <div class="card-body">

                    <div class="row">

                        {{-- Name --}}
                        <div class="col-md-12">

                            <div class="form-group">

                                <label>Menu Item Name</label>

                                <input type="text" name="name" value="{{ old('name', $menuItem->name) }}"
                                    class="form-control @error('name') is-invalid @enderror" required>

                                @error('name')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>

                        </div>


                        {{-- Category --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Category</label>

                                <select name="category_id"
                                    class="form-control @error('category_id') is-invalid @enderror" required>

                                    @foreach($categories as $category)

                                        <option value="{{ $category->id }}" @selected(
                                            old(
                                                'category_id',
                                                $menuItem->category_id
                                            ) == $category->id
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

                                <label>Price</label>

                                <div class="input-group">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>

                                    <input type="number" name="price" value="{{ old('price', $menuItem->price) }}"
                                        step="0.01" min="0" class="form-control @error('price') is-invalid @enderror"
                                        required>

                                </div>

                                @error('price')
                                    <span class="text-danger text-sm">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>

                        </div>


                        {{-- Preparation --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Preparation Time</label>

                                <div class="input-group">

                                    <input type="number" name="preparation_time"
                                        value="{{ old('preparation_time', $menuItem->preparation_time) }}" min="0"
                                        class="form-control">

                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            minutes
                                        </span>
                                    </div>

                                </div>

                                @error('preparation_time')
                                    <span class="text-danger text-sm">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>

                        </div>

                        {{-- ================================================= --}}
                        {{-- IMAGE URL --}}
                        {{-- ================================================= --}}

                        {{-- Image --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="image">
                                    Menu Image
                                </label>

                                <div class="custom-file">

                                    <input type="file" name="image" id="image"
                                        class="custom-file-input @error('image') is-invalid @enderror"
                                        accept="image/jpeg,image/png,image/jpg,image/webp">

                                    <label class="custom-file-label" for="image">
                                        Choose image
                                    </label>

                                </div>

                                <small class="form-text text-muted">
                                    JPG, JPEG, PNG or WEBP. Maximum 2MB.
                                </small>

                                @error('image')

                                    <span class="text-danger text-sm">
                                        {{ $message }}
                                    </span>

                                @enderror

                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- IMAGE PREVIEW --}}
                        {{-- ================================================= --}}

                        @if($menuItem->image_url)

                            <div class="col-md-12">

                                <div class="form-group">

                                    <label>
                                        Current Image
                                    </label>

                                    <div>

                                        <img src="{{ asset($menuItem->image_url) }}" alt="{{ $menuItem->name }}"
                                            class="img-thumbnail" style="
                                                                        width: 180px;
                                                                        height: 180px;
                                                                        object-fit: cover;
                                                                    " onerror="
                                                                        this.style.display='none';
                                                                        document
                                                                            .getElementById('image-error')
                                                                            .style.display='block';
                                                                    ">

                                        <div id="image-error" class="alert alert-warning" style="display:none;">

                                            <i class="fas fa-exclamation-triangle mr-1"></i>

                                            Unable to load this image URL.

                                        </div>

                                    </div>

                                </div>

                            </div>

                        @endif



                        {{-- Image --}}
                        <!-- <div class="col-md-6">

                        <div class="form-group">

                            <label>Image URL</label>

                            <input
                                type="url"
                                name="image_url"
                                value="{{ old('image_url', $menuItem->image_url) }}"
                                placeholder="https://example.com/image.jpg"
                                class="form-control @error('image_url') is-invalid @enderror"
                            >

                            @error('image_url')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                    </div> -->


                        {{-- Description --}}
                        <div class="col-md-12">

                            <div class="form-group">

                                <label>Description</label>

                                <textarea name="description" rows="5"
                                    class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Describe the dish...">{{ old('description', $menuItem->description) }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>

                        </div>


                        {{-- Availability --}}
                        <div class="col-md-12">

                            <div class="custom-control custom-checkbox">

                                <input type="hidden" name="is_available" value="0">

                                <input type="checkbox" name="is_available" value="1" id="is_available" @checked(
                                    old(
                                        'is_available',
                                        $menuItem->is_available
                                    )
                                ) class="custom-control-input">

                                <label for="is_available" class="custom-control-label">
                                    <strong>
                                        Available for customers
                                    </strong>

                                    <small class="d-block text-muted">
                                        Customers can order this item when enabled.
                                    </small>
                                </label>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="card-footer text-right">

                    <a href="{{ route('admin.menu-items.index') }}" class="btn btn-default mr-2">
                        Cancel
                    </a>

                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save mr-1"></i>
                        Save Changes
                    </button>

                </div>

            </div>

        </form>

    </div>


</div>

@stop

@section('js')

<script>

    document
        .getElementById('image')
        .addEventListener('change', function (event) {

            const file = event.target.files[0];

            if (!file) {
                return;
            }

            const label = document.querySelector(
                'label[for="image"]'
            );

            label.textContent = file.name;

        });

</script>

@stop