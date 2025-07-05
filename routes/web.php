<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsletterSubscriptionController;
use Illuminate\Support\Facades\Route;

// Routes that require authentication auth only
Route::middleware(['auth'])->group(function () {
    // Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');

        Route::get('/payment-methods', [ProfileController::class, 'paymentMethods'])->name('payment-methods');
        Route::patch('/payment-methods', [ProfileController::class, 'storePaymentMethod'])->name('payment-methods.store');
        Route::delete('/payment-methods/{id}', [ProfileController::class, 'deletePaymentMethod'])->name('payment-methods.delete');

        Route::get('/shipping-addresses', [ProfileController::class, 'shippingAddresses'])->name('shipping-addresses');
        Route::patch('/shipping-addresses', [ProfileController::class, 'storeShippingAddress'])->name('shipping-addresses.store');
        Route::delete('/shipping-addresses/{id}', [ProfileController::class, 'deleteShippingAddress'])->name('shipping-addresses.delete');
    });
});

// Routes that require authentication and email verification
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('products', ProductController::class);
    Route::delete('/products/image/{id}', [ProductController::class, 'deleteImage'])->name('product.image.delete');
    Route::post('/products/review', [ProductReviewController::class, 'store'])->name('product.review');


    Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');

    Route::prefix('transaction')->name('transaction.')->group(function () {
        Route::get('/checkout', [TransactionController::class, 'showCheckoutForm'])->name('checkout');
        Route::post('/checkout', [TransactionController::class, 'processCheckout'])->name('process');
        Route::get('/complete', [TransactionController::class, 'checkoutSuccess'])->name('complete');

        Route::get('/', [TransactionController::class, 'index'])->name('index');
        Route::get('/{id}', [TransactionController::class, 'show'])->name('show');
        Route::patch('/{transaction}/status', [TransactionController::class, 'updateStatus'])->name('updateStatus');
    });

    Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');
    Route::get('/cart/fetch', [CartController::class, 'fetch'])->name('cart.fetch');

    // Blog routes
    Route::resource('blogs', BlogPostController::class);

    // Comment routes
    Route::post('blog/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
});


// Public routes
Route::group([], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Products index and show
    Route::resource('products', ProductController::class)->only(['index', 'show']);

    Route::resource('blogs', BlogPostController::class)->only(['index', 'show']);

    // Subscriber routes
    Route::post('subscribe', [NewsletterSubscriptionController::class, 'store'])->name('subscribe.store');
});

require __DIR__ . '/auth.php';
