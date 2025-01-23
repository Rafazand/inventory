{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-center my-5">Inventory Management System</h1>
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
@endsection --}}













@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-center my-5">Inventory Management System</h1>
        </div>
        <div class="row justify-content-center">
            @foreach ($menuItems as $item)
                <div class="col-md-4 mb-4">
                    <div class="card text-center shadow-sm hover-effect">
                        <div class="card-body">
                            <!-- Ikon dengan warna hitam dan hover biru -->
                            <i class="fas {{ $item['icon'] }} fa-3x mb-3 icon-default"></i>
                            <h5 class="card-title">{{ $item['name'] }}</h5>
                            <p class="card-text text-muted">{{ $item['description'] }}</p>
                            <!-- Tombol dengan warna hitam dan hover biru -->
                            <a href="{{ route($item['route']) }}" class="btn btn-dark btn-pulse btn-default">
                                Go to {{ $item['name'] }} <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <style>

        /* Efek hover pada card */
    .hover-effect:hover .icon-default {
        color: #007bff; /* Warna biru saat card dihover */
    }

    .hover-effect:hover .btn-default {
        background-color: #007bff; /* Warna biru saat card dihover */
        border-color: #007bff; /* Warna border biru saat card dihover */
        color: #fff; /* Warna teks putih saat card dihover */
    }

    /* Warna default ikon dan tombol */
    .icon-default {
        color: #585858; /* Warna hitam */
        transition: color 0.3s;
    }

    .btn-default {
        background-color: #585858; /* Warna hitam */
        border: none;
        color: #fff; /* Warna teks putih */
        transition: background-color 0.3s, border-color 0.3s, color 0.3s;
    }

    /* Animasi pulse pada tombol */
    .btn-pulse:hover {
        animation: pulse 1s infinite;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
        100% {
            transform: scale(1);
        }
    }

        .hover-effect {
            transition: transform 0.3s, box-shadow 0.3s;
            border: none;
            border-radius: 10px;
            background-color: var(--card-bg-color);
            color: var(--text-color);
        }

        .hover-effect:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 2rem;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .card-text {
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }

        .btn-pulse {
            transition: transform 0.3s, background-color 0.3s;
        }

        .btn-pulse:hover {
            animation: pulse 1s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        /* Dark Mode Styles */
        :root {
            --card-bg-color: #ffffff;
            --text-color: #333;
        }

        [data-theme="dark"] {
            --card-bg-color: #34495e;
            --text-color: #ffffff;
        }
    </style>
@endsection