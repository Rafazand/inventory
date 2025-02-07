@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Product</h1>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div id="alert-message" class="alert" style="display: none;"></div>

    <form id="edit-product-form" enctype="multipart/form-data">
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
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <option value="">Select Category</option>
            </select>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    

    <script>
        const API_BASE_URL_products = 'http://localhost:8000/api/v1/products'; // Ganti dengan URL API Anda
        // const productId = window.location.pathname.split('/').pop(); // Ambil ID produk dari URL
        const segments = window.location.pathname.split('/');
        const productId = segments[segments.length - 2]; // Ambil ID di akhir path


        // Fungsi untuk menampilkan pesan alert
        function showAlert(message, type = 'success') {
            const alertDiv = document.getElementById('alert-message');
            alertDiv.textContent = message;
            alertDiv.className = `alert alert-${type} fade-in`;
            alertDiv.style.display = 'block';

            setTimeout(() => {
                alertDiv.style.display = 'none';
            }, 3000);
        }

        // Fungsi untuk mengambil data produk dari API
        async function fetchProducts() {
            try {
                const response = await fetch(`${API_BASE_URL_products}/${productId}`);
                if (!response.ok) {
                    throw new Error('Failed to fetch product');
                    // console.error('Failed to fetch product');
                    // return { error: 'Failed to fetch product' }; // Default error response
                }
                const data = await response.json();
                return data;
            } catch (error) {
                console.error('Error fetching product:', error);
                showAlert('Failed to fetch product', 'danger');
            }
        }

        // Fungsi untuk mengambil data kategori dari API
        async function fetchCategories() {
            try {
                const response = await fetch('http://localhost:8000/api/v1/categories');
                if (!response.ok) {
                    throw new Error('Failed to fetch categories');
                }
                const data = await response.json();
                return data;
            } catch (error) {
                console.error('Error fetching categories:', error);
            }
        }

        // Fungsi untuk mengisi form dengan data produk
        async function populateForm() {
            const product = await fetchProducts();
            const categories = await fetchCategories();

            if (product) {
                document.getElementById('name').value = product.name;
                document.getElementById('description').value = product.description;
                document.getElementById('price').value = product.price;
                document.getElementById('quantity').value = product.quantity;

                const categorySelect = document.getElementById('category_id');
                categorySelect.innerHTML = '<option value="">Select Category</option>';

                categories.forEach(category => {
                    const option = document.createElement('option');
                    option.value = category.id;
                    option.textContent = category.name;
                    option.selected = category.id === product.category_id;
                    categorySelect.appendChild(option);
                });
            }
        }

        // Fungsi untuk mengupdate produk
        document.getElementById('edit-product-form').addEventListener('submit', async function (e) {
            e.preventDefault();

            const formData = new FormData();
            formData.append('_method', 'PUT'); // Laravel akan menganggap ini sebagai PUT request
            formData.append('name', document.getElementById('name').value);
            formData.append('description', document.getElementById('description').value);
            formData.append('price', document.getElementById('price').value);
             formData.append('quantity', document.getElementById('quantity').value);
            formData.append('category_id', document.getElementById('category_id').value);
            if (document.getElementById('image').files[0]) {
                formData.append('image', document.getElementById('image').files[0]);
            }

            try {
                const response = await fetch(`${API_BASE_URL_products}/${productId}`, {
                    method: 'POST', // Gunakan POST untuk FormData dengan _method=PUT
                    body: formData,
                    headers: {
                        'X-HTTP-Method-Override': 'PUT', // Override method untuk Laravel
                    },
                    // headers: {
                    //     'Accept': 'application/json',
                    //     'X-Requested-With': 'XMLHttpRequest',
                    // },
                });

                if (response.ok) {
                    showAlert('Product updated successfully');
                    window.location.href = '/products';
                } else {
                    showAlert('Failed to update product', 'danger');
                }
            } catch (error) {
                console.error('Error updating product:', error);
                showAlert('Failed to update product', 'danger');
            }
        });

        // Jalankan fungsi populateForm saat halaman dimuat
        document.addEventListener('DOMContentLoaded', populateForm);
    </script>
@endsection