<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('dashboard/index'))->name('dashboard');
Route::prefix('categories')->group(function () {

    Route::get('/create', [CategoryController::class, 'create'])->name('dashboard.categories.create');
    Route::post('/', [CategoryController::class, 'store'])->name('dashboard.categories.store');

    Route::get('/', [CategoryController::class, 'index'])->name('dashboard.categories');
    Route::get('/{category}/sub-categories', [CategoryController::class, 'subCategories'])->name('dashboard.categories.sub-categories');

    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('dashboard.categories.edit');
    Route::patch('/{category}', [CategoryController::class, 'update'])->name('dashboard.categories.update');

    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('dashboard.categories.destroy');

});
