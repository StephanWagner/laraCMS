<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ListService;
use App\Services\FormService;

class UsersController extends Controller
{
    public function list()
    {
        return ListService::getView('users');
    }

    public function edit(?int $id = null)
    {
        return FormService::getView('users', $id);
    }

    public function profile()
    {
        return view('admin::pages.users.profile');
    }
}
