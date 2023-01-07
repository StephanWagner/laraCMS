<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        // Check if laraCMS is installed
        $allowedRouteNames = ['install', 'installRequest'];
        if (!Cache::get('is-installed') && !in_array(Route::currentRouteName(), $allowedRouteNames)) {
            $isInstalled = \App\Models\Settings::where('name', 'is-installed')->count() > 0;

            if (!$isInstalled) {
                return Redirect::to('/admin/install')->send();
            }
        }
    }
}
