@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 fade-in">
        <h1>Products</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary btn-pulse">Add Product</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success fade-in">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-hover">
        <thead>
            <tr class="fade-in">
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr class="fade-in hover-effect">
                    <td>
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="50" class="img-thumbnail">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>Rp.{{ number_format($product->price, 2) }}</td>
                    <td>
                        @if ($product->quantity == 0)
                            <span class="text-danger">Out of Stock</span>
                        @else
                            {{ $product->quantity }}
                        @endif
                    </td>
                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning btn-pulse">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
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