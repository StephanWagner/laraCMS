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
                'settings' => collect([
                    'uri' => '/{slug}',
                    'icon' => 'description',
                    'listable' => false,
                    'default_status' => 'published',
                    'form' => '
                        TODO
                    ',
                    'list' => [
                        'model' => 'Content',
                        'listRoute' => '/admin/content/page',
                        'editRoute' => '/admin/content/page/edit/{id}',
                        'defaultOrderBy' => 'created_at',
                        'defaultOrderDirection' => 'desc',
                        'defaultPerPage' => 25,
                        'hasMultiSelect' => false,
                        'hasSoftDelete' => true,
                        'searchables' => [
                            ['column' => 'title'],
                        ],
                        'columns' => [
                            [
                                'key' => 'title',
                                'type' => 'title',
                                'label' => 'columnLabel.title',
                                'source' => 'title',
                                'sortable' => true,
                                'defaultOrderDirection' => 'asc',
                            ],
                            [
                                'key' => 'created-by',
                                'type' => 'username',
                                'label' => 'columnLabel.created-by',
                                'source' => 'creator.name',
                                'relation' => 'creator',
                                'sortable' => true,
                                'defaultOrderDirection' => 'asc',
                                'visibility' => [
                                    'xl' => true,
                                    'lg' => false,
                                    'md' => false,
                                    'sm' => false,
                                    'xs' => false,
                                ],
                                'allowTrashed' => true,
                            ],
                            [
                                'key' => 'updated-at',
                                'type' => 'datetime',
                                'relativeDatetime' => true,
                                'source' => 'updated_at',
                                'label' => 'columnLabel.updated-at',
                                'sortable' => true,
                                'defaultOrderDirection' => 'desc',
                                'visibility' => [
                                    'xl' => true,
                                    'lg' => true,
                                    'md' => false,
                                    'sm' => false,
                                    'xs' => false,
                                ],
                            ],
                            [
                                'key' => 'actions',
                                'type' => 'actions',
                                'label' => null,
                                'actions' => [
                                    'toggle',
                                    'edit',
                                    'duplicate',
                                    'delete',
                                ]
                            ],
                        ],
                    ]
                ])->toJson(),
                'created_by' => $developerId,
                'updated_by' => $developerId,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'blog',
                'name' => 'Blogs',
                'order' => 2,
                'settings' => collect([
                    'uri' => '/{key}/{id}-{slug}',
                    'icon' => 'note_stack',
                    'listable' => true,
                    'default_status' => 'draft',
                ])->toJson(),
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
