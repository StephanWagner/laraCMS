<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ListService;

class ContentTypesController extends Controller
{
    public function list()
    {
        $data = ListService::getList('content_types');

        return view('admin::pages.content-types.list', [
            'listConfig' => $data['config'],
            'items' => $data['items'],
        ]);
    }
}
