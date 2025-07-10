<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\ContentType;

class ListService
{
    public static function getList(string $key, array $params = [])
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

        // Add relations
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
        $orderBy = $params['orderBy'] ?? ($config['defaultOrderBy'] ?? 'id');
        $orderDirection = $params['orderDirection'] ?? ($config['defaultOrderDirection'] ?? 'asc');

        if (!in_array($orderDirection, ['asc', 'desc'])) {
            $orderDirection = 'asc';
        }

        $config['orderBy'] = $orderBy;
        $config['orderDirection'] = $orderDirection;

        $column = collect($config['columns'])->firstWhere('source', $orderBy);

        if (isset($column['relation']) && str_contains($column['source'], '.')) {
            [$relation, $field] = explode('.', $column['source'], 2);
            $relationMethod = $query->getModel()->{$relation}();
            $relatedTable = $relationMethod->getRelated()->getTable();
            $relatedAlias = $relation;
            $foreignKey = $relationMethod->getQualifiedForeignKeyName();
            $query
                ->leftJoin("{$relatedTable} as {$relatedAlias}", $foreignKey, '=', "{$relatedAlias}.id")
                ->orderBy("{$relatedAlias}.{$field}", $orderDirection)
                ->select($query->getModel()->getTable() . '.*');
        } else {
            $query->orderBy($orderBy, $orderDirection);
        }

        // Get paginated result
        $perPage = $config['defaultPerPage'] ?? 20;
        $items = $query->paginate($perPage);

        return [
            'config' => $config,
            'items' => $items,
        ];
    }
}
