<?php

return [

    /*
    |--------------------------------------------------------------------------
    | CMS Branding
    |--------------------------------------------------------------------------
    |
    | This controls branding used in the admin panel.
    |
    */

    'name' => env('CMS_NAME', 'laraCMS'),
    'logo' => env('CMS_LOGO', '/admin/logo.svg'),

    /*
    |--------------------------------------------------------------------------
    | Theme Configuration
    |--------------------------------------------------------------------------
    |
    | Controls which frontend theme is active and where views are loaded from.
    |
    */

    'theme' => [
        'active' => env('CMS_THEME', 'laracms'),
    ],
];
