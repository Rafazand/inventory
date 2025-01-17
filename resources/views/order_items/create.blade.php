@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Add Order Item</h1>
        <a href="{{ route('order_items.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <form action="{{ route('order_items.store') }}" method="POST" onsubmit="return confirm('Are you sure you want to submit this form?');">
        @csrf
        <div class="mb-3">
            <label for="order_id" class="form-label">Order</label>
            <select class="form-control" id="order_id" name="order_id" required>
                <option value="">Select Order</option>
                @foreach ($orders as $order)
                    <option value="{{ $order->id }}">Order #{{ $order->id }} ({{ $order->supplier->name }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="product_id" class="form-label">Product</label>
            <select class="form-control" id="product_id" name="product_id" required>
                <option value="">Select Product</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required>
        </div>
        <div class="mb-3">
            <label for="unit_price" class="form-label">Unit Price</label>
            <input type="number" step="0.01" class="form-control" id="unit_price" name="unit_price" required>
        </div>
        <div class="mb-3">
            <label for="total_price" class="form-label">Total Price</label>
            <input type="number" step="0.01" class="form-control" id="total_price" name="total_price" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection