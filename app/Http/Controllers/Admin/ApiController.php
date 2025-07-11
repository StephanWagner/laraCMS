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
        $key = request()->input('key');

        $listData = ListService::getData($key, [
            'orderBy' => request()->input('orderBy'),
            'orderDirection' => request()->input('orderDirection'),
            'searchTerm' => request()->input('searchTerm'),
            // 'filters' => request()->input('filters', []),
            // 'page' => request()->input('page', 1),
        ]);

        return [
            'success' => true,
            'listData' => $listData
        ];
    }

    /**
     * Save new list order
     */
    public function listReorder()
    {
        $key = request()->input('key');
        $items = request()->input('items');

        $listConfig = ListService::getConfig($key);

        $modelClassName = $listConfig['model'] ?? null;
        $modelClass = 'App\\Models\\' . $modelClassName;

        foreach ($items as $item) {
            $model = $modelClass::find($item['id']);
            if ($model) {
                $model->timestamps = false;
                $model->order = $item['order'];
                $model->save();
            }
        }

        return [
            'success' => true,
            'message' => __('admin::api.listReorder.successMessage'),
        ];
    }

    /**
     * Toggle active state
     */
    public function toggle()
    {
        $key = request()->input('key');
        $id = request()->input('id');

        $listConfig = ListService::getConfig($key);

        $modelClassName = $listConfig['model'] ?? null;
        $modelClass = 'App\\Models\\' . $modelClassName;

        $model = $modelClass::find($id);
        if ($model) {
            $model->timestamps = false;
            $model->active = !$model->active;
            $model->save();
        }

        return [
            'success' => true,
            'value' => $model->active,
            'message' => __('admin::api.toggle.successMessage.' . ($model->active ? 'on' : 'off')),
        ];
    }

    /**
     * Delete item
     */
    public function delete()
    {
        $key = request()->input('key');
        $id = request()->input('id');

        $listConfig = ListService::getConfig($key);

        $modelClassName = $listConfig['model'] ?? null;
        $modelClass = 'App\\Models\\' . $modelClassName;

        $model = $modelClass::find($id);
        if ($model) {
            $model->delete();;
        }

        $listData = ListService::getData($key, [
            // TODO 'orderBy' => request()->input('orderBy'),
            // TODO 'orderDirection' => request()->input('orderDirection'),
            // 'filters' => request()->input('filters', []),
            // 'page' => request()->input('page', 1),
        ]);

        return [
            'success' => true,
            'listData' => $listData,
            'message' => __('admin::api.delete.successMessage'),
        ];
    }
}
