<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController;
use Illuminate\Support\Facades\Cache;
use App\Providers\FormValidationProvider;
use Illuminate\Http\Request;

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
            'requestUrl' => '/admin/installRequest',
            'submitButtonText' => __('backend/page-install.submit-button-text'),
            'keepDisabledOnSuccess' => true,

            // Input elements
            'inputs' => [
                // Language
                [
                    'name' => 'language',
                    'type' => 'select',
                    'label' => __('backend/page-install.textfield-language-label'),
                    'decription' => null,
                    'required' => true,
                    'html' => true,
                    'multiple' => false,
                    'hasSearch' => false,
                    'minimumOptionsForSearch' => 5,
                    // TODO 'placeholder' => 'TODO',
                    // TODO 'clear' => '',
                    'options' => $this->languageOptions()
                ],
                // Site title
                [
                    'name' => 'site-title',
                    'type' => 'textfield',
                    'inputType' => 'text',
                    'label' => __('backend/page-install.textfield-site-title-label'),
                    'decription' => null,
                    'required' => true,
                    'placeholder' => __('backend/page-install.textfield-site-title-placeholder'),
                    'autocomplete' => false,
                    'submitOnEnter' => true
                ],
                // Admin user: Email address
                [
                    'name' => 'email',
                    'type' => 'textfield',
                    'inputType' => 'email',
                    'label' => __('backend/page-install.textfields-admin-user-label'),
                    'decription' => null,
                    'required' => true,
                    'validate' => ['email'],
                    'placeholder' => __('backend/page-install.textfields-admin-user-email-placeholder'),
                    'autocomplete' => 'email',
                    'submitOnEnter' => true
                ],
                // Admin user: Password
                [
                    'name' => 'password',
                    'type' => 'password',
                    'label' => null,
                    'decription' => null,
                    'required' => true,
                    'validate' => ['min:8', 'max:32'],
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

    public function installRequest()
    {
        sleep(1);

        // Validate
        FormValidationProvider::validateForm($this->formData()['inputs']);

        // TODO add user and options and send success

        return response()->json([
            'success' => false
        ]);
    }
}
