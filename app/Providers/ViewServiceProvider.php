<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ContentType;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('admin::*', function ($view) {
            $view->with('contentTypes', ContentType::orderBy('order')->get());
        });
    }
}
