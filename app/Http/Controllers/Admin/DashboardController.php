<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function view()
    {
        return view('admin::pages.dashboard.view');
    }
}
