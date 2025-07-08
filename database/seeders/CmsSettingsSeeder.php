<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CmsSettingsSeeder extends Seeder
{
    public function run()
    {
        DB::table('settings')->insertOrIgnore([
            [
                'key' => 'cms.name',
                'value' => 'laraCMS',
            ],
            [
                'key' => 'cms.theme',
                'value' => 'laracms',
            ],
        ]);
    }
}
