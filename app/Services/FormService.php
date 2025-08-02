<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\ContentType;

class FormService
{
    /**
     * Get the form config
     */
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

    /**
     * Get the form data
     */
    public static function getData(string $key, ?int $id = null, array $params = [])
    {
        $config = self::getConfig($key);

        if (!$config) return null;

        if (!empty($config['listRoute'])) $config['listUri'] = route($config['listRoute']);
        if (!empty($config['formRoute'])) $config['formUri'] = route($config['formRoute'], ['id' => '__ID__']);

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

    /**
     * Get the form view
     */
    public static function getView(string $key, ?int $id = null)
    {
        $formData = self::getData($key, $id);

        return view('admin::pages.form', [
            'key' => $key,
            'formData' => $formData,
        ]);
    }
}
