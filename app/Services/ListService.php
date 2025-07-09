<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\ContentType;

class ListService
{
    public static function getList(string $key)
    {
        $settingKey = 'list_settings.' . $key;

        $raw = DB::table('settings')->where('key', $settingKey)->value('value');

        if (!$raw && $contentType = ContentType::where('key', $key)->first()) {
            $raw = $contentType->settings['list'] ?? null;
        }

        if (!$raw) return null;

        $config = json_decode($raw, true);
        $config['key'] = $key;

        $modelClassName = $config['model'] ?? null;
        $modelClass = 'App\\Models\\' . $modelClassName;

        if (!class_exists($modelClass)) {
            return null;
        }

        if (!is_subclass_of($modelClass, \Illuminate\Database\Eloquent\Model::class)) {
            return null;
        }

        $query = $modelClass::query();

        $with = [];

        foreach ($config['columns'] as $column) {
            if (!empty($column['relation'])) {
                $with[] = $column['relation'];
            }
        }

        if (!empty($with)) {
            $query->with($with);
        }

        // Apply ordering
        $orderBy = request()->get('order-by', $config['defaultOrderBy'] ?? 'id');
        $orderDirection = strtolower(request()->get('order-direction', $config['defaultOrderDirection'] ?? 'desc'));

        if (!in_array($orderDirection, ['asc', 'desc'])) {
            $orderDirection = 'desc';
        }

        $config['orderBy'] = $orderBy;
        $config['orderDirection'] = $orderDirection;

        $query->orderBy($orderBy, $orderDirection);

        // Get paginated result
        $perPage = $config['defaultPerPage'] ?? 20;
        $items = $query->paginate($perPage);

        return [
            'config' => $config,
            'items' => $items,
        ];
    }
}
