<!-- resources/views/auth/register.blade.php -->
@extends('Auth.Lapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header btn-primary text-white text-center">
                    <h4><i class="fas fa-user-plus me-2"></i>Register</h4>
                </div>
                <div class="card-body">

                    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

                    <div id="error-messages" class="alert alert-danger d-none"></div>
                    <form id="register-form">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label"><i class="fas fa-user me-1"></i>Name</label>
                            <input id="name" type="text" class="form-control" name="name" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label"><i class="fas fa-envelope me-1"></i>Email</label>
                            <input id="email" type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label"><i class="fas fa-lock me-1"></i>Password</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password-confirm" class="form-label"><i class="fas fa-lock me-1"></i>Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        <div class="d-grid">
                            
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-sign-in-alt me-1"></i>Register
                                </button>
                        
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <p class="mb-0">Already have an account? <a href="{{ route('login') }}">Login here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('register-form').addEventListener('submit', async function(event) {
        event.preventDefault(); // Mencegah form reload halaman
        
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const password_confirmation = document.getElementById('password-confirm').value;
        
        const response = await fetch('http://localhost:8000/api/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                name: name,
                email: email,
                password: password,
                password_confirmation: password_confirmation
            })
        });
    
        const data = await response.json();
    
        if (response.ok) {
            // Simpan token di localStorage
            localStorage.setItem('auth_token', data.token);
            alert('Registration successful! Redirecting to dashboard...');
            window.location.href = '/dashboard'; // Ganti dengan halaman setelah login
        } else {
            let errorMessages = '<ul>';
            if (data.errors) {
                Object.values(data.errors).forEach(errorArray => {
                    errorArray.forEach(errorMessage => {
                        errorMessages += `<li>${errorMessage}</li>`;
                    });
                });
            } else {
                errorMessages += `<li>${data.message}</li>`;
            }
            errorMessages += '</ul>';
            
            const errorDiv = document.getElementById('error-messages');
            errorDiv.innerHTML = errorMessages;
            errorDiv.classList.remove('d-none');
        }
    });
    </script>
@endsection