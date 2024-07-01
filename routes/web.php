<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// store routes
Route::middleware([])->group(function () {
    Route::get('/', function () {
        return view('store/home');
    });
});

// dashboard routes
Route::prefix('/dashboard')->middleware(['auth', 'verified'])->group(function () {
    require __DIR__.'/dashboard.php';
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
