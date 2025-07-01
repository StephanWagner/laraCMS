<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function siteInfo()
    {
        return view('admin::pages.settings.site-info');
    }

    public function siteVariables()
    {
        return view('admin::pages.settings.site-variables');
    }

    public function developer()
    {
        return view('admin::pages.settings.developer');
    }
}
