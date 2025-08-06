<?php
return [
    'list' => [
        'title' => 'Users',
    ],

    'form' => [
        'titleNew' => 'Create new user',
        'titleEdit' => 'Edit user',

        'items' => [
            'name' => [
                'label' => 'Full name',
            ],
            'email' => [
                'label' => 'Email address',
                'description' => 'Used for login and important notifications.',
            ],
            'role' => [
                'label' => 'Role',
                'description' => 'Controls what the user can see and manage in the admin panel.',
            ],
            'language' => [
                'label' => 'Language',
            ],
            'password' => [
                'label' => 'Password',
                'description' => 'To create a strong password, use a mix of uppercase and lowercase letters, numbers, and special characters. <a href="https://passwordcopy.app" target="_blank" style="white-space: nowrap"><span class="icon">open_in_new</span> passwordcopy.app</a>',
            ],
        ],
    ],

    // Profile
    'profile' => [
        'pageTitle' => 'Profile',
        'navTitle' => 'Profile',

        // Delete
        'delete' => [
            'linkText' => 'Delete Account',
            'modalTitle' => 'Delete Account',
            'modalText' => '<b class="-error-text"><span class="icon -error-text-icon">warning</span>Caution:</b> This action will permanently delete your account and all associated data. Please enter your password to confirm.',
            'modalSubmitButtonText' => 'Delete account',
            'modalCancelButtonText' => 'Cancel',
            'modalTextfieldPlaceholder' => 'Your password',
        ],
    ],
];
