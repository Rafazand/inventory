@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Order</h1>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back</a>
    </div>

    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <div id="success-message" class="alert alert-success d-none"></div>
    <div id="error-message" class="alert alert-danger d-none"></div>


    {{-- <form action="{{ route('orders.update', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to submit this form?');">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="supplier_id" class="form-label">Supplier</label>
            <select class="form-control" id="supplier_id" name="supplier_id" required>
                <option value="">Select Supplier</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ $order->supplier_id == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="order_date" class="form-label">Order Date</label>
            <input type="date" class="form-control" id="order_date" name="order_date" value="{{ $order->order_date }}" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Completed" {{ $order->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                <option value="Cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form> --}}

    <form id="edit-order-form">
        <input type="hidden" id="order_id" value="{{ $order->id }}">

        <div class="mb-3">
            <label for="supplier_id" class="form-label">Supplier</label>
            <select class="form-control" id="supplier_id" name="supplier_id" required></select>
        </div>
        <div class="mb-3">
            <label for="order_date" class="form-label">Order Date</label>
            <input type="date" class="form-control" id="order_date" name="order_date" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="Pending">Pending</option>
                <option value="Completed">Completed</option>
                <option value="Cancelled">Cancelled</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <script>
        const API_BASE_URL = "http://localhost:8000/api/v1/orders"; // Endpoint API
        const API_BASE_URL_supplier = 'http://localhost:8000/api/v1/suppliers';
        const orderId = document.getElementById('order_id').value;

        // Ambil data order dan supplier
        async function fetchOrderDetails() {
            try {
                const response = await fetch(`${API_BASE_URL}/${orderId}`);
                const result = await response.json();

                if (result.success) {
                    document.getElementById('supplier_id').innerHTML = ''; // Kosongkan dropdown
                    document.getElementById('order_date').value = result.data.order_date;
                    document.getElementById('status').value = result.data.status;

                    // Ambil data supplier
                    const supplierResponse = await fetch(API_BASE_URL_supplier);
                    const supplierResult = await supplierResponse.json();

                    if (supplierResult.success) {
                        supplierResult.data.forEach(supplier => {
                            const option = document.createElement('option');
                            option.value = supplier.id;
                            option.textContent = supplier.name;
                            if (supplier.id === result.data.supplier_id) {
                                option.selected = true;
                            }
                            document.getElementById('supplier_id').appendChild(option);
                        });
                    }
                } else {
                    document.getElementById('error-message').innerText = 'Failed to load order data.';
                    document.getElementById('error-message').classList.remove('d-none');
                }
            } catch (error) {
                console.error('Error fetching order:', error);
                document.getElementById('error-message').innerText = 'Error fetching order.';
                document.getElementById('error-message').classList.remove('d-none');
            }
        }

        // Update order
        document.getElementById('edit-order-form').addEventListener('submit', async function(event) {
            event.preventDefault(); // Prevent default form submission

            if (!confirm('Are you sure you want to update this order?')) return;

            const formData = {
                supplier_id: document.getElementById('supplier_id').value,
                order_date: document.getElementById('order_date').value,
                status: document.getElementById('status').value
            };

            try {
                const response = await fetch(`${API_BASE_URL}/${orderId}`, {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(formData)
                });

                const result = await response.json();
                if (result.success) {
                    document.getElementById('success-message').innerText = 'Order updated successfully!';
                    document.getElementById('success-message').classList.remove('d-none');
                    window.location.href = '/orders';
                } else {
                    document.getElementById('error-message').innerText = 'Failed to update order.';
                    document.getElementById('error-message').classList.remove('d-none');
                }
            } catch (error) {
                console.error('Error updating order:', error);
                document.getElementById('error-message').innerText = 'Error updating order.';
                document.getElementById('error-message').classList.remove('d-none');
            }
        });

        // Panggil fetchOrderDetails saat halaman dimuat
        document.addEventListener('DOMContentLoaded', fetchOrderDetails);
    </script>
@endsection