@extends('layouts.admin')

@section('title', 'Menu Items')

@section('content_header')

<div class="d-flex align-items-center justify-content-between">

    <div>
        <h1 class="mb-1">Menu Items</h1>

        <p class="text-muted mb-0">
            Manage dishes, prices and availability.
        </p>
    </div>

    <a href="{{ route('admin.menu-items.create') }}" class="btn btn-warning">
        <i class="fas fa-plus mr-1"></i>
        Add Menu Item
    </a>


</div>

@stop

@section('content')

<div class="card card-outline card-warning">

    {{-- Filters --}}
    <div class="card-header">

        <form method="GET" action="{{ route('admin.menu-items.search') }}">

            <div class="row">

                {{-- Search --}}
                <div class="col-md-8 mb-2 mb-md-0">

                    <div class="input-group">

                        <input type="text" name="search" class="form-control" placeholder="Search menu items..."
                            value="{{ request('search') }}">

                        <div class="input-group-append">

                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>

                        </div>

                    </div>

                </div>


                {{-- Category --}}
                <div class="col-md-4">

                    <select name="category" class="form-control" onchange="this.form.submit()">

                        <option value="">
                            All Categories
                        </option>

                        @foreach($categories as $category)

                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>

                        @endforeach

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

                        <th>Menu Item</th>

                        <th>Category</th>

                        <th>Price</th>

                        <th>Preparation</th>

                        <th>Status</th>

                        <th class="text-right">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($menuItems as $menuItem)

                                        <tr>

                                            {{-- Menu Item --}}
                                            <td>

                                                <div class="d-flex align-items-center">

                                                    @if($menuItem->image_url)

                                                        <img src="{{ asset($menuItem->image_url) }}" alt="{{ $menuItem->name }}" class="rounded"
                                                            style="
                                                                    width: 55px;
                                                                    height: 55px;
                                                                    object-fit: cover;
                                                                ">

                                                    @else

                                                        <div class="bg-light text-muted rounded d-flex
                                                                       align-items-center justify-content-center" style="
                                                                    width: 55px;
                                                                    height: 55px;
                                                                ">
                                                            <i class="fas fa-utensils"></i>
                                                        </div>

                                                    @endif


                                                    <div class="ml-3">

                                                        <div class="font-weight-bold">

                                                            {{ $menuItem->name }}

                                                        </div>


                                                        @if($menuItem->description)

                                                                                        <small class="text-muted">

                                                                                            {{ \Illuminate\Support\Str::limit(
                                                                $menuItem->description,
                                                                60
                                                            ) }}

                                                                                        </small>

                                                        @endif

                                                    </div>

                                                </div>

                                            </td>


                                            {{-- Category --}}
                                            <td>

                                                @if($menuItem->category)

                                                    <span class="badge badge-light">

                                                        {{ $menuItem->category->name }}

                                                    </span>

                                                @else

                                                    <span class="text-muted">
                                                        No Category
                                                    </span>

                                                @endif

                                            </td>


                                            {{-- Price --}}
                                            <td>

                                                <strong>
                                                    ${{ number_format($menuItem->price, 2) }}
                                                </strong>

                                            </td>


                                            {{-- Preparation --}}
                                            <td>

                                                @if($menuItem->preparation_time)

                                                    <span class="text-muted">

                                                        <i class="far fa-clock mr-1"></i>

                                                        {{ $menuItem->preparation_time }} min

                                                    </span>

                                                @else

                                                    <span class="text-muted">
                                                        —
                                                    </span>

                                                @endif

                                            </td>


                                            {{-- Status --}}
                                            <td>

                                                @if($menuItem->is_available)

                                                    <span class="badge badge-success">

                                                        <i class="fas fa-check-circle mr-1"></i>
                                                        Available

                                                    </span>

                                                @else

                                                    <span class="badge badge-danger">

                                                        <i class="fas fa-times-circle mr-1"></i>
                                                        Unavailable

                                                    </span>

                                                @endif

                                            </td>


                                            {{-- Actions --}}
                                            <td class="text-right">

                                                <div class="btn-group">

                                                    {{-- View --}}
                                                    <a href="{{ route(
                            'admin.menu-items.show',
                            $menuItem
                        ) }}" class="btn btn-sm btn-default" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>


                                                    {{-- Edit --}}
                                                    <a href="{{ route(
                            'admin.menu-items.edit',
                            $menuItem
                        ) }}" class="btn btn-sm btn-info" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>


                                                    {{-- Delete --}}
                                                    <form action="{{ route(
                            'admin.menu-items.destroy',
                            $menuItem
                        ) }}" method="POST" class="d-inline" onsubmit="return confirm(
                                                            'Delete this menu item?'
                                                        )">

                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
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

                                                    <i class="fas fa-utensils fa-3x mb-3"></i>

                                                    <h5>
                                                        No menu items found
                                                    </h5>

                                                    <p class="mb-3">
                                                        Add your first dish to the menu.
                                                    </p>

                                                    <a href="{{ route(
                            'admin.menu-items.create'
                        ) }}" class="btn btn-warning">
                                                        <i class="fas fa-plus mr-1"></i>
                                                        Add Menu Item
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
    @if(method_exists($menuItems, 'links'))

        <div class="card-footer">

            {{ $menuItems->links() }}

        </div>

    @endif


</div>

@stop