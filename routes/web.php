<?php

use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

// Public routes
Route::group([], function () {
    Route::resource('products', ProductController::class)->only(['index', 'show']);
});

// Routes that require authentication
Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class)->except(['index', 'show']);
});
