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
                    'items' => [
                        'php_version' => 'Version',
                        'memory_limit' => 'Memory Limit<br><span class="monospace">memory_limit</span>',
                        'upload_max_filesize' => 'Max Upload Filesize<br><span class="monospace">upload_max_filesize</span>',
                        'post_max_size' => 'Max POST Size<br><span class="monospace">post_max_size</span>',
                        'max_execution_time' => 'Max Execution Time<br><span class="monospace">max_execution_time</span>',
                        'max_input_time' => 'Max Input Time<br><span class="monospace">max_input_time</span>',
                        'gd' => 'GD Extension',
                        'imagick' => 'Imagick Extension',
                    ],
                    'warnings' => [
                        'php_version' => 'This Laravel installation requires PHP :value or higher.',
                        'memory_limit' => 'Recommended minimum: :value',
                        'upload_max_filesize' => 'Recommended minimum: :value',
                        'post_max_size' => 'Recommended minimum: :value',
                        'max_execution_time' => 'Recommended minimum: :value',
                        'gd' => 'Neither GD nor <a href="https://www.php.net/manual/en/book.imagick.php" target="_blank"><span class="icon -small-text-icon">open_in_new</span> Imagick</a> are installed. Image processing will not work. Please enable at least one – Imagick is strongly recommended.',
                        'imagick' => 'PHP extension <a href="https://www.php.net/manual/en/book.imagick.php" target="_blank"><span class="icon -small-text-icon">open_in_new</span> Imagick</a> is required to enable full media support.',
                    ],
                ],
                'disk' => [
                    'title' => 'Disk',
                    'items' => [
                        'disk_free' => 'Free',
                        'disk_total' => 'Total',
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
