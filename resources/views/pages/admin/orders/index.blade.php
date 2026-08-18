@extends('layouts.dashboard')

@section('page_title', 'Order Management')

@section('dashboard_content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Restaurant Orders</h3>
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Table</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Handled By</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->customer->name }}</td>
                    <td>{{ $order->table_number ?? 'Takeaway' }}</td>
                    <td>$ {{ number_format($order->total_amount, 2) }}</td>
                    <td>
                        <span class="badge bg-warning">
                            {{ ucfirst($order->status->value) }}
                        </span>
                    </td>
                    <td>{{ $order->handledBy?->name ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order) }}"
                           class="btn btn-sm btn-primary">
                           View
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection