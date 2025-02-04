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
        <tbody id="product-table-body">
        </tbody>
    </table>

    <script>
        const API_BASE_URL = 'http://localhost:8000/api/v2/products'; // Ganti dengan URL API Anda


        // Fungsi untuk menampilkan data produk di tabel
        async function renderProducts() {
            const products = await fetchProducts();
            const tableBody = document.getElementById('product-table-body');
            // tableBody.innerHTML = ''; // Kosongkan tabel sebelum mengisi data baru

            products.forEach(product => {
                const row = document.createElement('tr');
                row.classList.add('fade-in', 'hover-effect');
                row.innerHTML = `
                    <td>
                        ${product.image ? `<img src="http://localhost:8000/storage/${product.image}" alt="${product.name}" width="50" class="img-thumbnail">` : '<span class="text-muted">No Image</span>'}
                    </td>
                    <td>${product.name}</td>
                    <td>${product.description}</td>
                    <td>Rp.${product.price.toLocaleString('id-ID', { minimumFractionDigits: 2 })}</td>
                    <td>
                        ${product.quantity === 0 ? '<span class="text-danger">Out of Stock</span>' : product.quantity}
                    </td>
                    <td>${product.category ? product.category.name : 'N/A'}</td>
                    <td>
                        <a href="/products/${product.id}/edit" class="btn btn-sm btn-warning btn-pulse">Edit</a>
                        <button onclick="deleteProduct(${product.id})" class="btn btn-sm btn-danger btn-pulse">Delete</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

        // Fungsi untuk menghapus produk
        async function deleteProduct(id) {
            if (confirm('Are you sure you want to delete this product?')) {
                try {
                    const response = await fetch(`${API_BASE_URL}/${id}`, {
                        method: 'DELETE',
                    });

                    if (response.status === 204) {
                        showAlert('Product deleted successfully');
                        renderProducts(); // Refresh tabel setelah menghapus
                    } else {
                        showAlert('Failed to delete product', 'danger');
                    }
                } catch (error) {
                    console.error('Error deleting product:', error);
                    showAlert('Failed to delete product', 'danger');
                }
            }
        }

        // Jalankan fungsi renderProducts saat halaman dimuat
        document.addEventListener('DOMContentLoaded', renderProducts);
    </script>
@endsection