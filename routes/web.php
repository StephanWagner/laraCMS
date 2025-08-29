<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Admin\MediaController;

Route::middleware(['web', 'isCmsInstalled'])->group(function () {
    // Home
    Route::get('/', [HomeController::class, 'index']);
});

// Media
Route::middleware(['web'])->name('media.')->group(function () {
    Route::get('/media/{uuid}{size?}/{slug?}', [MediaController::class, 'show'])
        ->where('uuid', '[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}')
        ->where('size', '(-[a-z0-9_-]+)?')
        ->name('show.version');
});
