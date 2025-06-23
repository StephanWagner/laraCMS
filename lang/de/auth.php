<?php
return [
    'signIn' => [
        'pageTitle' => 'Einloggen',
        'metaDescription' => 'Melde dich bei deinem GeoHoppers-Konto an und beginne, Beiträge auf deinen Lieblings-Social-Media-Kanälen zu veröffentlichen. Verwalte Inhalte mühelos an einem Ort.',
        'form' => [
            'title' => 'Einloggen',
            'placeholderEmail' => 'E-Mail',
            'placeholderPassword' => 'Passwort',
            'submitButtonText' => 'Einloggen',
            'linkSignUp' => 'Konto erstellen',
            'linkForgotPassword' => 'Passwort vergessen?',
            'error' => 'Ungültige E-Mail-Adresse oder Passwort.',
        ],
    ],

    'signOut' => [
        'navTitle' => 'Ausloggen',
    ],

    'delete' => [
        'pageTitle' => 'Konto löschen',
        'form' => [
            'title' => 'Konto löschen',
            'subtitle' => 'Schade dass du uns verlässt!',
            'description' => 'Gib dein Passwort ein,<br>dann klicke auf "Konto löschen".',
            'placeholderPassword' => 'Passwort',
            'submitButtonText' => 'Konto löschen',
            'linkKeepAccount' => 'Konto behalten!',
            'linkForgotPassword' => 'Passwort vergessen?',
            'errorWrongPassword' => 'Falsches Passwort.',
        ],
        'confirmModal' => [
            'title' => 'Bist du sicher?',
            'description' => 'Diese Aktion kann nicht rückgängig gemacht werden!',
            'cancelButton' => 'Abbrechen',
            'submitButton' => 'Konto löschen',
        ],
        'flashMessageTitle' => 'Dein Konto wurde erfolgreich gelöscht.',
        'flashMessageDescription' => 'Es tut uns leid, dich zu verlieren. Wenn du es dir anders überlegst, sind wir immer hier.',
    ],

    'resetPassword' => [
        'pageTitle' => 'Passwort zurücksetzen',
        'metaDescription' => 'Hast du dein GeoHoppers-Passwort vergessen? Kein Problem! Setze es schnell zurück und erhalte wieder Zugriff, um deine Social-Media-Beiträge zu verwalten.',
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

    'newPassword' => [
        'pageTitle' => 'Neues Passwort erstellen',
        'metaDescription' => 'Lege ein neues Passwort für dein GeoHoppers-Konto fest. Sichere dein Profil und verwalte Beiträge weiterhin mühelos auf Social-Media-Kanälen.',
        'flashMessageErrorResetLinkExpiredTitle' => 'Dieser Link ist abgelaufen.',
        'flashMessageErrorResetLinkExpiredDescription' => 'Auf der <a href=":route">Passwort zurücksetzen Seite</a> kannst du dir einen neuen Link schicken.',
        'form' => [
            'title' => 'Neues Passwort erstellen',
            'description' => 'Für ein sicheres Passwort, kombiniere Buchstaben mit Zahlen und Sonderzeichen.',
            'placeholderPassword' => 'Neues Passwort',
            'placeholderPasswordRepeat' => 'Und nochmal eingeben…',
            'submitButtonText' => 'Passwort speichern',
            'successText' => 'Passwort aktualisiert. Verwende ab jetzt dein neues Passwort zum Einloggen.',
            'errorExpiredTitle' => 'Dieser Link ist abgelaufen.',
            'errorExpiredSubtitle' => 'Auf der <a href=":route">Passwort zurücksetzen Seite</a> kannst du dir einen neuen Link schicken.',
            'backToSignIn' => 'Einloggen',
        ],
        'validate' => [
            'errorExpired' => 'Dieser Link ist abgelaufen.',
            'errorPasswordMin' => 'Mindestens 8 Zeichen.',
            'errorPasswordMax' => 'Maximal 50 Zeichen.',
            'errorPasswordMatch' => 'Passwörter stimmen nicht überein.',
        ],
    ],

    'verifyEmail' => [
        'flashMessageErrorTitle' => 'Wir konnten deine E-Mail-Adresse nicht verifizieren.',
        'flashMessageErrorDescription' => 'Der Link ist möglicherweise abgelaufen oder die E-Mail-Adresse wurde nicht erkannt.',
        'flashMessageSuccessTitle' => 'Vielen Dank! Du hast deine E-Mail-Adresse erfolgreich verifiziert.',
    ],
];
