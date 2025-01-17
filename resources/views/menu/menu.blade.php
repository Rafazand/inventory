@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-center my-5">Inventory Management System</h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-sign-out-alt me-1"></i>Logout
                </button>
            </form>
        </div>
        <div class="row justify-content-center">
            @foreach ($menuItems as $item)
                <div class="col-md-4 mb-4">
                    <div class="card text-center shadow-sm hover-effect">
                        <div class="card-body">
                            <i class="fas {{ $item['icon'] }} fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title">{{ $item['name'] }}</h5>
                            <p class="card-text">{{ $item['description'] }}</p>
                            <a href="{{ route($item['route']) }}" class="btn btn-primary">
                                Go to {{ $item['name'] }} <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <style>
        .hover-effect {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .hover-effect:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
@endsection