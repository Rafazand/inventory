@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Add Category</h1>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <form id="create-category-form">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script>
        document.getElementById('create-category-form').addEventListener('submit', async function (e) {
            e.preventDefault();

            const category = {
                name: document.getElementById('name').value,
                description: document.getElementById('description').value,
            };

            const newCategory = await addCategory(category);
            if (newCategory) {
                window.location.href = '/categories';
            }
        });

        // Fungsi untuk menambahkan kategori
        async function addCategory(category) {
            try {
                const response = await fetch(API_BASE_URL_categories, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(category),
                });
                const data = await response.json();
                return data;
            } catch (error) {
                console.error('Error adding category:', error);
            }
        }
    </script>
@endsection