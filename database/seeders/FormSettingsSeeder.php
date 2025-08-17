<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormSettingsSeeder extends Seeder
{
    public function run()
    {
        DB::table('settings')->insertOrIgnore([
            [
                'key' => 'form-settings.users',
                'value' => collect([
                    'model' => 'User',
                    'titleNew' => 'admin::users.form.titleNew',
                    'titleEdit' => 'admin::users.form.titleEdit',
                    'listRoute' => 'admin.users.list',
                    'editRoute' => 'admin.users.edit',
                    'texts' => 'users.form',
                    'form' => [
                        [
                            'type' => 'input',
                            'position' => 'form',
                            'label' => 'items.name.label', // TODO Use lang:: to tell JS to use from lang file
                            'validate' => ['required', 'max:30'],
                            'source' => 'name',
                            'inputOptions' => [
                                'type' => 'textfield',
                                'size' => 'large',
                                'id' => 'user-name',
                                'name' => 'name',
                                'required' => true,
                                'maxlength' => 30,
                                'autocomplete' => 'off',
                            ],
                        ],
                        [
                            'type' => 'input',
                            'position' => 'form',
                            'label' => 'items.email.label',
                            'description' => 'items.email.description',
                            'validate' => ['required', 'email', 'max:255', 'unique:users,email,{id}'],
                            'source' => 'email',
                            'inputOptions' => [
                                'type' => 'textfield',
                                'id' => 'user-email',
                                'name' => 'email',
                                'required' => true,
                                'maxlength' => 255,
                                'autocomplete' => 'off',
                            ],
                        ],
                        [
                            'type' => 'input',
                            'position' => 'form',
                            'label' => 'items.role.label',
                            'description' => 'items.role.description',
                            'validate' => ['required'],
                            'source' => 'role',
                            'inputOptions' => [
                                'type' => 'select',
                                'id' => 'user-role',
                                'name' => 'role',
                                'required' => true,
                                'options' => [
                                    [
                                        'value' => 'editor',
                                        'label' => 'Editor',
                                    ],
                                    [
                                        'value' => 'admin',
                                        'label' => 'Admin',
                                    ],
                                    [
                                        'value' => 'developer',
                                        'label' => 'Developer',
                                    ],
                                ],
                                'restrictOptions' => [
                                    'developer' => ['developer']
                                ],
                            ],
                        ],
                        [
                            'type' => 'input',
                            'position' => 'form',
                            'label' => 'items.password.label',
                            'description' => 'items.password.description',
                            'validate' => ['min:8', 'securePassword'],
                            'validateIfNew' => ['required'],
                            'source' => 'password',
                            'format' => 'Hash',
                            'ignoreIfEmpty' => true,
                            'inputOptions' => [
                                'type' => 'password',
                                'id' => 'user-password',
                                'name' => 'password',
                                'requiredIfNew' => true,
                                'autocomplete' => 'new-password',
                            ],
                        ],
                    ],
                ])->toJson(),
            ],
            [
                'key' => 'form-settings.profile',
                'value' => collect([
                    'model' => 'User',
                    'titleEdit' => 'admin::users.profile.pageTitle',
                    'editRoute' => 'admin.profile.edit',
                    'texts' => 'users.form',
                    'form' => [
                        [
                            'type' => 'input',
                            'position' => 'form',
                            'label' => 'items.name.label',
                            'validate' => ['required', 'max:30'],
                            'source' => 'name',
                            'inputOptions' => [
                                'type' => 'textfield',
                                'size' => 'large',
                                'id' => 'user-name',
                                'name' => 'name',
                                'required' => true,
                                'maxlength' => 30,
                                'autocomplete' => 'off',
                            ],
                        ],
                        [
                            'type' => 'input',
                            'position' => 'form',
                            'label' => 'items.email.label',
                            'description' => 'items.email.description',
                            'validate' => ['required', 'email', 'max:255', 'unique:users,email,{id}'],
                            'source' => 'email',
                            'inputOptions' => [
                                'type' => 'textfield',
                                'id' => 'user-email',
                                'name' => 'email',
                                'required' => true,
                                'maxlength' => 255,
                                'autocomplete' => 'off',
                            ],
                        ],
                        [
                            'type' => 'input',
                            'position' => 'form',
                            'label' => 'items.language.label',
                            'validate' => ['required'],
                            'source' => 'language',
                            'inputOptions' => [
                                'type' => 'select',
                                'id' => 'user-language',
                                'name' => 'language',
                                'required' => true,
                                'options' => [
                                    [
                                        'value' => 'en',
                                        'label' => 'English',
                                    ],
                                    [
                                        'value' => 'de',
                                        'label' => 'Deutsch',
                                    ],
                                ],
                            ],
                        ],
                        [
                            'type' => 'input',
                            'position' => 'form',
                            'label' => 'items.password.label',
                            'description' => 'items.password.description',
                            'validate' => ['min:8', 'securePassword'],
                            'source' => 'password',
                            'format' => 'Hash',
                            'ignoreIfEmpty' => true,
                            'inputOptions' => [
                                'type' => 'password',
                                'id' => 'user-password',
                                'name' => 'password',
                                'autocomplete' => 'new-password',
                            ],
                        ],
                    ],
                ])->toJson(),
            ],
            [
                'key' => 'form-settings.media',
                'value' => collect([
                    'model' => 'Media',
                    'titleNew' => 'admin::media.form.titleNew',
                    'titleEdit' => 'admin::media.form.titleEdit',
                    'listRoute' => 'admin.media.list',
                    'editRoute' => 'admin.media.edit',
                    'texts' => 'media.form',
                    'form' => [
                        [
                            'type' => 'html',
                            'position' => 'form',
                            'content' => '<div>
                                <h2>TODO Image information</h2>
                            </div>',
                        ],
                        [
                            'type' => 'input',
                            'position' => 'form',
                            'label' => 'items.title.label',
                            'validate' => ['required', 'max:255'],
                            'source' => 'title',
                            'inputOptions' => [
                                'type' => 'textfield',
                                'size' => 'large',
                                'id' => 'media-title',
                                'name' => 'title',
                                'required' => true,
                                'maxlength' => 255,
                                'autocomplete' => 'off',
                            ],
                        ],
                        [
                            'type' => 'input',
                            'position' => 'form',
                            'label' => 'items.alt-text.label',
                            'validate' => ['max:255'],
                            'source' => 'meta.alt_text',
                            'inputOptions' => [
                                'type' => 'textfield',
                                'id' => 'media-alt-text',
                                'name' => 'alt-text',
                                'required' => false,
                                'maxlength' => 255,
                                'autocomplete' => 'off',
                            ],
                        ],
                        [
                            'type' => 'html',
                            'position' => 'form',
                            'skipIf' => 'new',
                            'content' => '<div>
                                <h2>TODO Usages</h2>
                            </div>',
                        ],
                    ],
                ])->toJson(),
            ],
        ]);
    }
}
