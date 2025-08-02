<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
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

    /**
     * Save form data
     */
    public static function saveForm(string $key, array $values)
    {
        sleep(1);

        $config = self::getConfig($key);
        if (!$config || empty($config['model'])) {
            return [
                'success' => false,
                'error' => 'Invalid form key',
            ];
        }

        $modelClass = '\\App\\Models\\' . $config['model'];
        if (!class_exists($modelClass)) {
            return [
                'success' => false,
                'error' => 'Invalid form key',
            ];
        }

        $formFields = $config['form'] ?? [];

        $rules = [];
        foreach ($formFields as $field) {
            $source = $field['source'] ?? null;
            $validate = $field['validate'] ?? [];

            if (!$source || empty($validate)) continue;

            $rules[$source] = implode('|', $validate);
        }

        $validationMessages = self::getValidationMessages();

        $validator = Validator::make($values, $rules, $validationMessages);

        if ($validator->fails()) {
            return [
                'success' => false,
                'error' => __('admin::form.errors.validation'),
                'inputErrors' => $validator->errors()->toArray(),
            ];
        }

        $id = $values['id'] ?? null;
        $model = $id ? $modelClass::find($id) : new $modelClass();

        if (!$model) {
            return [
                'success' => false,
                'error' => 'Record not found', // TODO
            ];
        }

        foreach ($formFields as $field) {
            $source = $field['source'] ?? null;
            if (!$source) continue;

            $value = $values[$source] ?? null;

            if (isset($values[$source])) {
                if (str_contains($source, '.')) {
                    [$attr, $key] = explode('.', $source, 2);
                    $nested = $model->$attr ?? [];
                    $nested[$key] = $value;
                    $model->$attr = $nested;
                } else {
                    $model->$source = $value;
                }
            }
        }

        $model->save();

        return [
            'success' => true,
            'item' => $model,
        ];
    }

    /**
     * Get validation messages
     */
    private static function getValidationMessages()
    {
        $ids = [
            'required',
            'email',
            'min',
            'max',
        ];

        $messages = [];

        foreach ($ids as $id) {
            $messages[$id] = __('admin::form.validation.' . $id);
        }

        return $messages;
    }
}
