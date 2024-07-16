<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Store\CartController;
use App\Http\Controllers\Store\CheckoutController;
use App\Http\Controllers\Store\HomeController;
use App\Http\Controllers\Store\ProductController as StoreProductController;
use Illuminate\Support\Facades\Route;

// store routes
Route::get('/', [HomeController::class, 'index']);

Route::prefix('/products')->group(function () {
    Route::get('/', [StoreProductController::class, 'index'])->name('products');
    Route::get('/{slug}', [StoreProductController::class, 'show'])->name('products.show');
});

Route::prefix('/cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart');
    Route::post('/', [CartController::class, 'store'])->name('cart.store');
    Route::patch('/', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
});

Route::prefix('/checkout')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('checkout');
});

Route::middleware([])->group(function () {

    Route::get('/about', fn () => view('store/about'));
    Route::get('/account', fn () => view('store/account'));
    Route::get('/wishlist', fn () => view('store/wishlist'));
    Route::get('/compare', fn () => view('store/compare'));
    Route::get('/contact', fn () => view('store/contact'));
    Route::get('/store-login', fn () => view('store/login'));
    Route::get('/store-register', fn () => view('store/register'));
    Route::get('/store-forgot-password', fn () => view('store/forgot-password'));
    Route::get('/store-reset-password', fn () => view('store/reset-password'));
    Route::get('/purchase-guide', fn () => view('store/purchase-guide'));
    Route::get('/privacy-policy', fn () => view('store/privacy-policy'));
    Route::get('/terms', fn () => view('store/terms'));
    Route::get('/404', fn () => view('store/404'));
});

// dashboard routes
Route::prefix('/dashboard')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', fn () => view('dashboard/index'))->name('dashboard');

    Route::prefix('/categories')->group(function () {

        Route::get('/create', [CategoryController::class, 'create'])->name('dashboard.categories.create');
        Route::post('/', [CategoryController::class, 'store'])->name('dashboard.categories.store');

        Route::get('/', [CategoryController::class, 'index'])->name('dashboard.categories');
        Route::get('/{category}/sub-categories', [CategoryController::class, 'subCategories'])->name('dashboard.categories.sub-categories');
        Route::get('/{category}', [CategoryController::class, 'show'])->name('dashboard.categories.show');

        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('dashboard.categories.edit');
        Route::patch('/{category}', [CategoryController::class, 'update'])->name('dashboard.categories.update');

        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('dashboard.categories.destroy');

    });

    Route::prefix('/products')->group(function () {

        Route::get('/create', [ProductController::class, 'create'])->name('dashboard.products.create');
        Route::post('/', [ProductController::class, 'store'])->name('dashboard.products.store');

        Route::get('/', [ProductController::class, 'index'])->name('dashboard.products');
        Route::get('/{product}', [ProductController::class, 'show'])->name('dashboard.products.show');

        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('dashboard.products.edit');
        Route::patch('/{product}', [ProductController::class, 'update'])->name('dashboard.products.update');

        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('dashboard.products.destroy');

    });
});

// auth routes
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
