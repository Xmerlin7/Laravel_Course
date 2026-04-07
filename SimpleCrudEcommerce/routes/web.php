<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     if (!auth()->check()) {
//         return redirect()->route('login');
//     }

//     return auth()->user()?->role === 'admin'
//         ? redirect('/users')
//         : redirect('/products');
// });

// Route::middleware('guest')->group(function () {
//     Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
//     Route::post('/login', [AuthController::class, 'login'])->name('login.store');
// });

// Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Route::get('/products', [ProductController::class, 'index'])->middleware('auth');

// Route::get('/orders', [OrderController::class, 'index']);
// Route::get('/orders/{order}', [OrderController::class, 'show']);
// Route::post('/orders', [OrderController::class, 'store']);
// Route::post('/orders/{order}/items', [OrderController::class, 'addItem']);

// Route::middleware(['auth', 'admin'])->prefix('users')->group(function () {
//     Route::get('/', [UserController::class, 'index']);
//     Route::get('/create', [UserController::class, 'create']);
//     Route::post('/store', [UserController::class, 'store']);
// });
