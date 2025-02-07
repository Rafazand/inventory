@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Category</h1>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
    </div>


    <div id="alert-message" style="display: none;"></div>

    <form id="edit-category-form">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <script>
        const API_BASE_URL_CATEGORIES = 'http://localhost:8000/api/v1/categories';
        const segments = window.location.pathname.split('/');
        const categoryId = segments[segments.length - 2];
        
        function showAlert(message, type = 'success') {
            const alertDiv = document.getElementById('alert-message');
            alertDiv.textContent = message;
            alertDiv.className = `alert alert-${type} fade-in`;
            alertDiv.style.display = 'block';
            
            setTimeout(() => {
                alertDiv.style.display = 'none';
            }, 3000);
        }
        
        async function fetchCategory() {
            try {
                const response = await fetch(`${API_BASE_URL_CATEGORIES}/${categoryId}`);
                if (!response.ok) {
                    throw new Error('Failed to fetch category');
                }
                const data = await response.json();
                return data;
            } catch (error) {
                console.error('Error fetching category:', error);
                showAlert('Failed to fetch category', 'danger');
            }
        }
        
        async function populateForm() {
            const category = await fetchCategory();
            
            if (category) {
                document.getElementById('name').value = category.name;
                document.getElementById('description').value = category.description;
            }
        }

                document.getElementById('edit-category-form').addEventListener('submit', async function (e) {
            e.preventDefault();
            
            const currentCategory = await fetchCategory();
            const newName = document.getElementById('name').value;
            const newDescription = document.getElementById('description').value;
            
            const formData = new FormData();
            formData.append('_method', 'PUT');
            
            if (newName !== currentCategory.name) {
                formData.append('name', newName);
            }
            
            if (newDescription !== currentCategory.description) {
                formData.append('description', newDescription);
            }
            
            try {
                const response = await fetch(`${API_BASE_URL_CATEGORIES}/${categoryId}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-HTTP-Method-Override': 'PUT',
                    },
                });
                
                if (response.ok) {
                    showAlert('Category updated successfully');
                    window.location.href = '/categories';
                } else {
                    const errorData = await response.json();
                    showAlert(errorData.message || 'Failed to update category', 'danger');
                }
            } catch (error) {
                console.error('Error updating category:', error);
                showAlert('Failed to update category', 'danger');
            }
        });
        
        document.addEventListener('DOMContentLoaded', populateForm);

    
    </script>
@endsection