<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Awesome App</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    {{-- Header --}}
    <header class="bg-blue-500 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-2xl font-bold">
                Inventory System
            </div>
            <nav>
                <a href="#" class="mx-2 hover:text-gray-200">Home</a>
                <a href="#" class="mx-2 hover:text-gray-200">Features</a>
                <a href="#" class="mx-2 hover:text-gray-200">Testimonials</a>
                <a href="#" class="mx-2 hover:text-gray-200">Contact</a>
            </nav>
        </div>
    </header>

    {{-- Hero Section --}}
    <section class="bg-gray-100 py-20">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-bold mb-4">Welcome to My Inventory System App</h1>
            <p class="text-gray-700 mb-8">Managing Your Inventory To make Things Easier</p>
            <a href="#" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600">Get Started</a>
        </div>
    </section>

    {{-- Features Section --}}
    <section class="py-20">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-8">Features</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-4">Feature One</h3>
                    <p class="text-gray-700">bisa di pencet</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-4">Feature Two</h3>
                    <p class="text-gray-700">bisa di klik</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-4">Feature Three</h3>
                    <p class="text-gray-700">bisa bikin pusing</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimonials Section --}}
    <section class="py-20">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-8">What Our Users Say</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <p class="text-gray-700 mb-4">"This app changed my life!"</p>
                    <p class="text-gray-900 font-bold">Fathur</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <p class="text-gray-700 mb-4">"Amazing experience with This Application"</p>
                    <p class="text-gray-900 font-bold">JOYO</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <p class="text-gray-700 mb-4">"Highly recommended for everyone!"</p>
                    <p class="text-gray-900 font-bold">Davis</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto text-center">
            <p>&copy; Inventory Management System. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>