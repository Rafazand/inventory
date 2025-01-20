{{-- @extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Create Order</h1>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="supplier_id">Supplier</label>
            <select name="supplier_id" id="supplier_id" class="form-control" required>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="order_date">Order Date</label>
            <input type="date" name="order_date" id="order_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="Pending">Pending</option>
                <option value="Completed">Completed</option>
                <option value="Cancelled">Cancelled</option>
            </select>
        </div>

        <h3>Order Items</h3>
        <div id="order-items">
            <div class="order-item">
                <div class="form-group">
                    <label for="items[0][product_id]">Product</label>
                    <select name="items[0][product_id]" class="form-control" required>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="items[0][quantity]">Quantity</label>
                    <input type="number" name="items[0][quantity]" class="form-control" required min="1">
                </div>

                <div class="form-group">
                    <label for="items[0][unit_price]">Unit Price</label>
                    <input type="number" name="items[0][unit_price]" class="form-control" step="0.01" min="0">
                </div>
            </div>
        </div>

        <button type="button" id="add-item" class="btn btn-secondary">Add Item</button>
        <button type="submit" class="btn btn-primary">Create Order</button>
    </form>

    <script>
        Add more order item fields dynamically
        document.getElementById('add-item').addEventListener('click', function () {
            const orderItems = document.getElementById('order-items');
            const itemCount = orderItems.children.length;

            const newItem = document.createElement('div');
            newItem.classList.add('order-item');
            newItem.innerHTML = `
                <div class="form-group">
                    <label for="items[${itemCount}][product_id]">Product</label>
                    <select name="items[${itemCount}][product_id]" class="form-control" required>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="items[${itemCount}][quantity]">Quantity</label>
                    <input type="number" name="items[${itemCount}][quantity]" class="form-control" required min="1">
                </div>

                <div class="form-group">
                    <label for="items[${itemCount}][unit_price]">Unit Price</label>
                    <input type="number" name="items[${itemCount}][unit_price]" class="form-control" step="0.01" min="0">
                </div>
            `;

            orderItems.appendChild(newItem);
        });
    </script>
@endsection --}}



@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Add Order</h1>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('orders.store') }}" method="POST" onsubmit="return confirm('Are you sure you want to submit this form?');">
        @csrf
        <div class="mb-3">
            <label for="supplier_id" class="form-label">Supplier</label>
            <select class="form-control" id="supplier_id" name="supplier_id" required>
                <option value="">Select Supplier</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="order_date" class="form-label">Order Date</label>
            <input type="date" class="form-control" id="order_date" name="order_date" required>
        </div>
        {{-- <div class="mb-3">
            <label for="total_amount" class="form-label">Total Amount</label>
            <input type="number" step="0.01" class="form-control" id="total_amount" name="total_amount" required>
        </div> --}}
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="Pending">Pending</option>
                <option value="Completed">Completed</option>
                <option value="Cancelled">Cancelled</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection