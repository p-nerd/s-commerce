<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('dashboard/index'))->name('dashboard');

Route::prefix('categories')->group(function () {

    Route::get('/create', [CategoryController::class, 'create'])->name('dashboard.categories.create');
    Route::post('/', [CategoryController::class, 'store'])->name('dashboard.categories.store');

    Route::get('/', [CategoryController::class, 'index'])->name('dashboard.categories');
    Route::get('/{category}/sub-categories', [CategoryController::class, 'subCategories'])->name('dashboard.categories.sub-categories');
    Route::get('/{category}', [CategoryController::class, 'show'])->name('dashboard.categories.show');

    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('dashboard.categories.edit');
    Route::patch('/{category}', [CategoryController::class, 'update'])->name('dashboard.categories.update');

    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('dashboard.categories.destroy');

});

Route::prefix('products')->group(function () {

    Route::get('/create', [ProductController::class, 'create'])->name('dashboard.products.create');
    Route::post('/', [ProductController::class, 'store'])->name('dashboard.products.store');

    Route::get('/', [ProductController::class, 'index'])->name('dashboard.products');
    Route::get('/{product}', [ProductController::class, 'show'])->name('dashboard.products.show');

    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('dashboard.products.edit');
    Route::patch('/{product}', [ProductController::class, 'update'])->name('dashboard.products.update');

    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('dashboard.products.destroy');

});
