@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 fade-in">
        <h1>Orders</h1>
        <a href="{{ route('orders.create') }}" class="btn btn-primary btn-pulse">Add Order</a>
    </div>

    {{-- @if (session('success'))
        <div class="alert alert-success fade-in">
            {{ session('success') }}
        </div>
    @endif --}}
    <div id="success-message" class="alert alert-success fade-in d-none"></div>

    <table class="table table-bordered table-hover">
        <thead>
            <tr class="fade-in">
                <th>Supplier</th>
                <th>Order Date</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="order-table-body">
            <tr>
                <td colspan="7" class="text-center">Loading data...</td>
            </tr>
        </tbody>
    </table>

    <script>
        const API_BASE_URL_order = 'http://localhost:8000/api/v1/orders'; // Ambil URL API dari Laravel
        const tableBody = document.getElementById('order-table-body');

        // Fungsi untuk mengambil data order dari API
        async function fetchOrders() {
            try {
                const response = await fetch(API_BASE_URL_order);
                const result = await response.json();

                if (result.success) {
                    tableBody.innerHTML = ''; // Kosongkan tabel sebelum mengisi ulang
                    result.data.forEach(order => {
                        const row = document.createElement('tr');
                        row.innerHTML += `
                            <td>${order.supplier.name}</td>
                            <td>${order.order_date}</td>
                            <td>Rp.${parseFloat(order.total_amount).toLocaleString('id-ID', { minimumFractionDigits: 2 })}</td>
                            <td>
                                <span class="badge ${getStatusBadge(order.status)}">
                                    ${order.status}
                                </span>
                            </td>
                            <td>
                                <a href="/orders/${order.id}/edit" class="btn btn-sm btn-warning btn-pulse">Edit</a>
                                <button class="btn btn-sm btn-danger btn-pulse" onclick="deleteOrder(${order.id})">Delete</button>
                            </td>
                        `;
                        tableBody.appendChild(row);
                    });
                } else {
                    tableBody.innerHTML = '<tr><td colspan="5" class="text-center">No orders found.</td></tr>';
                }
            } catch (error) {
                console.error('Error fetching orders:', error);
                tableBody.innerHTML = '<tr><td colspan="5" class="text-center text-danger">Failed to load orders.</td></tr>';
            }
        }

        // Fungsi untuk mendapatkan warna badge status
        function getStatusBadge(status) {
            switch (status) {
                case 'Pending': return 'bg-warning';
                case 'Completed': return 'bg-success';
                case 'Cancelled': return 'bg-danger';
                default: return 'bg-secondary';
            }
        }

        // Fungsi untuk menghapus order
        async function deleteOrder(orderId) {
            if (!confirm('Are you sure you want to delete this order?')) return;

            try {
                const response = await fetch(`${API_BASE_URL_order}/${orderId}`, {
                    method: 'DELETE',
                    headers: { 'Content-Type': 'application/json' }
                });

                const result = await response.json();
                if (result.success) {
                    document.getElementById('success-message').innerText = 'Order deleted successfully!';
                    document.getElementById('success-message').classList.remove('d-none');
                    fetchOrders(); // Refresh tabel
                } else {
                    alert('Failed to delete order.');
                }
            } catch (error) {
                console.error('Error deleting order:', error);
                alert('Error deleting order.');
            }
        }

        // Panggil fetchOrders saat halaman dimuat
        document.addEventListener('DOMContentLoaded', fetchOrders);
    </script>
@endsection