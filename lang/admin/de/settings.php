<?php
return [
    'ignore-warning' => 'Warnung ignorieren',
    'developer' => [
        'system' => [
            'title' => 'System',
            'sections' => [
                'laravel' => [
                    'title' => 'Laravel',
                    'items' => [
                        'laravel_version' => 'Version',
                        'laravel_env' => 'Umgebung',
                        'laravel_debug' => 'Debug-Modus',
                    ],
                    'warnings' => [
                        'laravel_debug' => 'Debug-Modus ist in der Produktionsumgebung aktiviert. Dies kann sensible Informationen offenlegen.',
                    ],
                ],
                'php' => [
                    'title' => 'PHP',
                    'items' => [
                        'php_version' => 'Version',
                        'memory_limit' => 'Speicherlimit<br><span class="monospace">memory_limit</span>',
                        'upload_max_filesize' => 'Maximale Upload-Dateigröße<br><span class="monospace">upload_max_filesize</span>',
                        'post_max_size' => 'Maximale POST-Größe<br><span class="monospace">post_max_size</span>',
                        'max_execution_time' => 'Maximale Ausführungszeit<br><span class="monospace">max_execution_time</span>',
                        'gd' => 'GD-Erweiterung',
                        'imagick' => 'Imagick-Erweiterung',
                    ],
                    'warnings' => [
                        'php_version' => 'Diese Laravel-Installation benötigt PHP :value oder höher.',
                        'memory_limit' => 'Empfohlener Mindestwert: :value',
                        'upload_max_filesize' => 'Empfohlener Mindestwert: :value',
                        'post_max_size' => 'Empfohlener Mindestwert: :value',
                        'max_execution_time' => 'Empfohlener Mindestwert: :value',
                        'gd' => 'Weder GD noch <a href="https://www.php.net/manual/de/book.imagick.php" target="_blank"><span class="icon -small-text-icon">open_in_new</span> Imagick</a> sind installiert. Die Bildverarbeitung funktioniert nicht. Bitte mindestens eine dieser Erweiterungen aktivieren – Imagick wird sehr empfohlen.',
                        'imagick' => 'Die PHP-Erweiterung <a href="https://www.php.net/manual/de/book.imagick.php" target="_blank"><span class="icon -small-text-icon">open_in_new</span> Imagick</a> ist erforderlich, um volle Medienunterstützung zu aktivieren.',
                    ],
                ],
                'disk' => [
                    'title' => 'Speicher',
                    'items' => [
                        'disk_free' => 'Frei',
                        'disk_total' => 'Gesamt',
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
