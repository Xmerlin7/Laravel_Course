<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/products', [ProductController::class, 'index']);

// 1. صفحة الجدول (لعرض كل الناس)
Route::get('/users', [UserController::class, 'index']);

// 2. صفحة الفورم (عشان تكتب البيانات)
Route::get('/users/create', [UserController::class, 'create']);

// 3. الأكشن اللي بيخزن (محدش بيشوفه، ده "مواسير" بس)
Route::post('/users/store', [UserController::class, 'store']);
