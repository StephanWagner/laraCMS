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
                    'title' => 'admin::contentTypes.list.title',
                    'listRoute' => 'admin.content-types.list',
                    'editRoute' => 'admin.content-types.edit',
                    'defaultOrderBy' => 'order',
                    'defaultOrderDirection' => 'asc',
                    'defaultPerPage' => 25,
                    'hasMultiSelect' => false,
                    'hasSoftDelete' => true,
                    'searchables' => [
                        [
                            'column' => 'name'
                        ],
                    ],
                    'duplicate' => [
                        'uniqueColumns' => [
                            [
                                'column' => 'key'
                            ],
                        ],
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
                            'allowTrashed' => true,
                        ],
                        [
                            'key' => 'title',
                            'type' => 'title',
                            'label' => 'columnLabel.name',
                            'source' => 'name',
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
                                'reorder',
                                'delete'
                            ]
                        ],
                    ],
                ])->toJson(),
            ],
            [
                'key' => 'list-settings.users',
                'value' => collect([
                    'model' => 'User',
                    'title' => 'admin::users.list.title',
                    'listRoute' => 'admin.users.list',
                    'editRoute' => 'admin.users.edit',
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
                            'label' => 'columnLabel.name',
                            'source' => 'name',
                            'sortable' => true,
                            'defaultOrderDirection' => 'asc',
                            'allowTrashed' => true,
                        ],
                        [
                            'key' => 'email',
                            'type' => 'email',
                            'label' => 'columnLabel.email',
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
                            'allowTrashed' => true,
                        ],
                        [
                            'key' => 'role',
                            'type' => 'badge',
                            'label' => 'columnLabel.role',
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
                            'allowTrashed' => true,
                        ],
                        [
                            'key' => 'last-seen',
                            'type' => 'datetime',
                            'relativeDatetime' => true,
                            'label' => 'columnLabel.last-seen',
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
