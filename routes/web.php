<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PemesananController;
use App\Http\Controllers\Admin\PaketController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', [HomeController::class, 'about'])->name('about');
Route::get('/layanan', [HomeController::class, 'services'])->name('services');
Route::get('/menu', [HomeController::class, 'menu'])->name('menu');
Route::get('/harga', [HomeController::class, 'pricing'])->name('pricing');
Route::get('/kontak', [HomeController::class, 'contact'])->name('contact');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Customer Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/keranjang', [CartController::class, 'index'])->name('cart');
    Route::post('/keranjang/tambah', [CartController::class, 'add'])->name('cart.add');
    Route::put('/keranjang/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/keranjang/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/keranjang/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/keranjang/process-checkout', [CartController::class, 'processCheckout'])->name('cart.process-checkout');
    Route::get('/pesanan/success/{id}', [CartController::class, 'success'])->name('order.success');

    Route::get('/pesanan-saya', [PemesananController::class, 'pesananSaya'])->name('pesanan.saya');
    Route::get('/pesanan-saya/{pemesanan}', [PemesananController::class, 'detailPesanan'])->name('pesanan.show');
    Route::post('/pesanan-saya/check-status/{pemesanan}', [PemesananController::class, 'checkStatus'])->name('pesanan.check-status');
});

// Admin & CEO Routes
Route::middleware(['auth', 'role:admin,ceo'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
    Route::get('/pemesanan/{pemesanan}', [PemesananController::class, 'show'])->name('pemesanan.show');
    Route::post('/pemesanan/{pemesanan}/status', [PemesananController::class, 'updateStatus'])->name('pemesanan.update-status');
    Route::post('/pemesanan/{pemesanan}/pengiriman', [PemesananController::class, 'updatePengiriman'])->name('pemesanan.update-pengiriman');

    // CRUD Paket
    Route::get('/paket', [PaketController::class, 'index'])->name('paket.index');
    Route::get('/paket/create', [PaketController::class, 'create'])->name('paket.create');
    Route::post('/paket', [PaketController::class, 'store'])->name('paket.store');
    Route::get('/paket/{paket}/edit', [PaketController::class, 'edit'])->name('paket.edit');
    Route::put('/paket/{paket}', [PaketController::class, 'update'])->name('paket.update');
    Route::delete('/paket/{paket}', [PaketController::class, 'destroy'])->name('paket.destroy');

    // User Management (Admin only)
    Route::middleware('role:admin')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});
