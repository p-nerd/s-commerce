<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::middleware([])->group(function () {

    Route::get('/', [HomeController::class, 'index']);
    Route::get('/products', fn () => view('store/products'));

    Route::get('/about', fn () => view('store/about'));
    Route::get('/account', fn () => view('store/account'));
    Route::get('/wishlist', fn () => view('store/wishlist'));
    Route::get('/cart', fn () => view('store/cart'));
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
