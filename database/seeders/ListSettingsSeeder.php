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
                    'editView' => 'page',
                    'defaultOrderBy' => 'order',
                    'defaultOrderDirection' => 'asc',
                    'defaultPerPage' => 25,
                    'hasMultiSelect' => false,
                    'hasSoftDelete' => true,
                    'searchables' => [
                        ['column' => 'name'],
                    ],
                    'duplicate' => [
                        'uniqueColumns' => [
                            ['column' => 'key'],
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
                            'relation' => [
                                'key' => 'creator',
                            ],
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
                                [
                                    'type' => 'toggle',
                                ],
                                [
                                    'type' => 'edit',
                                ],
                                [
                                    'type' => 'duplicate',
                                ],
                                [
                                    'type' => 'reorder',
                                ],
                                [
                                    'type' => 'delete',
                                ],
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

                    // TODO TMP
                    'editView' => 'modal',

                    'defaultOrderBy' => 'name',
                    'defaultOrderDirection' => 'asc',
                    'defaultPerPage' => 25,
                    'hasMultiSelect' => [
                        'activate',
                        'deactivate',
                        'delete',
                    ],
                    'hasSoftDelete' => true,
                    'searchables' => [
                        ['column' => 'name'],
                        ['column' => 'email'],
                        ['column' => 'role'],
                    ],
                    'filters' => [
                        [
                            'key' => 'created-by',
                            'type' => 'checkbox',
                            'render' => 'menu',
                            'label' => 'filterLabel.created-by',
                            'labelSelectButton' => 'filterLabelSelectButton.created-by',
                            'valueColumn' => 'id',
                            'labelColumn' => 'name',
                            'getOptions' => [
                                'model' => 'User',
                                'where' => [],
                                'select' => [
                                    'name',
                                ],
                                'prioritizeBy' => ['id', 'auth-id'],
                                'orderBy' => 'name',
                                'orderDirection' => 'asc',
                            ],
                        ],
                        [
                            'key' => 'status',
                            'type' => 'radio',
                            'render' => 'default',
                            'label' => 'filterLabel.status',
                            'valueColumn' => 'active',
                            'options' => [
                                [
                                    'label' => 'filterOption.status.active',
                                    'value' => 1,
                                ],
                                [
                                    'label' => 'filterOption.status.inactive',
                                    'value' => 0,
                                ],
                            ],
                        ],
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
                                [
                                    'type' => 'toggle',
                                ],
                                [
                                    'type' => 'edit',
                                ],
                                [
                                    'type' => 'delete',
                                ],
                            ],
                        ],
                    ],
                ])->toJson(),
            ],
            [
                'key' => 'list-settings.media',
                'value' => collect([
                    'model' => 'Media',
                    'title' => 'admin::media.list.title',
                    'listRoute' => 'admin.media.list',
                    'editRoute' => 'admin.media.edit',

                    // TODO
                    'editView' => 'sidebar',

                    'addButtonAttributes' => [
                        'data-list-upload' => 'media',
                    ],
                    'defaultOrderBy' => 'created_at',
                    'defaultOrderDirection' => 'desc',
                    'defaultPerPage' => 50,
                    'hasMultiSelect' => [
                        'delete',
                    ],
                    'hasSoftDelete' => false,
                    'hasGridView' => true,
                    'defaultView' => 'grid',
                    'searchables' => [
                        ['column' => 'title'],
                        ['column' => 'mime_type'],
                        ['column' => 'meta.alt_text', 'type' => 'jsonColumn'],
                        ['column' => 'meta.copyright', 'type' => 'jsonColumn'],
                    ],
                    'columns' => [
                        [
                            'key' => 'multiselect',
                            'type' => 'multiselect',
                            'label' => null,
                        ],
                        [
                            'key' => 'filepreview',
                            'type' => 'filepreview',
                            'label' => null,
                            'isLink' => true,
                            'source' => 'versions.0',
                            'relation' => [
                                'key' => 'versions',
                                'where' => [
                                    'size_key' => 'preview',
                                ],
                            ],
                            'sortable' => false,
                            'defaultOrderDirection' => 'asc',
                            'allowTrashed' => true,
                        ],
                        [
                            'key' => 'title',
                            'type' => 'title',
                            'label' => 'columnLabel.title',
                            'source' => 'title',
                            'sortable' => true,
                            'defaultOrderDirection' => 'asc',
                            'allowTrashed' => true,
                        ],
                        [
                            'key' => 'created-by',
                            'type' => 'username',
                            'label' => 'columnLabel.created-by',
                            'source' => 'creator.name',
                            'relation' => [
                                'key' => 'creator',
                            ],
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
                                [
                                    'type' => 'media-preview',
                                    'onlyMenu' => true,
                                ],
                                [
                                    'type' => 'media-download',
                                ],
                                [
                                    'type' => 'copy-url',
                                ],
                                [
                                    'type' => 'edit',
                                ],
                                [
                                    'type' => 'delete',
                                ],
                            ],
                        ],
                    ],
                ])->toJson(),
            ],
        ]);
    }
}
