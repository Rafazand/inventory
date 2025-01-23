@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 fade-in">
        <h1>Order Items</h1>
        <a href="{{ route('order_items.create') }}" class="btn btn-primary btn-pulse">Add Order Item</a>
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
                <th>Product</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total Price</th>
                <th>Payment Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderItems as $orderItem)
                <tr class="fade-in hover-effect">
                    <td>{{ $orderItem->order->supplier->name }}</td>
                    <td>{{ $orderItem->product->name }}</td>
                    <td>{{ $orderItem->quantity }}</td>
                    <td>Rp{{ number_format($orderItem->unit_price, 2) }}</td>
                    <td>Rp{{ number_format($orderItem->total_price, 2) }}</td>
                    <td>
                        <span class="badge 
                            @if($orderItem->payment_status === 'Paid') bg-success
                            @else bg-warning
                            @endif">
                            {{ $orderItem->payment_status }}
                        </span>
                    </td>
                    <td>
                        @if ($orderItem->payment_status !== 'Paid')
                            <a href="{{ route('order_items.edit', $orderItem->id) }}" class="btn btn-sm btn-warning btn-pulse">Edit</a>
                        @endif
                        <form action="{{ route('order_items.destroy', $orderItem->id) }}" method="POST" class="d-inline">
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