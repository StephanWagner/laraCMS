<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentTypeSeeder extends Seeder
{
    public function run()
    {
        $now = now();

        $developer = \App\Models\User::where('role', 'developer')->orderBy('id')->first();
        $developerId = $developer?->id ?? null;

        $types = [
            [
                'key' => 'page',
                'name' => 'Pages',
                'order' => 1,
                'settings' => json_encode([
                    'uri' => '/{slug}',
                    'icon' => 'description',
                    'listable' => false,
                    'default_status' => 'published',
                ]),
                'created_by' => $developerId,
                'updated_by' => $developerId,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'blog',
                'name' => 'Blogs',
                'order' => 2,
                'settings' => json_encode([
                    'uri' => '/{key}/{id}-{slug}',
                    'icon' => 'note_stack',
                    'listable' => true,
                    'default_status' => 'draft',
                ]),
                'created_by' => $developerId,
                'updated_by' => $developerId,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        foreach ($types as $type) {
            DB::table('content_types')->updateOrInsert(
                ['key' => $type['key']],
                $type
            );
        }
    }
}
