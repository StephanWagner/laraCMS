<?php
return [
    // Install
    'install' => [
        'pageTitle' => 'Install',
        'form' => [
            'title' => 'Install',
            'description' => 'To get started, please create your first user account. This account will have full developer access and can manage all parts of the system, including creating additional admin users later.',
            'placeholderName' => 'Your name',
            'placeholderEmail' => 'Email',
            'placeholderPassword' => 'Password',
            'submitButtonText' => 'Create Developer Account',
        ],
        'validate' => [
            'nameEmpty' => 'Please type in your name.',
            'nameMin' => 'Your name needs to be at least 3 characters long.',
            'nameMax' => 'Your name can not be more than 30 characters long.',
            'nameAlphaNum' => 'Your name can only contain letters and numbers.',
            'emailEmpty' => 'Please type in the email address.',
            'emailInvalid' => 'Invalid email address.',
            'passwordEmpty' => 'Please type in the password.',
            'passwordMin' => 'The password needs to be at least 8 characters long.',
            'passwordMax' => 'The password can not be more than 50 characters long.',
        ],
        'successText' => 'Your developer account has been created. You can now log in and start configuring your CMS.',
    ],

    // Login
    'login' => [
        'pageTitle' => 'Login',
        'form' => [
            'title' => 'Login',
            'placeholderEmail' => 'Email',
            'placeholderPassword' => 'Password',
            'submitButtonText' => 'Login',
            'linkForgotPassword' => 'Forgot password?',
            'error' => 'Invalid email address or password.',
        ],
    ],

    // Logout
    'logout' => [
        'navTitle' => 'Logout',
    ],




    // TODO

    'delete' => [
        'pageTitle' => 'Delete Account',
        'form' => [
            'title' => 'Delete Account',
            'subtitle' => 'We’re sad to see you leave us!',
            'description' => 'Type in your password,<br>then click on "Delete account".',
            'placeholderPassword' => 'Password',
            'submitButtonText' => 'Delete account',
            'linkKeepAccount' => 'Keep account!',
            'linkForgotPassword' => 'Forgot password?',
            'errorWrongPassword' => 'Incorrect password.',
        ],
        'confirmModal' => [
            'title' => 'Are you sure?',
            'description' => 'This action cannot be undone!',
            'cancelButton' => 'Cancel',
            'submitButton' => 'Delete account',
        ],
        'flashMessageTitle' => 'Your account has been successfully deleted.',
        'flashMessageDescription' => 'We’re sorry to see you go. If you ever change your mind, we’re always here.',
    ],

    'resetPassword' => [
        'pageTitle' => 'Reset Password',
        'metaDescription' => 'Forgot your GeoHoppers password? Don’t worry! Reset it quickly and regain access to publish and manage your social media posts.',
        'form' => [
            'title' => 'Reset<br>Password',
            'description' => 'We will send you a link to <br>reset your password.',
            'placeholderEmail' => 'Your email address',
            'submitButtonText' => 'Send link',
            'errorEmailText' => 'This email address is not registered with us.',
            'successText' => 'We’ve sent you a link <br>to set a new password.',
            'backToSignIn' => 'Sign in',
        ],
    ],

    'newPassword' => [
        'pageTitle' => 'Create new password',
        'metaDescription' => 'Set a new password for your GeoHoppers account. Secure your profile and continue managing posts across social media effortlessly.',
        'flashMessageErrorResetLinkExpiredTitle' => 'This link is expired.',
        'flashMessageErrorResetLinkExpiredDescription' => 'You can request a new link on the <a href=":route">reset password page</a>.',
        'form' => [
            'title' => 'Create new password',
            'description' => 'Combine letters, numbers and special characters to create a strong password.',
            'placeholderPassword' => 'New Password',
            'placeholderPasswordRepeat' => 'One more time please…',
            'submitButtonText' => 'Save password',
            'successText' => 'Password updated. From now on, use your new password to sign in.',
            'backToSignIn' => 'Sign in',
        ],
        'validate' => [
            'errorExpired' => 'This link is expired.',
            'errorPasswordMin' => 'At least 8 characters.',
            'errorPasswordMax' => 'Not more than 50 characters.',
            'errorPasswordMatch' => 'Passwords do not match.',
        ],
    ],

    'verifyEmail' => [
        'flashMessageErrorTitle' => 'We couldn’t verify your email address.',
        'flashMessageErrorDescription' => 'The link may have expired, or the email was not recognized.',
        'flashMessageSuccessTitle' => 'Thank you! You’ve successfully verified your email address.',
    ],
];
