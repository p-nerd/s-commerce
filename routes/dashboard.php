<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('dashboard/index'))->name('dashboard');
Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('dashboard.categories');
    Route::get('/{category}/sub-categories', [CategoryController::class, 'subCategories'])->name('dashboard.categories.sub-categories');
    Route::get('/create', [CategoryController::class, 'create'])->name('dashboard.categories.create');
    Route::get('/{category}', fn () => view('dashboard/categories/show'))->name('dashboard.categories.show');
    Route::get('/{category}/edit', fn () => view('dashboard/categories/edit'))->name('dashboard.categories.edit');
    Route::post('/', [CategoryController::class, 'store'])->name('dashboard.categories.store');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('dashboard.categories.destroy');
});
