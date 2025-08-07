<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
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

    public function edit(?string $type = null, ?int $id = null)
    {
        $type = $this->resolveType();

        if ($type === 'profile') {
            $id = Auth::user()->id;
        }

        return FormService::getView($type, $id);
    }

    protected function resolveType(): string
    {
        return request()->route('type') ?? request()->attributes->get('type') ?? abort(404);
    }
}
