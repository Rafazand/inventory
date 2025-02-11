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
        <tbody id="category-table-body">

        </tbody>
    </table>

    <script>

        // Fetch categories and display them
        fetch('http://localhost:8000/api/v1/categories')
            .then(response => response.json())
            .then(data => {
                const categoryList = document.getElementById('category-list');
                data.forEach(category => {
                    const li = document.createElement('li');
                    li.textContent = `${category.name}: ${category.description}`;
                    categoryList.appendChild(li);
                });
            })
            .catch(error => console.error('Error:', error));


        document.addEventListener('DOMContentLoaded', async function () {
            const categories = await fetchCategories();
            const tableBody = document.getElementById('category-table-body');

            categories.forEach(category => {
                const row = document.createElement('tr');
                row.classList.add('fade-in', 'hover-effect');
                row.innerHTML = `
                    <td>${category.name}</td>
                    <td>${category.description}</td>
                    <td>
                        <a href="/categories/${category.id}/edit" class="btn btn-sm btn-warning btn-pulse">Edit</a>
                        <button onclick="deleteCategory(${category.id})" class="btn btn-sm btn-danger btn-pulse">Delete</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        });

        async function deleteCategory(id) {

            if (confirm('Are you sure you want to delete this category?')) {
        try {
            const response = await fetch(`http://localhost:8000/api/v1/categories/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                }
            });

            if (response.ok) {
                alert('Category deleted successfully');
                window.location.reload(); // Refresh halaman setelah berhasil menghapus
            } else {
                alert('Failed to delete category');
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }
        }
    </script>
@endsection