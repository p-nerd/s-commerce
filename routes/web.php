<?php

use Illuminate\Support\Facades\Route;

// store routes
require __DIR__.'/store.php';

// dashboard routes
Route::prefix('/dashboard')->middleware(['auth', 'verified'])->group(function () {
    require __DIR__.'/dashboard.php';
});

// auth routes
require __DIR__.'/auth.php';
