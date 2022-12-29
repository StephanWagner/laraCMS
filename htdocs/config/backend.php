<?php

use Illuminate\Support\Facades\Facade;

return [
    /**
     * Available languages
     */

    'languages' => [

        // English
        'en' => [
            'id' => 'en',
            'name' => 'English',
            'nameEn' => 'English'
        ],

        // Spanish
        'es' => [
            'id' => 'es',
            'name' => 'Español',
            'nameEn' => 'Spanish'
        ],

        // French
        'fr' => [
            'id' => 'fr',
            'name' => 'Français',
            'nameEn' => 'French'
        ],

        // German
        'de' => [
            'id' => 'de',
            'name' => 'Deutsch',
            'nameEn' => 'German'
        ],

        // Italian
        'it' => [
            'id' => 'it',
            'name' => 'Italiano',
            'nameEn' => 'Italian'
        ]
    ],

    /**
     * Fallback language
     */

    'fallback_locale' => 'de',
];
