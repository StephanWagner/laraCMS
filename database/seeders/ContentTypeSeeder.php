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
                    'defaultActive' => 0,
                    'form' => [
                        'model' => 'Content',
                        'titleNew' => 'admin::content.page.form.titleNew',
                        'titleEdit' => 'admin::content.page.form.titleEdit',
                        'listRoute' => 'admin.content.list',
                        'editRoute' => 'admin.content.edit',
                        'texts' => 'content.page.form',
                        'form' => [
                            [
                                'type' => 'input',
                                'position' => 'form',
                                'label' => 'items.title.label',
                                'validate' => ['required', 'max:255'],
                                'source' => 'title',
                                'inputOptions' => [
                                    'type' => 'textfield',
                                    'size' => 'large',
                                    'id' => 'content-title',
                                    'name' => 'title',
                                    'required' => true,
                                    'maxlength' => 255,
                                    'autocomplete' => 'off',
                                ],
                            ],
                            // TODO sidebar with slug, active, publish_date
                            [
                                'type' => 'blocks',
                                'position' => 'form',
                                // TODO 'allowedBlocks'
                                // TODO 'disabledBlocks'
                            ],
                        ],
                    ],
                    'list' => [
                        'model' => 'Content',
                        'title' => 'admin::content.page.list.title',
                        'listRoute' => 'admin.content.list',
                        'editRoute' => 'admin.content.edit',
                        'defaultOrderBy' => 'updated_at',
                        'defaultOrderDirection' => 'desc',
                        'defaultPerPage' => 25,
                        'hasMultiSelect' => [
                            'activate',
                            'deactivate',
                            'delete',
                        ],
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
                    'defaultActive' => 0,
                    'form' => [
                        'model' => 'Content',
                        'titleNew' => 'admin::content.blog.form.titleNew',
                        'titleEdit' => 'admin::content.blog.form.titleEdit',
                        'listRoute' => 'admin.content.list',
                        'editRoute' => 'admin.content.edit',
                        'texts' => 'content.blog.form',
                        'form' => [
                            [
                                'type' => 'input',
                                'position' => 'form',
                                'label' => 'items.title.label',
                                'validate' => ['required', 'max:255'],
                                'source' => 'title',
                                'inputOptions' => [
                                    'type' => 'textfield',
                                    'size' => 'large',
                                    'id' => 'content-title',
                                    'name' => 'title',
                                    'required' => true,
                                    'maxlength' => 255,
                                    'autocomplete' => 'off',
                                ],
                            ],
                            // TODO sidebar with slug, active, publish_date
                            [
                                'type' => 'blocks',
                                'position' => 'form',
                                // TODO 'allowedBlocks'
                                // TODO 'disabledBlocks'
                            ],
                        ],
                    ],
                    'list' => [
                        'model' => 'Content',
                        'title' => 'admin::content.blog.list.title',
                        'listRoute' => 'admin.content.list',
                        'editRoute' => 'admin.content.edit',
                        'defaultOrderBy' => 'updated_at',
                        'defaultOrderDirection' => 'desc',
                        'defaultPerPage' => 25,
                        'hasMultiSelect' => [
                            'activate',
                            'deactivate',
                            'delete',
                        ],
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
        ];

        foreach ($types as $type) {
            DB::table('content_types')->updateOrInsert(
                ['key' => $type['key']],
                $type
            );
        }
    }
}
