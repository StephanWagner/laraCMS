<?php
return [
    'ignoreWarning' => 'Warnung ignorieren',
    'resetIgnoreWarnings' => 'Ignorierte Warnungen zurücksetzen',
    'developer' => [
        'system' => [
            'title' => 'System',
            'sections' => [
                'laravel' => [
                    'title' => 'Laravel',
                    'items' => [
                        'laravelVersion' => 'Version',
                        'laravelEnv' => 'Umgebung',
                        'laravelDebug' => 'Debug-Modus',
                    ],
                    'warnings' => [
                        'laravelDebug' => 'Debug-Modus ist in der Produktionsumgebung aktiviert. Dies kann sensible Informationen offenlegen.',
                    ],
                ],
                'php' => [
                    'title' => 'PHP',
                    'phpinfo' => 'PHP-Info',
                    'items' => [
                        'phpVersion' => 'Version',
                        'memoryLimit' => 'Speicherlimit',
                        'uploadMaxFilesize' => 'Maximale Upload-Dateigröße',
                        'postMaxSize' => 'Maximale POST-Größe',
                        'maxExecutionTime' => 'Maximale Ausführungszeit',
                        'gd' => 'GD-Erweiterung',
                        'imagick' => 'Imagick-Erweiterung',
                    ],
                    'warnings' => [
                        'phpVersion' => 'Diese Laravel-Installation benötigt PHP :value oder höher.',
                        'memoryLimit' => 'Empfohlener Mindestwert: :value',
                        'uploadMaxFilesize' => 'Empfohlener Mindestwert: :value',
                        'postMaxSize' => 'Empfohlener Mindestwert: :value',
                        'maxExecutionTime' => 'Empfohlener Mindestwert: :value',
                        'gd' => 'Weder GD noch <a href="https://www.php.net/manual/de/book.imagick.php" target="_blank"><span class="icon -small-text-icon">open_in_new</span> Imagick</a> sind installiert. Die Bildverarbeitung funktioniert nicht. Bitte mindestens eine dieser Erweiterungen aktivieren – Imagick wird sehr empfohlen.',
                        'imagick' => 'Die PHP-Erweiterung <a href="https://www.php.net/manual/de/book.imagick.php" target="_blank"><span class="icon -small-text-icon">open_in_new</span> Imagick</a> ist erforderlich, um volle Medienunterstützung zu aktivieren.',
                    ],
                ],
                'disk' => [
                    'title' => 'Speicher',
                    'items' => [
                        'diskFree' => 'Frei',
                        'diskTotal' => 'Gesamt',
                    ],
                ],
                'time' => [
                    'title' => 'Zeit',
                    'items' => [
                        'timezone' => 'Zeitzone',
                    ],
                ],
            ],
        ],
        'media' => [
            'title' => 'Medien',
            'items' => [],
        ],
        'mail' => [
            'title' => 'E-Mail',
            'items' => [],
        ],
        'localization' => [
            'title' => 'Lokalisierung',
            'items' => [],
        ],
    ],
];
