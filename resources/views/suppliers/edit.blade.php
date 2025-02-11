@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Supplier</h1>
        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div id="alert-container"></div>
    <div id="loading" style="display: none;">Loading...</div>

    <form id="editSupplierForm">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Supplier</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="contact_person" class="form-label">Contact Person</label>
            <input type="text" class="form-control" id="contact_person" name="contact_person"  required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

<script>
    // document.addEventListener('DOMContentLoaded', function () {
    //     const API_BASE_URL = 'http://localhost:8000/api/v1/suppliers'; // Definisikan base URL API
    //     // const supplierId = window.location.pathname.split('/').pop(); // Ambil ID supplier dari URL
    //     const segments = window.location.pathname.split('/');
    //     const supplierId = segments[segments.length - 2]; // Ambil ID di akhir path
    //     const loadingElement = document.getElementById('loading'); // Ambil elemen loading

    //     if (!loadingElement) {
    //         console.error('Elemen loading tidak ditemukan!');
    //         return;
    //     }

    //     // Fungsi untuk mengambil data supplier dari API
    //     async function fetchSupplier() {
    //         try {
    //             loadingElement.style.display = 'block'; // Tampilkan loading

    //             const response = await fetch(`${API_BASE_URL}/${supplierId}`); // Gunakan API_BASE_URL
    //             if (!response.ok) {
    //                 throw new Error('Failed to fetch supplier data');
    //             }
    //             const supplier = await response.json();

    //             console.log('Data dari API:', supplier); // Debug: Lihat data dari API

    //             if (!supplier || Object.keys(supplier).length === 0) {
    //                 throw new Error('Supplier data is empty or not found');
    //             }

    //             populateForm(supplier);
    //         } catch (error) {
    //             console.error('Error:', error);
    //             alert(error.message); // Tampilkan pesan error ke pengguna
    //         } finally {
    //             loadingElement.style.display = 'none'; // Sembunyikan loading
    //         }
    //     }

    //     // Fungsi untuk mengisi form dengan data supplier
    //     function populateForm(supplier) {
    //         const data = supplier.data || supplier; // Handle jika data berada di properti "data"
    //         document.getElementById('name').value = data.name || "";
    //         document.getElementById('contact_person').value = data.contact_person || "";
    //         document.getElementById('email').value = data.email || "";
    //         document.getElementById('phone').value = data.phone || "";
    //         document.getElementById('address').value = data.address || "";
    //     }

    //     // Fungsi untuk mengirim data yang diubah ke API
    //     async function updateSupplier(event) {
    //         event.preventDefault();

    //         const formData = {
    //             name: document.getElementById('name').value,
    //             contact_person: document.getElementById('contact_person').value,
    //             email: document.getElementById('email').value,
    //             phone: document.getElementById('phone').value,
    //             address: document.getElementById('address').value,
    //         };

    //         try {
    //             const response = await fetch(`${API_BASE_URL}/${supplierId}`, { // Gunakan API_BASE_URL
    //                 method: 'POST',
    //                 headers: {
    //                     'X-HTTP-Method-Override': 'PUT',
    //                     'Content-Type': 'application/json',
    //                     // 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    //                 },
    //                 body: JSON.stringify(formData)
    //             });

    //             if (!response.ok) {
    //                 throw new Error('Failed to update supplier');
    //             }

    //             const result = await response.json();
    //             alert('Supplier updated successfully');
    //             window.location.href = "{{ route('suppliers.index') }}";
    //         } catch (error) {
    //             console.error('Error:', error);
    //             alert('Failed to update supplier');
    //         }
    //     }

    //     // Event listener untuk form submission
    //     document.getElementById('editSupplierForm').addEventListener('submit', updateSupplier);

    //     // Ambil data supplier saat halaman dimuat
    //     fetchSupplier();
    // });

    document.addEventListener('DOMContentLoaded', function () {
    const API_BASE_URL = '/api/v1/suppliers';
    const segments = window.location.pathname.split('/');
    const supplierId = segments[segments.length - 2]; 
    const loadingElement = document.getElementById('loading');
    
    if (!loadingElement) {
        console.error('Elemen loading tidak ditemukan!');
        return;
    }

    async function fetchSupplier() {
        try {
            loadingElement.style.display = 'block';
            const response = await fetch(`${API_BASE_URL}/${supplierId}`);
            if (!response.ok) {
                throw new Error('Failed to fetch supplier data');
            }
            const supplier = await response.json();
            populateForm(supplier.data || supplier);
        } catch (error) {
            console.error('Error:', error);
            alert(error.message);
        } finally {
            loadingElement.style.display = 'none';
        }
    }

    function populateForm(data) {
        document.getElementById('name').value = data.name || "";
        document.getElementById('contact_person').value = data.contact_person || "";
        document.getElementById('email').value = data.email || "";
        document.getElementById('phone').value = data.phone || "";
        document.getElementById('address').value = data.address || "";
    }

    async function updateSupplier(event) {
        event.preventDefault();
        
        const formData = {
            name: document.getElementById('name').value,
            contact_person: document.getElementById('contact_person').value,
            email: document.getElementById('email').value,
            phone: document.getElementById('phone').value,
            address: document.getElementById('address').value,
        };

        try {
            const response = await fetch(`${API_BASE_URL}/${supplierId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify(formData)
            });

            if (!response.ok) {
                throw new Error('Failed to update supplier');
            }

            alert('Supplier updated successfully');
            window.location.href = "/suppliers"; 
        } catch (error) {
            console.error('Error:', error);
            alert('Failed to update supplier');
        }
    }

    document.getElementById('editSupplierForm').addEventListener('submit', updateSupplier);
    fetchSupplier();
});

</script>

@endsection
