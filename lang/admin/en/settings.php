<?php
return [
    'ignoreWarning' => 'Ignore warning',
    'resetIgnoreWarnings' => 'Reset ignored warnings',
    'developer' => [
        'system' => [
            'title' => 'System',
            'sections' => [
                'laravel' => [
                    'title' => 'Laravel',
                    'items' => [
                        'laravel_version' => 'Version',
                        'laravel_env' => 'Environment',
                        'laravel_debug' => 'Debug Mode',
                    ],
                    'warnings' => [
                        'laravel_debug' => 'Debug mode is enabled in production environment. This can expose sensitive information.',
                    ],
                ],
                'php' => [
                    'title' => 'PHP',
                    'phpinfo' => 'PHP Info',
                    'items' => [
                        'phpVersion' => 'Version',
                        'memoryLimit' => 'Memory Limit',
                        'uploadMaxFilesize' => 'Max Upload Filesize',
                        'postMaxSize' => 'Max POST Size',
                        'maxExecutionTime' => 'Max Execution Time',
                        'maxInputTime' => 'Max Input Time',
                        'gd' => 'GD Extension',
                        'imagick' => 'Imagick Extension',
                    ],
                    'warnings' => [
                        'phpVersion' => 'This Laravel installation requires PHP :value or higher.',
                        'memoryLimit' => 'Recommended minimum: :value',
                        'uploadMaxFilesize' => 'Recommended minimum: :value',
                        'postMaxSize' => 'Recommended minimum: :value',
                        'maxExecutionTime' => 'Recommended minimum: :value',
                        'gd' => 'Neither GD nor <a href="https://www.php.net/manual/en/book.imagick.php" target="_blank"><span class="icon -small-text-icon">open_in_new</span> Imagick</a> are installed. Image processing will not work. Please enable at least one – Imagick is strongly recommended.',
                        'imagick' => 'PHP extension <a href="https://www.php.net/manual/en/book.imagick.php" target="_blank"><span class="icon -small-text-icon">open_in_new</span> Imagick</a> is required to enable full media support.',
                    ],
                ],
                'disk' => [
                    'title' => 'Disk',
                    'items' => [
                        'diskFree' => 'Free',
                        'diskTotal' => 'Total',
                    ],
                ],
                'time' => [
                    'title' => 'Time',
                    'items' => [
                        'timezone' => 'Timezone',
                    ],
                ],
            ],
        ],
        'media' => [
            'title' => 'Media',
            'items' => [],
        ],
        'mail' => [
            'title' => 'Mail',
            'items' => [],
        ],
        'localization' => [
            'title' => 'Localization',
            'items' => [],
        ],
    ],
];
