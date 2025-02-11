@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 fade-in">
        <h1>Order Items</h1>
        <a href="{{ route('order_items.create') }}" class="btn btn-primary btn-pulse">Add Order Item</a>
    </div>

    {{-- @if (session('success'))
        <div class="alert alert-success fade-in">
            {{ session('success') }}
        </div>
    @endif --}}

    <div id="successMessage" class="alert alert-success fade-in d-none"></div>

    <table class="table table-bordered table-hover">
        <thead>
            <tr class="fade-in">
                <th>Supplier</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total Price</th>
                <th>Payment Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="orderItemsTable">
            <tr>
                <td colspan="7" class="text-center">Loading data...</td>
            </tr>
            
        </tbody>
    </table>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const apiUrl = "http://localhost:8000/api/v1/order_items"; // Pastikan URL API sesuai

            function fetchOrderItems() {
                fetch(apiUrl)
                    .then(response => response.json())
                    .then(responseData => {
                        if (responseData.status === "success") {
                            renderTable(responseData.data);
                        } else {
                            console.error("Error fetching order items:", responseData.message);
                        }
                    })
                    .catch(error => console.error("Fetch error:", error));
            }

            function renderTable(orderItems) {
                const tableBody = document.getElementById("orderItemsTable");
                tableBody.innerHTML = ""; // Bersihkan isi tabel sebelum memasukkan data baru

                if (orderItems.length === 0) {
                    tableBody.innerHTML = `<tr><td colspan="7" class="text-center">No data available</td></tr>`;
                    return;
                }

                orderItems.forEach(orderItem => {
                    const row = document.createElement("tr");
                    row.classList.add("fade-in", "hover-effect");

                    row.innerHTML = `
                        <td>${orderItem.order?.supplier?.name || "N/A"}</td>
                        <td>${orderItem.product?.name || "N/A"}</td>
                        <td>${orderItem.quantity}</td>
                        <td>Rp${parseFloat(orderItem.unit_price).toLocaleString("id-ID", { minimumFractionDigits: 2 })}</td>
                        <td>Rp${parseFloat(orderItem.total_price).toLocaleString("id-ID", { minimumFractionDigits: 2 })}</td>
                        <td>
                            <span class="badge ${orderItem.payment_status === 'Paid' ? 'bg-success' : 'bg-warning'}">
                                ${orderItem.payment_status}
                            </span>
                        </td>
                        <td>
                            ${orderItem.payment_status !== 'Paid' ? 
                                `<a href="/order_items/${orderItem.id}/edit" class="btn btn-sm btn-warning btn-pulse">Edit</a>` 
                                : ""}
                            <button onclick="deleteOrderItem(${orderItem.id})" class="btn btn-sm btn-danger btn-pulse">Delete</button>
                        </td>
                    `;

                    tableBody.appendChild(row);
                });
            }

            function deleteOrderItem(id) {
                if (!confirm("Are you sure?")) return;

                fetch(`http://localhost:8000/api/v1/order_items/${id}`, {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    }
                })
                .then(response => response.json())
                .then(responseData => {
                    if (responseData.status === "success") {
                        document.getElementById("successMessage").textContent = responseData.message;
                        document.getElementById("successMessage").classList.remove("d-none");
                        fetchOrderItems(); // Refresh tabel setelah delete
                    } else {
                        console.error("Error deleting order item:", responseData.message);
                    }
                })
                .catch(error => console.error("Fetch error:", error));
            }

            fetchOrderItems();
        });
    </script>
@endsection