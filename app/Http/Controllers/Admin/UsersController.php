<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ListService;

class UsersController extends Controller
{
    public function list()
    {
        $listData = ListService::getData('users');

        return view('admin::pages.users.list', [
            'listData' => $listData,
        ]);
    }

    public function profile()
    {
        return view('admin::pages.users.profile');
    }
}
