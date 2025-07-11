<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ListSettingsSeeder extends Seeder
{
    public function run()
    {
        DB::table('settings')->insertOrIgnore([
            [
                'key' => 'list-settings.content-types',
                'value' => collect([
                    'model' => 'ContentType',
                    'listRoute' => '/admin/content-types',
                    'editRoute' => '/admin/content-types/edit/{id}',
                    'defaultOrderBy' => 'order',
                    'defaultOrderDirection' => 'asc',
                    'defaultPerPage' => 25,
                    'hasMultiSelect' => false,
                    'hasSoftDelete' => true,
                    'searchables' => [
                        ['column' => 'name'],
                    ],
                    'columns' => [
                        [
                            'key' => 'order',
                            'type' => 'sortable',
                            'label' => null,
                            'source' => 'order',
                            'sortable' => true,
                            'defaultOrderDirection' => 'asc',
                        ],
                        [
                            'key' => 'icon',
                            'type' => 'icon',
                            'label' => null,
                            'source' => 'settings.icon',
                            'sortable' => false,
                        ],
                        [
                            'key' => 'title',
                            'type' => 'title',
                            'label' => 'Title',
                            'source' => 'name',
                            'sortable' => true,
                            'defaultOrderDirection' => 'asc',
                        ],
                        [
                            'key' => 'created-by',
                            'type' => 'username',
                            'label' => 'Created By',
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
                        ],
                        [
                            'key' => 'updated-at',
                            'type' => 'datetime',
                            'relativeDatetime' => true,
                            'source' => 'updated_at',
                            'label' => 'Updated',
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
                                'delete',
                                [
                                    'type' => 'more',
                                    'options' => [
                                        'moveToTop',
                                        'moveToBottom',
                                    ]
                                ]
                            ]
                        ],
                    ],
                ])->toJson(),
            ],
            [
                'key' => 'list-settings.users',
                'value' => collect([
                    'model' => 'User',
                    'listRoute' => '/admin/users',
                    'editRoute' => '/admin/users/edit/{id}',
                    'defaultOrderBy' => 'name',
                    'defaultOrderDirection' => 'asc',
                    'defaultPerPage' => 25,
                    'hasMultiSelect' => true,
                    'hasSoftDelete' => true,
                    'searchables' => [
                        ['column' => 'name'],
                        ['column' => 'email'],
                        ['column' => 'role'],
                    ],
                    'columns' => [
                        [
                            'key' => 'multiselect',
                            'type' => 'multiselect',
                            'label' => null,
                        ],
                        [
                            'key' => 'title',
                            'type' => 'title',
                            'label' => 'Name',
                            'source' => 'name',
                            'sortable' => true,
                            'defaultOrderDirection' => 'asc',
                        ],
                        [
                            'key' => 'email',
                            'type' => 'email',
                            'label' => 'Email',
                            'source' => 'email',
                            'sortable' => true,
                            'defaultOrderDirection' => 'asc',
                            'visibility' => [
                                'xl' => true,
                                'lg' => false,
                                'md' => false,
                                'sm' => false,
                                'xs' => false,
                            ],
                        ],
                        [
                            'key' => 'role',
                            'type' => 'badge',
                            'label' => 'Role',
                            'source' => 'role',
                            'config' => [
                                'map' => [
                                    'developer' => [
                                        'text' => 'Developer',
                                    ],
                                    'admin' => [
                                        'text' => 'Admin',
                                    ],
                                    'editor' => [
                                        'text' => 'Editor',
                                    ],
                                ],
                            ],
                            'sortable' => true,
                            'defaultOrderDirection' => 'asc',
                            'visibility' => [
                                'xl' => true,
                                'lg' => true,
                                'md' => true,
                                'sm' => false,
                                'xs' => false,
                            ],
                        ],
                        [
                            'key' => 'latest-login',
                            'type' => 'datetime',
                            'relativeDatetime' => true,
                            'label' => 'Latest Activity',
                            'source' => 'last_seen',
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
                                'delete',
                            ],
                        ],
                    ],
                ])->toJson(),
            ],
        ]);
    }
}
