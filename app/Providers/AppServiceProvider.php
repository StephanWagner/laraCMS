<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Helpers\AssetHelper;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // View namespaces
        View::addNamespace('admin', resource_path('admin/views'));
        View::addNamespace('theme', resource_path('themes/' . config('cms.theme.active') . '/views'));

        // Language namespaces
        $this->loadTranslationsFrom(base_path('lang/admin'), 'admin');

        // Current active theme
        View::share('theme', config('cms.theme.active'));

        // Helpers
        View::share('assetHelper', AssetHelper::class);

        // Debugging
        // app()->setLocale('de');
    }
}
