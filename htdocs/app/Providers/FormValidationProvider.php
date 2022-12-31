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

        foreach ($inputs as $input) {
            $validateInput = [];

            if (!empty($input['required'])) {
                $validateInput[] = 'required';
            }

            if (!empty($input['validate'])) {
                $validateInput = array_merge($validateInput, $input['validate']);
            }

            if (!empty($validateInput)) {
                $validate[$input['name']] = $validateInput;
            }
        }

        request()->validate($validate);
    }
}
