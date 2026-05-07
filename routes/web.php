<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;

// Public Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', [HomeController::class, 'about'])->name('about');
Route::get('/layanan', [HomeController::class, 'services'])->name('services');
Route::get('/menu', [HomeController::class, 'menu'])->name('menu');
Route::get('/harga', [HomeController::class, 'pricing'])->name('pricing');
Route::get('/kontak', [HomeController::class, 'contact'])->name('contact');

// Cart & Order Routes
Route::get('/keranjang', [CartController::class, 'index'])->name('cart');
Route::post('/keranjang/tambah', [CartController::class, 'add'])->name('cart.add');
Route::put('/keranjang/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/keranjang/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/keranjang/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/keranjang/process-checkout', [CartController::class, 'processCheckout'])->name('cart.process-checkout');
Route::get('/pesanan/success/{id}', [CartController::class, 'success'])->name('order.success');
Route::get('/cart/count', function () {
    return response()->json(['count' => count(session('cart', []))]);
})->name('cart.count');
