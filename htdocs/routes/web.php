<?php

use Illuminate\Support\Facades\Route;

// Homepage

Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'show']);
