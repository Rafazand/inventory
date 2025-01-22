@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Products</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
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
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                {{-- <th>Status</th> --}}
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    {{-- <td>{{ $product->id }}</td> --}}
                    <td>
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="50">
                        @else
                            No Image
                        @endif
                    </td>

                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>Rp.{{ number_format($product->price, 2) }}</td>
                    <td>
                        @if ($product->quantity == 0)
                            Out of Stock
                        @else
                            {{ $product->quantity }}
                        @endif
                    </td>{{-- <td>{{ $product->quantity }}</td> --}}
                    {{-- <td>{{ $product->status }}</td> --}}
                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
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