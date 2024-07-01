<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('dashboard/index'))->name('dashboard');
Route::prefix('categories')->group(function () {
    Route::get('dashboard/categories', [CategoryController::class, 'index'])->name('dashboard.categories');
    Route::get('dashboard/categories/create', fn () => view('dashboard/categories/create'))->name('dashboard.categories.create');
    Route::get('dashboard/categories/{category}', fn () => view('dashboard/categories/show'))->name('dashboard.categories.show');
    Route::get('dashboard/categories/{category}/edit', fn () => view('dashboard/categories/edit'))->name('dashboard.categories.edit');
});
