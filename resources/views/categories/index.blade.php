@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 fade-in">
        <h1>Categories</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-primary btn-pulse">Add Category</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success fade-in">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-hover">
        <thead>
            <tr class="fade-in">
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr class="fade-in hover-effect">
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning btn-pulse">Edit</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
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