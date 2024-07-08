<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::middleware([])->group(function () {

    Route::get('/', [HomeController::class, 'index']);

});
