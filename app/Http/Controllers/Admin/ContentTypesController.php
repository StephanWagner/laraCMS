<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ListService;

class ContentTypesController extends Controller
{
    public function list()
    {
        $listData = ListService::getData('content-types');

        return view('admin::pages.content-types.list', [
            'listData' => $listData,
        ]);
    }
}
