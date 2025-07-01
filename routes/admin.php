<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ThemesController;
use App\Http\Controllers\Admin\MenusController;
use App\Http\Controllers\Admin\FormsController;
use App\Http\Controllers\Admin\ContentTypesController;
use App\Http\Controllers\Admin\BlocksController;

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
    // Auth
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'view'])->name('view');
    });

    // Content
    Route::prefix('content')->name('content.')->group(function () {
        Route::get('{type}', [ContentController::class, 'list'])->name('list');
        Route::get('{type}/edit/{id?}', [ContentController::class, 'edit'])->name('edit');
        Route::post('{type}/edit/{id?}', [ContentController::class, 'save'])->name('save');
    });

    // Media
    Route::prefix('media')->name('media.')->group(function () {
        Route::get('list', [MediaController::class, 'list'])->name('list');
    });

    // Settings
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('site-info', [SettingsController::class, 'siteInfo'])->name('site-info');
        Route::get('site-variables', [SettingsController::class, 'siteVariables'])->name('site-variables');
        Route::get('developer', [SettingsController::class, 'developer'])->middleware('userIsDeveloper')->name('developer');
    });

    // Users
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('list', [UsersController::class, 'list'])->name('list');
    });

    // Themes
    Route::prefix('themes')->name('themes.')->group(function () {
        Route::get('select', [ThemesController::class, 'select'])->name('select');
        Route::get('variables', [ThemesController::class, 'variables'])->name('variables');
    });

    // Menus
    Route::prefix('menus')->name('menus.')->group(function () {
        Route::get('list', [MenusController::class, 'list'])->name('list');
    });

    // Forms
    Route::prefix('forms')->name('forms.')->group(function () {
        Route::get('list', [FormsController::class, 'list'])->name('list');
        Route::get('submissions', [FormsController::class, 'submissions'])->name('submissions');
    });

    // Content types
    Route::prefix('content-types')->name('content-types.')->group(function () {
        Route::get('list', [ContentTypesController::class, 'list'])->name('list');
    });

    // Blocks
    Route::prefix('blocks')->name('blocks.')->group(function () {
        Route::get('list', [BlocksController::class, 'list'])->name('list');
        Route::get('groups', [BlocksController::class, 'groups'])->name('groups');
    });
});
