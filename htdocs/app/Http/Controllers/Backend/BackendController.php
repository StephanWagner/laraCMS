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

        return view('backend/login');
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

        $user_data = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'active' => 1
        ];

        if (Auth::attempt($user_data, true)) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'error' => 'Ungültiges Passwort oder E-Mail'
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
