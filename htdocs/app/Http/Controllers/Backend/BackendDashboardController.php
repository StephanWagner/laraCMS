<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController;
// use App\Http\Middleware\ItemLink;
// use Illuminate\Support\Facades\Auth;

class BackendDashboardController extends BackendController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show dashboard page
     */

    public function show()
    {
        return view('backend/dashboard', [
            // TODO
        ]);
    }
}
