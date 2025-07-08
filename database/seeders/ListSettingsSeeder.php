<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ListSettingsSeeder extends Seeder
{
    public function run()
    {
        $now = now();

        DB::table('settings')->insertOrIgnore([
            [
                'key' => 'list_settings.content_types',
                'value' => collect([
                    'model' => 'ContentType',
                    'defaultOrderBy' => 'order',
                    'defaultOrderDirection' => 'desc',
                    'defaultPerPage' => 20,
                    'columns' => [
                        [
                            'key' => 'order',
                            'type' => 'sortable',
                            'label' => null,
                            'source' => 'order',
                            'sortable' => true,
                        ],
                        [
                            'key' => 'title',
                            'type' => 'title',
                            'label' => 'Title',
                            'source' => 'name',
                            'sortable' => true,
                        ],
                        [
                            'key' => 'created-by',
                            'type' => 'username',
                            'label' => 'Created By',
                            'source' => 'created_by',
                            'sortable' => true,
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
                            'source' => 'updated_at',
                            'label' => 'Updated',
                            'sortable' => true,
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
                            'actions' => ['toggle', 'duplicate', 'edit', 'delete']
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
                        ],
                        [
                            'key' => 'email',
                            'type' => 'email',
                            'label' => 'Email',
                            'source' => 'email',
                            'sortable' => true,
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
                            'type' => 'datetime-readable',
                            'label' => 'Latest Login',
                            'source' => 'latest_login',
                            'sortable' => true,
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
                            'actions' => ['toggle', 'edit', 'delete']
                        ],
                    ],
                ])->toJson(),
            ],
        ]);
    }
}
