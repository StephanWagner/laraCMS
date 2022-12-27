<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\FrontendController;

class HomeController extends FrontendController
{
	function show()
	{
		return view('frontend/home', [
            // TODO
		]);
	}
}
