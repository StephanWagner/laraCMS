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
                    'editRoute' => '/admin/users/edit/{id}',
                    'texts' => 'users.form',
                    'form' => [
                        [
                            'position' => 'form',
                            'label' => 'items.name.label',
                            'validate' => ['required', 'min:3', 'max:30'],
                            'source' => 'name',
                            'inputOptions' => [
                                'type' => 'textfield',
                                'size' => 'large',
                                'id' => 'user-name',
                                'name' => 'name',
                            ],
                        ],
                        [
                            'position' => 'form',
                            'label' => 'items.email.label',
                            'description' => 'items.email.description',
                            'validate' => ['required', 'email', 'max:255'],
                            'source' => 'email',
                            'inputOptions' => [
                                'type' => 'textfield',
                                'id' => 'user-email',
                                'name' => 'email',
                            ],
                        ]
                    ],
                ])->toJson(),
            ],
        ]);
    }
}
