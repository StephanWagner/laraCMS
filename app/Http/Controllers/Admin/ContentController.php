<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ContentController extends Controller
{
    public function list()
    {
        return view('admin::pages.content.list');
    }
}
