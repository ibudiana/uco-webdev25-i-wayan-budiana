<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

// Routes that require authentication auth only
Route::middleware(['auth'])->group(function () {
    // Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });
});

// Routes that require authentication and email verification
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('products', ProductController::class);

    Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
});


// Public routes
Route::group([], function () {
    // Home page
    // Route::get('/', function () {
    //     return view('welcome');
    // })->name('home');

    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Products index and show
    Route::resource('products', ProductController::class)->only(['index', 'show']);
});

require __DIR__ . '/auth.php';
