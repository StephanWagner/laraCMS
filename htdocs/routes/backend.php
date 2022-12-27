<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\BackendDashboardController;

// Dashboard
Route::get('/admin', [BackendDashboardController::class, 'dashboard'])->middleware('auth');

// Login
Route::get('/admin/login', [BackendController::class, 'login'])->name('login');
Route::post('/admin/login', [BackendController::class, 'loginRequest']);

// Logout
Route::get('/admin/logout', [BackendController::class, 'logout']);
