<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ListService;

class ApiController extends Controller
{
    /**
     * Get list data
     */
    public function list()
    {
        sleep(1);

        $key = request()->input('key');

        $listData = ListService::getList($key, [
            'orderBy' => request()->input('orderBy'),
            'orderDirection' => request()->input('orderDirection'),
            // 'filters' => request()->input('filters', []),
            // 'page' => request()->input('page', 1),
        ]);

        return [
            'success' => true,
            'listData' => $listData
        ];
    }
}
