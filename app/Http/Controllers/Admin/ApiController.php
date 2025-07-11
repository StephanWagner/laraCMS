<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ListService;

class ApiController extends Controller
{
    /**
     * Get list params
     */
    protected function getListParams()
    {
        return [
            'orderBy' => request()->input('orderBy'),
            'orderDirection' => request()->input('orderDirection'),
            'searchTerm' => request()->input('searchTerm'),
            'perPage' => request()->input('perPage'),
            'trashed' => request()->input('trashed'),
        ];
    }

    /**
     * Get list data
     */
    public function list()
    {
        $key = request()->input('key');

        $listData = ListService::getData($key, $this->getListParams());

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
        $force = request()->input('force');

        $listConfig = ListService::getConfig($key);

        $modelClassName = $listConfig['model'] ?? null;
        $modelClass = 'App\\Models\\' . $modelClassName;

        $model = $modelClass::find($id);
        if ($model) {
            $model->timestamps = false;
            if ($force) {
                $model->forceDelete();
            } else {
                $model->delete();
            }
        }

        $listData = ListService::getData($key, $this->getListParams());

        return [
            'success' => true,
            'listData' => $listData,
            'message' => __('admin::api.delete.successMessage'),
        ];
    }

    /**
     * Restore item
     */
    public function restore()
    {
        $key = request()->input('key');
        $id = request()->input('id');

        $listConfig = ListService::getConfig($key);

        $modelClassName = $listConfig['model'] ?? null;
        $modelClass = 'App\\Models\\' . $modelClassName;

        $model = $modelClass::withTrashed()->find($id);
        if ($model) {
            $model->timestamps = false;
            $model->restore();
        }

        $listData = ListService::getData($key, $this->getListParams());

        return [
            'success' => true,
            'listData' => $listData,
            'message' => __('admin::api.restore.successMessage'),
        ];
    }
}
