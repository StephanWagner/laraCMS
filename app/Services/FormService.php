<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\ContentType;

class FormService
{
    public static function getConfig(string $key)
    {
        $settingKey = 'form-settings.' . $key;

        $config = DB::table('settings')->where('key', $settingKey)->value('value');

        if (!$config && $contentType = ContentType::where('key', $key)->first()) {
            $config = $contentType->settings['form'] ?? null;
        }

        if (is_string($config)) {
            $config = json_decode($config, true);
        }

        return $config;
    }

    public static function getData(string $key, ?int $id = null, array $params = [])
    {
        $config = self::getConfig($key);

        if (!$config) return null;

        $config['key'] = $key;

        $modelClassName = $config['model'] ?? null;
        $modelClass = 'App\\Models\\' . $modelClassName;

        if (!class_exists($modelClass)) {
            return null;
        }

        if (!is_subclass_of($modelClass, \Illuminate\Database\Eloquent\Model::class)) {
            return null;
        }

        if ($id) {
            $item = $modelClass::where('id', $id)->first();
        }

        $texts = !empty($config['texts']) ? trans('admin::' . $config['texts']) : null;

        return [
            'config' => $config,
            'item' => $item ?? null,
            'texts' => $texts,
        ];
    }
}
