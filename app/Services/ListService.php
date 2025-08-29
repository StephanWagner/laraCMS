<?php

namespace App\Services;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\ContentType;
use App\Helpers\RouteHelper;

class ListService
{
    /**
     * Get the list config
     */
    public static function getConfig(string $key)
    {
        $settingKey = 'list-settings.' . $key;

        $config = DB::table('settings')->where('key', $settingKey)->value('value');

        if (!$config && $contentType = ContentType::where('key', $key)->first()) {
            $config = $contentType->settings['list'] ?? null;
        }

        if (is_string($config)) {
            $config = json_decode($config, true);
        }

        return $config;
    }

    /**
     * Get the list data
     */
    public static function getData(string $key, array $params = [])
    {
        $config = self::getConfig($key);

        if (!$config) return null;

        $config['key'] = $key;
        $config = RouteHelper::addListAndEditUris($config);

        $modelClassName = $config['model'] ?? null;
        $modelClass = 'App\\Models\\' . $modelClassName;

        if (!class_exists($modelClass)) {
            return null;
        }

        if (!is_subclass_of($modelClass, \Illuminate\Database\Eloquent\Model::class)) {
            return null;
        }

        $query = $modelClass::query();

        // Item type trashed
        $trashed = false;
        if (!empty($config['hasSoftDelete'])) {
            $trashed = $params['trashed'] ?? false;
            if ($trashed) {
                $query->onlyTrashed();
            }
            $config['trashed'] = $trashed;
        }

        // Add relations
        $with = [];

        foreach ($config['columns'] as $column) {
            if (!empty($column['relation']['key'])) {
                if (!empty($column['relation']['where'])) {
                    $with[$column['relation']['key']] = function ($query) use ($column) {
                        $query->where($column['relation']['where']);
                    };
                } else {
                    $with[] = $column['relation']['key'];
                }
            }
        }

        if (!empty($with)) {
            $query->with($with);
        }

        // Get user settings
        $user = auth()->user();
        $userSettings = $user->settings ?? [];
        $userSettings['list-settings'] = $userSettings['list-settings'] ?? [];
        $userListSettings = $userSettings['list-settings'][$key] ?? [];

        // Apply ordering
        if ($trashed) {
            $orderBy = $params['orderBy'] ?? 'deleted_at';
            $orderDirection = $params['orderDirection'] ?? 'desc';
        } else {
            $orderBy = $params['orderBy']
                ?? $userListSettings['orderBy']
                ?? $config['defaultOrderBy']
                ?? 'id';

            $orderDirection = $params['orderDirection']
                ?? $userListSettings['orderDirection']
                ?? $config['defaultOrderDirection']
                ?? 'asc';
        }

        if (!in_array($orderDirection, ['asc', 'desc'])) {
            $orderDirection = 'asc';
        }

        $config['orderBy'] = $orderBy;
        $config['orderDirection'] = $orderDirection;

        $orderColumn = collect($config['columns'])->firstWhere('source', $orderBy);

        if (isset($orderColumn['relation']) && str_contains($orderColumn['source'], '.')) {
            [$relation, $field] = explode('.', $orderColumn['source'], 2);
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

        // Apply search
        $searchTerm = $params['searchTerm'] ?? null;

        if ($searchTerm) {
            $searchables = $config['searchables'] ?? [];
            if (empty($searchables)) {
                if (Schema::hasColumn($modelClass::getModel()->getTable(), 'title')) {
                    $searchables[] = 'title';
                } elseif (Schema::hasColumn($modelClass::getModel()->getTable(), 'name')) {
                    $searchables[] = 'name';
                }
            }

            if (!empty($searchables)) {
                $query->where(function ($q) use ($searchables, $searchTerm) {
                    foreach ($searchables as $field) {
                        if (is_array($field) && isset($field['column'])) {
                            $field = $field['column'];
                        }
                        $q->orWhere($field, 'like', '%' . $searchTerm . '%');
                    }
                });
            }

            $config['searchTerm'] = $searchTerm;
        } else {
            $config['searchTerm'] = null;
        }

        // Get paginated result
        $perPage = $params['perPage']
            ?? $userListSettings['perPage']
            ?? $config['defaultPerPage']
            ?? 25;
        $config['perPage'] = $perPage;

        $page = request()->input('page') ?? 1;

        $items = $query->paginate($perPage, ['*'], 'page', $page);

        // If page is out of bounds (e.g. after deletion), fallback to last available page
        if ($items->lastPage() < $items->currentPage() && $items->lastPage() > 0) {
            $items = $query->paginate($perPage, ['*'], 'page', $items->lastPage());
        }

        $config['page'] = $items->currentPage();

        // Update users config
        $userListSettings['perPage'] = $config['perPage'];

        if (!$trashed) {
            $userListSettings['orderBy'] = $config['orderBy'];
            $userListSettings['orderDirection'] = $config['orderDirection'];
        }

        $userSettings['list-settings'][$config['key']] = $userListSettings;
        $user->settings = $userSettings;
        $user->save();

        // Add meta
        $config['meta'] = [
            'total' => $items->total(),
            'perPage' => $items->perPage(),
            'currentPage' => $items->currentPage(),
            'lastPage' => $items->lastPage(),
            'from' => $items->firstItem(),
            'to' => $items->lastItem(),
            'totalCount' => $modelClass::count(),
        ];

        if (!empty($config['hasSoftDelete'])) {
            $config['meta']['trashCount'] = $modelClass::onlyTrashed()->count();
        }

        return [
            'config' => $config,
            'items' => $items,
            'texts' => trans('admin::list'),
        ];
    }

    /**
     * Get the list view
     */
    public static function getView(string $key)
    {
        $listData = self::getData($key);

        return view('admin::pages.list', [
            'key' => $key,
            'listData' => $listData,
        ]);
    }
}
