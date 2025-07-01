<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class MediaController extends Controller
{
    public function list()
    {
        return view('admin::pages.media.list');
    }
}
