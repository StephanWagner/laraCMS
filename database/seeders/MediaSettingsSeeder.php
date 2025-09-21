<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MediaSettingsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('settings')->insert([
            // Folder structure (none, date, hash)
            [
                'key'   => 'media.folder-structure',
                'value' => 'date',
            ],

            // Image versions
            [
                'key'   => 'media.image-versions',
                'value' => collect([
                    [
                        'id'     => 'large',
                        'width'  => 2400,
                        'height' => 2400,
                    ],
                    [
                        'id'     => 'medium',
                        'width'  => 1200,
                        'height' => 1200,
                    ],
                    [
                        'id'     => 'small',
                        'width'  => 600,
                        'height' => 600,
                    ],
                    [
                        'id'     => 'thumb',
                        'width'  => 300,
                        'height' => 300,
                    ],
                ])->toJson(),
            ],

            // Convert images to WebP
            [
                'key'   => 'media.convert-to-webp',
                'value' => '1',
            ],

            // WebP quality
            [
                'key'   => 'media.image-quality',
                'value' => '85',
            ],
        ]);
    }
}
