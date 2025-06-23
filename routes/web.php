<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\HomeController;

Route::middleware(['web', 'isCmsInstalled'])->group(function () {
    // Root
    Route::get('/', [HomeController::class, 'index']);
});
