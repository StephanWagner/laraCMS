<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class BackendLanguageProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    /**
     * Set backend language
     */

    static function setBackendLanguage($languageId)
    {
        $languages = config('backend.languages');
        if (!empty($languages[$languageId])) {
            App::setLocale($languageId);
            session('backendLanguage', $languageId);
            return true;
        }

        return false;
    }

    /**
     * Get backend language
     */

    static function getBackendLanguage()
    {
        if (session('backendLanguage')) {
            return session('backendLanguage');
        }

        if (Auth::check()) {
            $languageId = Auth::get('language');
        } else if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $languageStr = locale_accept_from_http($_SERVER['HTTP_ACCEPT_LANGUAGE']);

            if (!empty($languageStr)) {
                $language = substr($languageStr, 0, 2);
            } else {
                $language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
            }
        }

        $languages = config('backend.languages');
        if (!empty($language) && !empty($languages[$language])) {
            $languageId = $language;
        }

        if (empty($languageId)) {
            $languageId = config('backend.fallback_locale');
        }

        self::setBackendLanguage($languageId);

        return $languageId;
    }

    /**
     * Reset backend language
     */

    static function resetBackendLanguage()
    {
        session()->forget('backendLanguage');
    }
}
