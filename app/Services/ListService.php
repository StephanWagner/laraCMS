<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class ListService
{
    public static function getList(string $key)
    {
        $settingKey = 'list_settings.' . $key;
        $raw = DB::table('settings')->where('key', $settingKey)->value('value');

        if (!$raw) return null;

        $config = json_decode($raw, true);

        $modelClass = self::getModelClassForKey($key);
        if (!class_exists($modelClass)) return null;

        $query = $modelClass::query();

        // Apply ordering
        $orderBy = $config['defaultOrderBy'] ?? 'id';
        $direction = $config['defaultOrderDirection'] ?? 'desc';

        $query->orderBy($orderBy, $direction);

        // Get paginated result
        $perPage = $config['defaultPerPage'] ?? 20;
        $items = $query->paginate($perPage);

        return [
            'config' => $config,
            'items' => $items,
        ];
    }

    protected function getModelClassForKey($key)
    {
        return match ($key) {
            'content_types' => \App\Models\ContentType::class,
            'users' => \App\Models\User::class,
            default => null,
        };
    }
}

