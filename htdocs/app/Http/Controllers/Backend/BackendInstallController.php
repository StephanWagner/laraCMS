<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController;
use Illuminate\Support\Facades\Cache;
use App\Providers\BackendLanguageProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
        // Abort if laraCMS is already installed
        $isInstalled = \App\Models\Settings::where('name', 'is-installed')->count() > 0;

        if (Cache::get('is-installed') || $isInstalled) {
            Cache::put('is-installed', true);
            return redirect('/admin');
        }

        return view('backend/install', [
            'languages' => config('backend.languages')
        ]);
    }

    /**
     * Install request
     */

    function installRequest(Request $request)
    {
        sleep(1);

        // TODO check for errors

        // TODO add user and options and send success

        return response()->json([
            'success' => false
        ]);
    }
}
