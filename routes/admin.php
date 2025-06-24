<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;

Route::middleware(['web', 'isCmsInstalled', 'setLocale'])->prefix('admin')->name('admin.')->group(function () {

    // Install
    Route::get('/install', [AuthController::class, 'install'])->name('install');
    Route::post('/install', [AuthController::class, 'installRequest'])->name('install-request');

    // Login
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginRequest'])->name('login-request');

    // Reset password
    Route::get('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');
    Route::post('/reset-password', [AuthController::class, 'resetPasswordRequest'])->name('reset-password-request');

    // Set new password
    Route::get('/new-password/{userId}-{resetPasswordHash}', [AuthController::class, 'newPassword'])->name('new-password');
    Route::post('/new-password', [AuthController::class, 'newPasswordRequest'])->name('new-password-request');
});


Route::middleware(['web', 'auth', 'isCmsInstalled'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Auth
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
