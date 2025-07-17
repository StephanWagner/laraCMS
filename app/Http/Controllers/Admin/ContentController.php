<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ListService;

class ContentController extends Controller
{
    public function list($type)
    {
        $listData = ListService::getData($type);

        return view('admin::pages.content.list', [
            'listData' => $listData
        ]);
    }
}
