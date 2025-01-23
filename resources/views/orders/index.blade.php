@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 fade-in">
        <h1>Orders</h1>
        <a href="{{ route('orders.create') }}" class="btn btn-primary btn-pulse">Add Order</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success fade-in">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-hover">
        <thead>
            <tr class="fade-in">
                <th>Supplier</th>
                <th>Order Date</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr class="fade-in hover-effect">
                    <td>{{ $order->supplier->name }}</td>
                    <td>{{ $order->order_date }}</td>
                    <td>Rp.{{ number_format($order->total_amount, 2) }}</td>
                    <td>
                        <span class="badge 
                            @if($order->status === 'Pending') bg-warning
                            @elseif($order->status === 'Completed') bg-success
                            @elseif($order->status === 'Cancelled') bg-danger
                            @endif">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-warning btn-pulse">Edit</a>
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger btn-pulse" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection