<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CmsSettingsSeeder::class,
            MediaSettingsSeeder::class,
            ListSettingsSeeder::class,
            FormSettingsSeeder::class,
            ContentTypeSeeder::class,
        ]);
    }
}
