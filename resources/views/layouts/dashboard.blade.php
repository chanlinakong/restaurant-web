@extends('adminlte::page')

@section('title', 'Bite Restaurant Dashboard')

@section('content_header')
    <h1>@yield('page_title')</h1>
@stop

@section('content')
    @yield('dashboard_content')
@stop