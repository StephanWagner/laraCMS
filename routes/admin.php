<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;

Route::prefix('admin')->name('admin.')->group(function () {
        // Register
        Route::get('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/register', [AuthController::class, 'registerRequest'])->name('register-request');

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


Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Auth
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    });
