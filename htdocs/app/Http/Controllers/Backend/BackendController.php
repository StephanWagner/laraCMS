<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BackendController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        // View::share('readableTime', function ($datetime) {
        // 	return $this->getReadableTime($datetime);
        // });
    }

    // Install

    function install()
    {
        $isInstalled = \App\Models\Settings::where('name', 'is-installed')->count() > 0;

        if (Cache::get('is-installed') || $isInstalled) {
            Cache::put('is-installed', true);
            return redirect('/admin');
        }

        return view('backend/install');
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
