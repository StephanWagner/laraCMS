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

        // View::share('readableTime', function ($datetime) {
        // 	return $this->getReadableTime($datetime);
        // });

        BackendLanguageProvider::resetBackendLanguage();


        // if (!session('language')) {

        //     if (Auth::check()) {
        //         $languageId = Auth::get('language');
        //     } else if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        //         $languageStr = locale_accept_from_http($_SERVER['HTTP_ACCEPT_LANGUAGE']);

        //         if (!empty($languageStr)) {
        //             $languageId = substr($languageStr, 0, 2);
        //         } else {
        //             $languageId = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        //         }
        //     }

        //     $languages = config('backend.languages');
        //     if (!empty($languageId) && !empty($languages[$languageId]['id'])) {
        //         $language = $languages[$languageId]['id'];
        //     }

        //     if (empty($language)) {
        //         $language = config('backend.fallback_locale');
        //     }

        //     session('language', $language);

        //     // TODO delete session when logging out
        // }

        $language = BackendLanguageProvider::getBackendLanguage();

        echo '|';
        print_r($language);
        echo '|';
    }

    // Login

    function login()
    {
        if (Auth::check()) {
            return redirect('/admin');
        }

        return view('backend/login');
    }

    // Login via request

    function loginRequest(Request $request)
    {
        // Mock data
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

    // Logout

    function logout()
    {
        Auth::logout();
        return redirect('/admin');
    }
}
