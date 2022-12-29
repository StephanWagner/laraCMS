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
        if (!Cache::get('is-installed') && Route::currentRouteName() != 'install') {
            $this->isInstalled = \App\Models\Settings::where('name', 'is-installed')->count() > 0;

            if (!$this->isInstalled) {
                return Redirect::to('/admin/install')->send();
            }

            // TODO set cache
        }
    }
}
