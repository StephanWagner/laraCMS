<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ContentController;
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

Route::middleware(['web', 'auth', 'isCmsInstalled', 'setLocale'])->prefix('admin')->name('admin.')->group(function () {
    // Auth
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::name('dashboard.')->group(function () {
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
    Route::middleware('accessAdmin')->prefix('settings')->name('settings.')->group(function () {
        Route::get('site-info', [SettingsController::class, 'siteInfo'])->name('site-info');
        Route::get('site-variables', [SettingsController::class, 'siteVariables'])->name('site-variables');
        Route::get('developer', [SettingsController::class, 'developer'])->middleware('accessDeveloper')->name('developer');
    });

    // Users
    Route::middleware('accessAdmin')->prefix('users')->name('users.')->group(function () {
        Route::get('list', [UsersController::class, 'list'])->name('list');
        Route::get('profile', [UsersController::class, 'profile'])->name('profile');
    });

    // Themes
    Route::middleware('accessDeveloper')->prefix('themes')->name('themes.')->group(function () {
        Route::get('select', [ThemesController::class, 'select'])->name('select');
        Route::get('variables', [ThemesController::class, 'variables'])->name('variables');
    });

    // Menus
    Route::middleware('accessDeveloper')->prefix('menus')->name('menus.')->group(function () {
        Route::get('list', [MenusController::class, 'list'])->name('list');
    });

    // Forms
    Route::middleware('accessDeveloper')->prefix('forms')->name('forms.')->group(function () {
        Route::get('list', [FormsController::class, 'list'])->name('list');
        Route::get('submissions', [FormsController::class, 'submissions'])->name('submissions');
    });

    // Content types
    Route::middleware('accessDeveloper')->prefix('content-types')->name('content-types.')->group(function () {
        Route::get('list', [ContentTypesController::class, 'list'])->name('list');
    });

    // Blocks
    Route::middleware('accessDeveloper')->prefix('blocks')->name('blocks.')->group(function () {
        Route::get('list', [BlocksController::class, 'list'])->name('list');
        Route::get('groups', [BlocksController::class, 'groups'])->name('groups');
    });

    // Api
    Route::prefix('api')->name('api.')->group(function () {
        Route::post('/list', [\App\Http\Controllers\Admin\ApiController::class, 'list'])->name('list');
        Route::post('/list-reorder', [\App\Http\Controllers\Admin\ApiController::class, 'listReorder'])->name('list-reorder');
        Route::post('/toggle', [\App\Http\Controllers\Admin\ApiController::class, 'toggle'])->name('toggle');
    });
});
