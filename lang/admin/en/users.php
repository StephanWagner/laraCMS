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
        ],
    ],

    // TODO

    // Profile
    'profile' => [
        'pageTitle' => 'Profile',
        'navTitle' => 'Profile',

        // Settings
        // TODO
        'settings' => [
            // Page settings
            'pageSettingsTitle' => 'Page Settings',
            // Language
            'languageTitle' => 'Language',
            // Time format
            'timeFormatTitle' => 'Time Format',
            'timeFormatValue12h' => '12-Hour (8:00 PM)',
            'timeFormatValue24h' => '24-Hour (20:00)',

            // Account settings
            'accountSettingsTitle' => 'Account Settings',
            // Name
            'nameTitle' => 'Name',
            'nameDescription' => 'What’s your name?',
            'nameSaveSuccess' => 'Your name was changed.',
            'nameSaveButton' => 'Save',
            // Email
            'emailTitle' => 'Email Address',
            'emailDescription' => 'Required to sign you in.',
            'emailSaveSuccess' => 'Your email address was changed.',
            'emailErrorCurrentPassword' => 'Incorrect current password.',
            'emailNotVerifiedText' => 'Not verified',
            'emailInputCurrentPasswordPlaceholder' => 'Current Password',
            'emailInputNewEmailPlaceholder' => 'New Email Address',
            'emailSaveButton' => 'Save',
            'emailForgotPasswordLink' => 'Forgot your password?',
            'emailResendVerificationMailLink' => 'Resend verification email',
            'emailResendVerificationMailSuccess' => 'We’ve resent the verification email to your inbox.',
            // Password
            'passwordTitle' => 'Password',
            'passwordDescription' => '8 characters or more. Be creative!',
            'passwordSaveSuccess' => 'Your password was changed.',
            'passwordErrorCurrentPassword' => 'Incorrect current password.',
            'passwordInputCurrent' => 'Current Password',
            'passwordInputNew' => 'New Password',
            'passwordSaveButton' => 'Save',
            'passwordForgotPasswordLink' => 'Forgot your password?',
            'passwordTextNeverChanged' => 'Never changed',
            'passwordTextChangedAt' => 'Last changed: <br>:date',
        ],

        // Delete
        // 'delete' => [
        //     'deleteAccountLinkText' => 'Delete Account',
        // ],
    ],
];
