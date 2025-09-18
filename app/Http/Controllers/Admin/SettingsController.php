<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function siteInfo()
    {
        return view('admin::pages.settings.site-info');
    }

    public function siteVariables()
    {
        return view('admin::pages.settings.site-variables');
    }

    public function developer()
    {
        $composer = json_decode(file_get_contents(base_path('composer.json')), true);
        $requiredPHP = $composer['require']['php'] ?? null;

        $path = storage_path();
        $free = disk_free_space($path);
        $total = disk_total_space($path);

        $serverInfo = [
            // Laravel
            'laravel_version' => app()->version(),
            'laravel_env' => config('app.env'),
            'laravel_debug' => config('app.debug') ? 1 : 0,
            // PHP
            'php_version' => PHP_VERSION,
            'php_version_suggested' => $this->normalizePhpRequirement($requiredPHP),
            'memory_limit' => ini_get('memory_limit'),
            'memory_limit_suggested' => '512M',
            'upload_max_filesize' => ini_get('upload_max_filesize'),
            'upload_max_filesize_suggested' => '32M',
            'post_max_size' => ini_get('post_max_size'),
            'post_max_size_suggested' => '64M',
            'max_execution_time' => ini_get('max_execution_time'),
            'max_execution_time_suggested' => '30',
            // Extensions
            'gd' => extension_loaded('gd') ? 1 : 0,
            'imagick' => extension_loaded('imagick') ? 1 : 0,
            // Disk
            'disk_free' => $free  !== false ? round($free / 1024 / 1024 / 1024, 2) . ' GB' : __('admin::settings.developer.not-available'),
            'disk_total' => $total !== false ? round($total / 1024 / 1024 / 1024, 2) . ' GB' : __('admin::settings.developer.not-available'),
            // Timezone
            // TODO add ip2location timezones
            'timezone' => config('app.timezone'),
        ];

        return view('admin::pages.settings.developer', compact('serverInfo'));
    }

    /**
     * Normalize the PHP requirement
     * @param string $constraint
     * @return string|null
     */
    private function normalizePhpRequirement(string $constraint): ?string
    {
        // Handle multiple constraints like "^8.2|^9.0"
        $parts = preg_split('/\s*\|\s*/', $constraint);

        if (!$parts) {
            return null;
        }

        // Take the lowest acceptable version (first part)
        $first = $parts[0];

        // Strip non-numeric chars and ensure .0 suffix
        if (preg_match('/(\d+\.\d+)/', $first, $matches)) {
            return $matches[1] . '.0';
        }

        return null;
    }
}
