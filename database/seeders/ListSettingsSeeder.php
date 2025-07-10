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
                'key' => 'list_settings.content_types',
                'value' => collect([
                    'model' => 'ContentType',
                    'defaultOrderBy' => 'order',
                    'defaultOrderDirection' => 'asc',
                    'defaultPerPage' => 20,
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
                                'lg' => true,
                                'md' => true,
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
                                'md' => true,
                                'sm' => true,
                                'xs' => false,
                            ],
                        ],
                        [
                            'key' => 'actions',
                            'type' => 'actions',
                            'label' => null,
                            'actions' => [
                                'edit',
                                'delete'
                            ]
                        ],
                    ],
                ])->toJson(),
            ],
            [
                'key' => 'list_settings.users',
                'value' => collect([
                    'model' => 'User',
                    'defaultOrderBy' => 'title',
                    'defaultOrderDirection' => 'asc',
                    'defaultPerPage' => 20,
                    'columns' => [
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
                                'lg' => true,
                                'md' => true,
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
                                    'developer' => 'red',
                                    'admin' => 'blue',
                                    'editor' => 'green',
                                ],
                            ],
                            'sortable' => true,
                            'defaultOrderDirection' => 'asc',
                            'visibility' => [
                                'xl' => true,
                                'lg' => true,
                                'md' => true,
                                'sm' => true,
                                'xs' => false,
                            ],
                        ],
                        [
                            'key' => 'latest-login',
                            'type' => 'datetime',
                            'relativeDatetime' => true,
                            'label' => 'Latest Login',
                            'source' => 'latest_login',
                            'sortable' => true,
                            'defaultOrderDirection' => 'desc',
                            'visibility' => [
                                'xl' => true,
                                'lg' => true,
                                'md' => true,
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
                                'delete'
                            ],
                        ],
                    ],
                ])->toJson(),
            ],
        ]);
    }
}
