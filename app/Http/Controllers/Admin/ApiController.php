<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\Controller;
use App\Services\ListService;
use App\Services\FormService;

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
     * Save form data
     */
    public function saveForm()
    {
        $key = request()->input('key');
        $values = request()->input('values');
        return FormService::saveForm($key, $values);
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
        $ids = request()->input('ids', []);
        $action = request()->input('action');

        $listConfig = ListService::getConfig($key);
        $modelClassName = $listConfig['model'] ?? null;
        $modelClass = 'App\\Models\\' . $modelClassName;

        $idList = collect($ids);
        if ($id && !$idList->contains($id)) {
            $idList->push($id);
        }

        if ($idList->isEmpty()) {
            return ['success' => false];
        }

        $models = $modelClass::whereIn('id', $idList)->get();
        $lastValue = null;

        foreach ($models as $model) {
            $model->timestamps = false;

            if ($action === 'activate') {
                $model->active = true;
            } elseif ($action === 'deactivate') {
                $model->active = false;
            } else {
                $model->active = !$model->active;
            }

            $model->save();
            $lastValue = $model->active;
        }

        return [
            'success' => true,
            'value' =>  $idList->count() > 1 ? ($action == 'activate' ? 1 : 0) : $model->active,
            'message' => __('admin::api.toggle.successMessage.' . ($idList->count() > 1 ? ($action == 'activate' ? 'onBulk' : 'offBulk') : ($lastValue ? 'on' : 'off')), ['items' => $idList->count()]),
        ];
    }

    /**
     * Duplicate item
     */
    public function duplicate()
    {
        $key = request()->input('key');
        $id = request()->input('id');

        $listConfig = ListService::getConfig($key);

        $modelClassName = $listConfig['model'] ?? null;
        $modelClass = 'App\\Models\\' . $modelClassName;

        $model = $modelClass::find($id);

        if ($model) {
            $newModel = $model->replicate();

            $attributes = $model->getAttributes();
            $labelKey = array_key_exists('title', $attributes) ? 'title' : (array_key_exists('name', $attributes) ? 'name' : null);

            if ($labelKey) {
                $original = $model->$labelKey;
                $base = preg_replace('/\s\((Copy(?: \d+)?)\)$/i', '', $original);

                $existing = $modelClass::where($labelKey, 'like', $base . ' (Copy%')->pluck($labelKey);

                $max = 0;
                foreach ($existing as $existingValue) {
                    if (preg_match('/\s\(Copy(?: (\d+))?\)$/i', $existingValue, $matches)) {
                        $n = isset($matches[1]) ? (int) $matches[1] : 1;
                        if ($n > $max) $max = $n;
                    }
                }

                $newLabel = $base . ' (Copy' . ($max + 1 > 1 ? ' ' . ($max + 1) : '') . ')';
                $newModel->$labelKey = $newLabel;
            }

            $table = $model->getTable();
            $columns = Schema::getColumnListing($table);

            if (in_array('active', $columns)) {
                $newModel->active = 0;
            }

            if (in_array('order', $columns)) {
                $maxOrder = $model->newQuery()->max('order');
                $newModel->order = $maxOrder + 1;
            }

            if (!empty($listConfig['duplicate']['uniqueColumns'])) {
                foreach ($listConfig['duplicate']['uniqueColumns'] as $col) {
                    if (isset($col['column']) && in_array($col['column'], $columns)) {
                        $columnName = $col['column'];
                        $original = $model->$columnName;
                        $base = preg_replace('/-\d+$/', '', $original);

                        $existing = $model->newQuery()
                            ->withTrashed()
                            ->where($columnName, 'like', $base . '-%')
                            ->pluck($columnName);

                        $max = 1;
                        foreach ($existing as $val) {
                            if (preg_match('/-(\d+)$/', $val, $m)) {
                                $n = (int)$m[1];
                                $max = max($max, $n + 1);
                            }
                        }

                        $newModel->$columnName = $base . '-' . $max;
                    }
                }
            }

            $newModel->push();
        }

        // TODO Also duplicate relations

        $listData = ListService::getData($key, $this->getListParams());

        return [
            'success' => true,
            'listData' => $listData,
            'message' => __('admin::api.duplicate.successMessage'),
        ];
    }

    /**
     * Delete item
     */
    public function delete()
    {
        $key = request()->input('key');
        $id = request()->input('id');
        $ids = request()->input('ids', []);
        $force = request()->input('force');

        $listConfig = ListService::getConfig($key);
        $modelClassName = $listConfig['model'] ?? null;
        $modelClass = 'App\\Models\\' . $modelClassName;

        $idList = collect($ids);
        if ($id && !$idList->contains($id)) {
            $idList->push($id);
        }

        if ($idList->isEmpty()) {
            return ['success' => false];
        }

        $models = $modelClass::withTrashed()->whereIn('id', $idList)->get();

        foreach ($models as $model) {
            $model->timestamps = false;
            $force ? $model->forceDelete() : $model->delete();
        }

        $listData = ListService::getData($key, $this->getListParams());

        return [
            'success' => true,
            'listData' => $listData,
            'message' => __('admin::api.delete.successMessage' . ($idList->count() > 1 ? 'Bulk' : ''), ['items' => $idList->count()]),
        ];
    }

    /**
     * Restore item
     */
    public function restore()
    {
        $key = request()->input('key');
        $id = request()->input('id');
        $ids = request()->input('ids', []);

        $listConfig = ListService::getConfig($key);
        $modelClassName = $listConfig['model'] ?? null;
        $modelClass = 'App\\Models\\' . $modelClassName;

        $idList = collect($ids);
        if ($id && !$idList->contains($id)) {
            $idList->push($id);
        }

        if ($idList->isEmpty()) {
            return ['success' => false];
        }

        $models = $modelClass::withTrashed()->whereIn('id', $idList)->get();

        foreach ($models as $model) {
            $model->timestamps = false;
            $model->restore();
        }

        $listData = ListService::getData($key, $this->getListParams());

        return [
            'success' => true,
            'listData' => $listData,
            'message' => __('admin::api.restore.successMessage' . ($idList->count() > 1 ? 'Bulk' : ''), ['items' => $idList->count()]),
        ];
    }
}
