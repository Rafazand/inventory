@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Create Order Item</h1>
        <a href="{{ route('order_items.index') }}" class="btn btn-secondary">Back</a>
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

    <form action="{{ route('order_items.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="order_id">Order</label>
            <select name="order_id" id="order_id" class="form-control" required>
                @foreach ($orders as $order)
                    <option value="{{ $order->id }}">{{ $order->id }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="product_id">Product</label>
            <select name="product_id" id="product_id" class="form-control" required>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                        {{ $product->name }} (Rp{{ number_format($product->price, 2) }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" required min="1">
        </div>

        <div class="form-group">
            <label for="unit_price">Unit Price</label>
            <input type="number" name="unit_price" id="unit_price" class="form-control" step="0.01" min="0">
            <small class="text-muted">Leave blank to use the product's default price.</small>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>

    <script>
        // Automatically fill the unit_price field with the selected product's price
        document.getElementById('product_id').addEventListener('change', function () {
    const selectedProduct = this.options[this.selectedIndex];
    const productPrice = selectedProduct.getAttribute('data-price');
    console.log('Selected product price:', productPrice); // Debugging
    document.getElementById('unit_price').value = productPrice;
});
    </script>
@endsection