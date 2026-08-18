@extends('layouts.admin')

@section('title', 'Orders')

@section('content_header')

    <h1 class="mt-3 mb-1">
        Orders
    </h1>

    <p class="text-muted mb-0">
        Manage and monitor restaurant orders.
    </p>

@stop

@section('content')

<div class="card card-outline card-primary">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h3 class="card-title">
            <i class="fas fa-shopping-cart mr-2"></i>
            Order List
        </h3>

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
                        <th>Customer</th>
                        <th>Table</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Handled By</th>
                        <th width="100">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($orders as $order)

                        <tr>

                            <td>
                                #{{ $order->id }}
                            </td>

                            <td>
                                {{ $order->customer?->name ?? 'Guest' }}
                            </td>

                            <td>
                                {{ $order->table_number ?? 'Takeaway' }}
                            </td>

                            <td>
                                ${{ number_format($order->total_amount, 2) }}
                            </td>

                            <td>

                                @php
                                    $status = $order->status->value;

                                    $statusClass = match($status) {
                                        'pending' => 'badge-warning',
                                        'confirmed' => 'badge-info',
                                        'completed' => 'badge-success',
                                        'cancelled' => 'badge-danger',
                                        default => 'badge-secondary',
                                    };
                                @endphp

                                <span class="badge {{ $statusClass }}">
                                    {{ ucfirst($status) }}
                                </span>

                            </td>

                            <td>
                                {{ $order->handledBy?->name ?? '-' }}
                            </td>

                            <td>

                                <a
                                    href="{{ route('admin.orders.show', $order) }}"
                                    class="btn btn-primary btn-sm"
                                    title="View Order"
                                >
                                    <i class="fas fa-eye"></i>
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="text-center text-muted py-4"
                            >

                                <i class="fas fa-shopping-cart fa-2x mb-2"></i>

                                <div>
                                    No orders found.
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