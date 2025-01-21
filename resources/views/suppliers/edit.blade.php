@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Supplier</h1>
        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Back</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to submit this form?');">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Supplier</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $supplier->name }}" required>
        </div>
        <div class="mb-3">
            <label for="contact_person" class="form-label">Contact Person</label>
            <input type="text" class="form-control" id="contact_person" name="contact_person" value="{{ $supplier->contact_person }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $supplier->email }}" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $supplier->phone }}" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" id="address" name="address" rows="3" required>{{ $supplier->address }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <script>
        document.getElementById('phone').addEventListener('input', function (e) {
            this.value = this.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
        });
    </script>
@endsection
