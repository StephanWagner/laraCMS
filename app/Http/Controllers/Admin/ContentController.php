<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ListService;

class ContentController extends Controller
{
    public function list($type)
    {
        return ListService::getView($type);
    }
}
