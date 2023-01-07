<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Providers\BackendLanguageProvider;

class BackendController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        // Initialize backend language
        BackendLanguageProvider::initBackendLanguage();

        // Expose translations to use with JavaScript
        BackendLanguageProvider::exposeTranslationsToJavaScript(config('backend.translations_js'));
    }

    /**
     * Show login page
     */

    public function login()
    {
        if (Auth::check()) {
            return redirect('/admin');
        }

        $form = [
            'name' => 'login',
            'requestUrl' => '/admin/login',
            'submitButtonText' => __('backend/auth.login-submit-button-text'),
            'keepDisabledOnSuccess' => true,

            // Input elements
            'inputs' => [
                // Admin user: Email address
                [
                    'name' => 'email',
                    'type' => 'textfield',
                    'inputType' => 'text',
                    'label' => null,
                    'description' => null,
                    'required' => false,
                    'validate' => null,
                    'validateText' => null,
                    'maxlength' => '255',
                    'spellcheck' => false,
                    'placeholder' => __('backend/auth.login-email-placeholder'),
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
                    'placeholder' => __('backend/auth.login-password-placeholder'),
                    'autocomplete' => 'current-password',
                    'submitOnEnter' => true,
                    'showPasswordButton' => true
                ],
            ]
        ];

        return view('backend/login', [
            'form' =>  $form
        ]);
    }

    /**
     * Login via request
     */

    public function loginRequest(Request $request)
    {
        // Mock user password
        // $user = User::find(1);
        // $user->password = Hash::make('test123');
        // $user->save();

        $userData = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'active' => 1
        ];

        if (Auth::attempt($userData, true)) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'error' => __('backend/auth.wrong-password-or-email')
            ]);
        }
    }

    /**
     * Logout
     */

    public function logout()
    {
        Auth::logout();
        return redirect('/admin');
    }
}
