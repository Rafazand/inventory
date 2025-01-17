@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Order Items</h1>
        <a href="{{ route('order_items.create') }}" class="btn btn-primary">Add Order Item</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                {{-- <th>ID</th> --}}
                <th>Order ID</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderItems as $orderItem)
                <tr>
                    {{-- <td>{{ $orderItem->id }}</td> --}}
                    <td>{{ $orderItem->order_id }}</td>
                    <td>{{ $orderItem->product->name }}</td>
                    <td>{{ $orderItem->quantity }}</td>
                    <td>Rp{{ number_format($orderItem->unit_price, 2) }}</td>
                    <td>Rp{{ number_format($orderItem->total_price, 2) }}</td>
                    <td>
                        <a href="{{ route('order_items.edit', $orderItem->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('order_items.destroy', $orderItem->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection