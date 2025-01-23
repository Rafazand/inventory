@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 fade-in">
        <h1>Suppliers</h1>
        <a href="{{ route('suppliers.create') }}" class="btn btn-primary btn-pulse">Add Supplier</a>
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
                <th>Contact Person</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suppliers as $supplier)
                <tr class="fade-in hover-effect">
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->contact_person }}</td>
                    <td>{{ $supplier->email }}</td>
                    <td>(08) {{ substr($supplier->phone, 1) }}</td>
                    <td>{{ $supplier->address }}</td>
                    <td>
                        <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-sm btn-warning btn-pulse">Edit</a>
                        <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" class="d-inline">
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