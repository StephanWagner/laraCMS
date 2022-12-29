<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\FrontendController;

class HomeController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    function show()
    {
        return view('frontend/home', [
            // TODO
        ]);
    }
}
