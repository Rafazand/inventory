<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\LandingController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::resource('suppliers', SupplierController::class);
Route::resource('orders', OrderController::class);
Route::resource('order_items', OrderItemController::class);

// Menu Route
Route::get('/', [MenuController::class, 'index'])->name('menu');
Route::get('/landing', function () {
    return view('landing');
});

// Route untuk landing page
// Route::get('/', [LandingController::class, 'index'])->name('landing.page');

// Registration route
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/menu', [MenuController::class, 'menu'])->middleware('auth');

Route::post('/set-theme', [ThemeController::class, 'setTheme'])->name('set-theme');

// Route::post('/orders', [OrderController::class, 'store']);
