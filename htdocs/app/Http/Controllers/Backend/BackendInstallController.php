<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController;
use Illuminate\Support\Facades\Cache;
// use App\Http\Middleware\ItemLink;
// use Illuminate\Support\Facades\Auth;

class BackendInstallController extends BackendController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show install page
     */

    function show()
    {
        $isInstalled = \App\Models\Settings::where('name', 'is-installed')->count() > 0;

        if (Cache::get('is-installed') || $isInstalled) {
            Cache::put('is-installed', true);
            return redirect('/admin');
        }

        return view('backend/install', [
            'languages' => config('backend.languages')
        ]);
    }
}
