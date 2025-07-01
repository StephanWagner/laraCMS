<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function list()
    {
        return view('admin::pages.users.list');
    }

    public function profile()
    {
        return view('admin::pages.users.profile');
    }
}
