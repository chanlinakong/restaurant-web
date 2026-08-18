@extends('layouts.admin')

@section('title', 'Restaurant Dashboard')

@section('page_header')

    <div>
        <h1 class="text-2xl font-bold text-gray-900">
            Restaurant Dashboard
        </h1>

        <p class="text-sm text-gray-500">
            Welcome to Bites Restaurant Administration.
        </p>
    </div>

@stop


@section('admin_content')

    <div class="space-y-6">

        {{-- Your dashboard cards here --}}

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

            <h2 class="text-xl font-semibold text-gray-900">
                Welcome to Bites Restaurant
            </h2>

            <p class="mt-2 text-gray-500">
                Manage your restaurant orders, menu items,
                categories and users.
            </p>

        </div>

    </div>

@stop