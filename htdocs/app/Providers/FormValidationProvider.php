<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FormValidationProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    /**
     * Validate form data
     */

    static function validateForm($inputs)
    {
        $validate = [];
        $validateTexts = [];

        foreach ($inputs as $input) {
            $validateInput = [];

            if (!empty($input['required'])) {
                $validateInput[] = 'required';
            }

            if (!empty($input['validate'])) {
                $validateInput = array_merge($validateInput, $input['validate']);
            }

            if (!empty($input['validateText'])) {
                $validateTexts = array_merge($validateTexts, $input['validateText']);
            }

            if (!empty($validateInput)) {
                $validate[$input['name']] = $validateInput;
            }
        }

        request()->validate($validate, $validateTexts);
    }
}
