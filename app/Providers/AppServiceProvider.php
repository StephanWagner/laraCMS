<?php

namespace App\Providers;


use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use App\Helpers\AssetHelper;
use App\Services\Settings;

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
        // Settings
        Config::set('cms.theme', app(Settings::class)->get('cms.theme', 'laracms'));
        Config::set('cms.name', app(Settings::class)->get('cms.name', 'laraCMS'));

        // View namespaces
        View::addNamespace('admin', resource_path('admin/views'));
        View::addNamespace('theme', resource_path('themes/' . config('cms.theme') . '/views'));

        // Language namespaces
        $this->loadTranslationsFrom(base_path('lang/admin'), 'admin');
        $this->loadTranslationsFrom(resource_path('themes/' . config('cms.theme') . '/lang'), 'theme');

        // Current active theme
        View::share('theme', config('cms.theme'));

        // Helpers
        View::share('assetHelper', AssetHelper::class);

        // Validator rules
        $this->registerCustomValidationRules();
    }

    /**
     * Custom validators
     */
    protected function registerCustomValidationRules(): void
    {
        Validator::extend('securePassword', function ($attribute, $value) {
            $data = [$attribute => $value];
            $rules = [$attribute => Password::default()->uncompromised()];
            return Validator::make($data, $rules)->passes();
        }, __('admin::form.validation.securePassword'));
    }
}
