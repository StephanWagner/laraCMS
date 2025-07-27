<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ListService;
use App\Services\FormService;

class UsersController extends Controller
{
    public function list()
    {
        $listData = ListService::getData('users');

        return view('admin::pages.users.list', [
            'listData' => $listData,
        ]);
    }

    public function edit(?int $id = null)
    {
        $formData = FormService::getData('users', $id);

        return view('admin::pages.users.form', [
            'formData' => $formData,
        ]);
    }

    public function profile()
    {
        return view('admin::pages.users.profile');
    }
}
