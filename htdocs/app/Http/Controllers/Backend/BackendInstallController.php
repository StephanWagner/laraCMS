<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController;
use Illuminate\Support\Facades\Cache;
use App\Providers\FormValidationProvider;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings;

class BackendInstallController extends BackendController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Generate language options for install form
     */

    private function languageOptions()
    {
        $languages = config('backend.languages');
        $languageOptions = [];
        foreach ($languages as $language) {
            $languageOptions[] = [
                'value' => $language['id'],
                'text' => $language['name'],
                'selected' => $language['id'] == app()->getLocale()
            ];
        }

        return $languageOptions;
    }

    /**
     * Install form data
     */

    private function formData()
    {
        $form = [
            'name' => 'install',
            'requestUrl' => '/admin/install',
            'submitButtonText' => __('backend/page-install.submit-button-text'),
            'keepDisabledOnSuccess' => true,

            // Input elements
            'inputs' => [
                // Language
                [
                    'name' => 'language',
                    'type' => 'select',
                    'label' => __('backend/page-install.textfield-language-label'),
                    'description' => null,
                    'required' => true,
                    'html' => true,
                    'multiple' => false,
                    'rows' => null,
                    'search' => null,
                    'minimumOptionsForSearch' => null,
                    'searchPlaceholder' => null,

                    // TODO 'placeholder' (no multiple) => 'TODO',

                    'options' => $this->languageOptions()
                ],
                // Site title
                [
                    'name' => 'site-title',
                    'type' => 'textfield',
                    'inputType' => 'text',
                    'label' => __('backend/page-install.textfield-site-title-label'),
                    'description' => __('backend/page-install.textfield-site-title-description'),
                    'required' => true,
                    'validate' => ['max:100'],
                    'maxlength' => '100',
                    'spellcheck' => false,
                    'placeholder' => __('backend/page-install.textfield-site-title-placeholder'),
                    'autocomplete' => false,
                    'submitOnEnter' => true
                ],
                // Admin user: Name
                [
                    'name' => 'name',
                    'type' => 'textfield',
                    'inputType' => 'text',
                    'label' => __('backend/page-install.textfields-admin-user-label'),
                    'description' => __('backend/page-install.textfields-admin-user-description'),
                    'required' => true,
                    'validate' => ['max:50'],
                    'maxlength' => '50',
                    'spellcheck' => false,
                    'placeholder' => __('backend/page-install.textfields-admin-user-name-placeholder'),
                    'autocomplete' => 'name',
                    'submitOnEnter' => true
                ],
                // Admin user: Email address
                [
                    'name' => 'email',
                    'type' => 'textfield',
                    'inputType' => 'text',
                    'label' => null,
                    'description' => null,
                    'required' => true,
                    'validate' => ['email', 'unique:users', 'max:255'],
                    'validateText' => ['unique' => __('backend/form.email-is-registered')],
                    'maxlength' => '255',
                    'spellcheck' => false,
                    'placeholder' => __('backend/page-install.textfields-admin-user-email-placeholder'),
                    'autocomplete' => 'email',
                    'submitOnEnter' => true
                ],
                // Admin user: Password
                [
                    'name' => 'password',
                    'type' => 'password',
                    'label' => null,
                    'description' => null,
                    'required' => true,
                    'validate' => ['min:6', 'max:64'],
                    'maxlength' => '64',
                    'placeholder' => __('backend/page-install.textfields-admin-user-password-placeholder'),
                    'autocomplete' => 'current-password',
                    'submitOnEnter' => true,
                    'showPasswordButton' => true
                ],
            ]
        ];
        return $form;
    }

    /**
     * Show install page
     */

    public function show()
    {
        // Abort if laraCMS is already installed
        $isInstalled = \App\Models\Settings::where('name', 'is-installed')->count() > 0;

        if (Cache::get('is-installed') || $isInstalled) {
            Cache::put('is-installed', true);
            return redirect('/admin');
        }

        return view('backend/install', [
            'form' => $this->formData()
        ]);
    }

    /**
     * Install request
     */

    public function installRequest(Request $request)
    {
        // Validate
        FormValidationProvider::validateForm($this->formData()['inputs']);

        // Add user
        $user = User::create($request->all());
        $user->role = 'admin';
        $user->active = 1;
        $user->save();

        // Mark laraCMS as installed
        Settings::create([
            'name' => 'is-installed',
            'value' => 1
        ]);
        Cache::put('is-installed', true);

        // Response success
        return response()->json([
            'success' => true
        ]);
    }
}
