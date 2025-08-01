<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ListService;

class ContentTypesController extends Controller
{
    public function list()
    {
        return ListService::getView('content-types');
    }
}
