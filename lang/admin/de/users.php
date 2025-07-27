<?php
return [
    'list' => [
        'title' => 'Benutzer',
    ],

    'form' => [
        'titleNew' => 'Neuen Benutzer erstellen',
        'titleEdit' => 'Benutzer bearbeiten',

        'items' => [
            'name' => [
                'label' => 'Vollständiger Name',
            ],
            'email' => [
                'label' => 'E-Mail Adresse',
                'description' => 'Wird für den Login und wichtige Benachrichtigungen verwendet.',
            ],
        ],
    ],

    // TODO

    // Profile
    'profile' => [
        'pageTitle' => 'Profil',
        'navTitle' => 'Profil',

        // Settings
        // TODO
        'settings' => [
            // Page settings
            'pageSettingsTitle' => 'Seiten-Einstellungen',
            // Language
            'languageTitle' => 'Sprache',
            // Time format
            'timeFormatTitle' => 'Zeitformat',
            'timeFormatValue12h' => '12-Stunden (8:00 PM)',
            'timeFormatValue24h' => '24-Stunden (20:00)',

            // Account settings
            'accountSettingsTitle' => 'Account-Einstellungen',
            // Name
            'nameTitle' => 'Name',
            'nameDescription' => 'Wie heißt du?',
            'nameSaveSuccess' => 'Dein name wurde geändert.',
            'nameSaveButton' => 'Speichern',
            // Email
            'emailTitle' => 'E-Mail-Adresse',
            'emailDescription' => 'Wird zum Einloggen benötigt.',
            'emailSaveSuccess' => 'Deine E-Mail-Adresse wurde geändert.',
            'emailErrorCurrentPassword' => 'Falsches aktuelles Passwort.',
            'emailNotVerifiedText' => 'Nicht verifiziert',
            'emailInputCurrentPasswordPlaceholder' => 'Aktuelles Passwort',
            'emailInputNewEmailPlaceholder' => 'Neue E-Mail-Adresse',
            'emailSaveButton' => 'Speichern',
            'emailForgotPasswordLink' => 'Passwort vergessen?',
            'emailResendVerificationMailLink' => 'Verifizierungs-E-Mail erneut senden',
            'emailResendVerificationMailSuccess' => 'Wir haben die Verifizierungs-E-Mail erneut an deinen Posteingang gesendet.',
            // Password
            'passwordTitle' => 'Passwort',
            'passwordDescription' => 'Mindestens 8 Zeichen. Sei kreativ!',
            'passwordSaveSuccess' => 'Dein Passwort wurde geändert.',
            'passwordErrorCurrentPassword' => 'Falsches aktuelles Passwort.',
            'passwordInputCurrent' => 'Aktuelles Passwort',
            'passwordInputNew' => 'Neues Passwort',
            'passwordSaveButton' => 'Speichern',
            'passwordForgotPasswordLink' => 'Passwort vergessen?',
            'passwordTextNeverChanged' => 'Noch nie geändert',
            'passwordTextChangedAt' => 'Zuletzt geändert: <br>:date',
        ],

        // Delete
        // 'delete' => [
        //     'deleteAccountLinkText' => 'Konto löschen',
        // ],
    ],
];
