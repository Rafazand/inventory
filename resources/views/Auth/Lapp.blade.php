{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .navbar {
            background-color: #007bff;
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: #fff !important;
        }
        .navbar-brand:hover, .navbar-nav .nav-link:hover {
            color: #f8f9fa !important;
        }
        .footer {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            margin-top: auto;
        }
        .hover-effect {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .hover-effect:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand"> 
                
                <i class="fas fa-boxes"></i> Inventory System
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow-1">
        <div class="container">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} Inventory Management System. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS and Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html> --}}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: var(--background-color);
            color: var(--text-color);
            transition: background-color 0.5s, color 0.5s;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background-color: var(--navbar-bg) !important;
            transition: background-color 0.5s;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: var(--text-color) !important;
        }

        .navbar-nav .nav-link {
            color: var(--text-color) !important;
            font-weight: 500;
            margin: 0 0.5rem;
            transition: color 0.3s, transform 0.3s;
        }

        .nav-linkblack{
            color: var(--text-color) !important;
            font-weight: 500;
            margin: 0 0.5rem;
            transition: color 0.3s, transform 0.3s;
        }

        .navbar-nav .nav-link:hover {
            color: var(--primary-color) !important;
            transform: translateY(-2px);
        }

        .footer {
            background-color: var(--footer-bg) !important;
            color: var(--text-color);
            text-align: center;
            padding: 1rem 0;
            margin-top: auto;
            transition: background-color 0.5s;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            transition: background-color 0.3s, transform 0.3s;
        }


        .btn-danger {
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
        }

        .btn-pulse:hover {
            animation: pulse 1s infinite;
        }

        .fade-in {
            animation: fadeIn 1s ease-out;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        /* .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        } */

        /* Animasi untuk navbar brand */
        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        .navbar-brand:hover {
            animation: bounce 0.5s;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
        /* EFFFFB */ 
        /* 0056b3 */
        /* Dark Mode Styles */
        /* #333 */
        :root {
            --background-color: #ffffff;
            --text-color: #333;
            --navbar-bg: #ffffff;
            --footer-bg: #EFFFFB;
            --primary-color: #06D001;
            --primary-hover-color: #0056b3;
        }

        [data-theme="dark"] {
            --background-color: #2c3e50;
            --text-color: #ffffff;
            --navbar-bg: #34495e;
            --footer-bg: #34495e;
            --primary-color: #3498db;
            --primary-hover-color: #2980b9;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand ">
                <i class="fas fa-boxes"></i> Inventory System
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow-1 fade-in">
        <div class="container my-5">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} Inventory Management System. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS and Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const themeToggle = document.getElementById('theme-toggle');
            const currentTheme = localStorage.getItem('theme') || 'light';

            // Set tema awal
            document.documentElement.setAttribute('data-theme', currentTheme);
            updateThemeIcon(currentTheme);

            // Toggle tema saat tombol diklik
            themeToggle.addEventListener('click', function () {
                const newTheme = document.documentElement.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
                document.documentElement.setAttribute('data-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                updateThemeIcon(newTheme);
            });

            // Fungsi untuk mengupdate ikon tema
            function updateThemeIcon(theme) {
                const icon = theme === 'dark' ? 'fa-sun' : 'fa-moon';
                themeToggle.innerHTML = `<i class="fas ${icon}"></i>`;
            }
        });
    </script>
</body>
</html>