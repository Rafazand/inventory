@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 fade-in">
        <h1>Suppliers</h1>
        <a href="{{ route('suppliers.create') }}" class="btn btn-primary btn-pulse">Add Supplier</a>
    </div>

    {{-- @if (session('success'))
        <div class="alert alert-success fade-in">
            {{ session('success') }}
        </div>
    @endif --}}

    <div id="alert-container"></div>

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
        <tbody id="suppliers-table-body">

        </tbody>
    </table>

    <script>
        const API_BASE_URL = 'http://localhost:8000/api/v1/suppliers';
        // const phone = supplier.phone ? `(08) ${String(supplier.phone).substring(1)}` : 'No Phone';
    
        async function fetchSuppliers() {
            try {
                const response = await fetch(API_BASE_URL);
                const data = await response.json();
                console.log("Fetched Data:", data);
                return data.data;
            } catch (error) {
                console.error('Error fetching suppliers:', error);
                return [];
            }
        }

    
        async function renderSuppliers() {
            const suppliers = await fetchSuppliers();
            const tableBody = document.getElementById('suppliers-table-body');
            tableBody.innerHTML = '';
    
            suppliers.forEach(supplier => {
                const row = document.createElement('tr');
                row.classList.add('fade-in', 'hover-effect');
                row.innerHTML = `
                    <td>${supplier.name}</td>
                    <td>${supplier.contact_person}</td>
                    <td>${supplier.email}</td>
                    <td>(08) ${supplier.phone}</td>
                    <td>${supplier.address}</td>
                    <td>
                        <a href="/suppliers/${supplier.id}/edit" class="btn btn-sm btn-warning btn-pulse">Edit</a>
                        <button onclick="deleteSupplier(${supplier.id})" class="btn btn-sm btn-danger btn-pulse">Delete</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }
    
        async function deleteSupplier(id) {
            if (confirm('Are you sure you want to delete this supplier?')) {
                try {
                    const response = await fetch(`${API_BASE_URL}/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                        }
                    });
    
                    if (response.ok) { 
                        alert('Supplier deleted successfully');
                        renderSuppliers();
                    } else {
                        alert('Failed to delete supplier');
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            }
        }
    
        document.addEventListener('DOMContentLoaded', renderSuppliers);
    </script>
@endsection