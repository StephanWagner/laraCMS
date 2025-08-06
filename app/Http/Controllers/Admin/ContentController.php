<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ListService;
use App\Services\FormService;

class ContentController extends Controller
{
    public function list()
    {
        $type = $this->resolveType();

        return ListService::getView($type);
    }

    public function edit(?int $id = null)
    {
        $type = $this->resolveType();

        return FormService::getView($type, $id);
    }

    protected function resolveType(): string
    {
        return request()->route('type') ?? request()->attributes->get('type') ?? abort(404);
    }
}
