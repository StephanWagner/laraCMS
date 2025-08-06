<?php
return [
    // Install
    'install' => [
        'pageTitle' => 'Installation',
        'form' => [
            'title' => 'Installation',
            'description' => 'Um loszulegen, erstelle bitte deinen ersten Benutzer. Dieser erhält vollständige Entwicklerrechte und kann später weitere Admin-Benutzer hinzufügen.',
            'placeholderName' => 'Dein Name',
            'placeholderEmail' => 'E-Mail-Adresse',
            'placeholderPassword' => 'Passwort',
            'submitButtonText' => 'Entwicklerkonto erstellen',
        ],
        'validate' => [
            'nameEmpty' => 'Bitte gib deinen Namen ein.',
            'nameMin' => 'Dein Name muss mindestens 3 Zeichen lang sein.',
            'nameMax' => 'Dein Name darf höchstens 30 Zeichen lang sein.',
            'nameAlphaNum' => 'Dein Name darf nur Buchstaben und Zahlen enthalten.',
            'emailEmpty' => 'Bitte gib deine E-Mail-Adresse ein.',
            'emailInvalid' => 'Ungültige E-Mail-Adresse.',
            'passwordEmpty' => 'Bitte gib ein Passwort ein.',
            'passwordMin' => 'Das Passwort muss mindestens 8 Zeichen lang sein.',
            'passwordMax' => 'Das Passwort darf höchstens 50 Zeichen lang sein.',
        ],
        'successText' => 'Dein Entwicklerkonto wurde erstellt. Du kannst dich jetzt einloggen und dein CMS konfigurieren.',
    ],

    // Login
    'login' => [
        'pageTitle' => 'Einloggen',
        'form' => [
            'title' => 'Einloggen',
            'placeholderEmail' => 'E-Mail',
            'placeholderPassword' => 'Passwort',
            'submitButtonText' => 'Einloggen',
            'linkForgotPassword' => 'Passwort vergessen?',
            'error' => 'Ungültige E-Mail-Adresse oder Passwort.',
        ],
    ],

    // Logout
    'logout' => [
        'navTitle' => 'Ausloggen',
    ],

    // Delete
    'delete' => [
        'errorWrongPassword' => 'Falsches Passwort.',
        'flashMessageTitle' => 'Dein Konto wurde erfolgreich gelöscht.',
    ],

    // Reset password
    'resetPassword' => [
        'pageTitle' => 'Passwort zurücksetzen',
        'form' => [
            'title' => 'Passwort<br>zurücksetzen',
            'description' => 'Wir schicken dir einen Link <br>zum Ändern deines Passwortes zu.',
            'placeholderEmail' => 'E-Mail-Adresse',
            'submitButtonText' => 'Abschicken',
            'errorEmailText' => 'Diese E-Mail-Adresse ist uns nicht bekannt.',
            'successText' => 'Wir haben dir den Link <br>für ein neues Passwort zugeschickt.',
            'backToSignIn' => 'Einloggen',
        ],
    ],

    // New password
    'newPassword' => [
        'pageTitle' => 'Neues Passwort erstellen',
        'flashMessageErrorResetLinkExpired' => '<b>Dieser Link ist abgelaufen</b><br>Du kannst du dir hier einen neuen schicken.',
        'form' => [
            'title' => 'Neues Passwort erstellen',
            'description' => 'Für ein sicheres Passwort, kombiniere Buchstaben mit Zahlen und Sonderzeichen.',
            'placeholderPassword' => 'Neues Passwort',
            'placeholderPasswordRepeat' => 'Und nochmal eingeben…',
            'submitButtonText' => 'Passwort speichern',
            'successText' => 'Passwort aktualisiert. Verwende ab jetzt dein neues Passwort zum Einloggen.',
            'backToSignIn' => 'Einloggen',
        ],
        'validate' => [
            'errorExpired' => 'Dieser Link ist abgelaufen.',
            'errorPasswordMin' => 'Mindestens 8 Zeichen.',
            'errorPasswordMax' => 'Maximal 50 Zeichen.',
            'errorPasswordMatch' => 'Passwörter stimmen nicht überein.',
        ],
    ],
];
