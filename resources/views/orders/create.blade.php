@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Add Order</h1>
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

    <div id="alert-container"></div>

    <form id="order-form" onsubmit="return submitOrder(event);">
        @csrf
        <div class="mb-3">
            <label for="supplier_id" class="form-label">Supplier</label>
            <select class="form-control" id="supplier_id" name="supplier_id" required>
                <option value="">Select Supplier</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="order_date" class="form-label">Order Date</label>
            <input type="date" class="form-control" id="order_date" name="order_date" required>
        </div>
        {{-- <div class="mb-3">
            <label for="total_amount" class="form-label">Total Amount</label>
            <input type="number" step="0.01" class="form-control" id="total_amount" name="total_amount" required>
        </div> --}}
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="Pending">Pending</option>
                <option value="Completed">Completed</option>
                <option value="Cancelled">Cancelled</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script>
        const API_BASE_URL = 'http://localhost:8000/api/v1/orders'; // Sesuaikan dengan URL API backend Anda

        async function submitOrder(event) {
            event.preventDefault(); // Mencegah reload halaman

            const supplier_id = document.getElementById('supplier_id').value;
            const order_date = document.getElementById('order_date').value;
            const status = document.getElementById('status').value;

            const formData = {
                supplier_id: supplier_id,
                order_date: order_date,
                status: status
            };

            try {
                const response = await fetch(API_BASE_URL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${localStorage.getItem('token')}` // Jika API menggunakan autentikasi
                    },
                    body: JSON.stringify(formData)
                });

                const result = await response.json();
                
                if (response.ok) {
                    showAlert('Order created successfully!', 'success');
                    document.getElementById('order-form').reset();
                    window.location.href = '/orders';
                } else {
                    showAlert(result.message || 'Failed to create order.', 'danger');
                }
            } catch (error) {
                console.error('Error:', error);
                showAlert('Something went wrong. Please try again later.', 'danger');
            }
        }

        function showAlert(message, type) {
            const alertContainer = document.getElementById('alert-container');
            alertContainer.innerHTML = `
                <div class="alert alert-${type} fade show" role="alert">
                    ${message}
                </div>
            `;
            setTimeout(() => {
                alertContainer.innerHTML = '';
            }, 3000);
        }
    </script>
@endsection