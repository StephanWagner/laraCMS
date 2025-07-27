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
                    'form' => [
                        [
                            'type' => 'textfield',
                            'position' => 'form',
                            'label' => 'Full name',
                            'design' => 'large',
                            'validate' => ['required', 'min:3', 'max:30']
                        ],
                        [
                            'type' => 'textfield',
                            'position' => 'form',
                            'label' => 'Email address',
                            'validate' => ['required', 'email', 'max:255']
                        ]
                    ],
                ])->toJson(),
            ],
        ]);
    }
}
