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
            'role' => [
                'label' => 'Rolle',
                'description' => 'Legt fest, welche Bereiche der Benutzer im System verwalten kann.',
            ],
            'language' => [
                'label' => 'Sprache',
            ],
            'password' => [
                'label' => 'Passwort',
                'description' => 'Für ein sicheres Passwort verwende eine Mischung aus Groß- und Kleinbuchstaben, Zahlen und Sonderzeichen. <a href="https://passwordcopy.app" target="_blank" style="white-space: nowrap"><span class="icon -small-text-icon">open_in_new</span> passwordcopy.app</a>',
            ],
        ],
    ],

    // Profile
    'profile' => [
        'pageTitle' => 'Profil',
        'navTitle' => 'Profil',

        // Delete
        'delete' => [
            'linkText' => 'Konto löschen',
            'modalTitle' => 'Konto löschen',
            'modalText' => '<b class="-error-text"><span class="icon -text-icon">warning</span>Achtung:</b> Dieser Vorgang löscht dein Konto und alle zugehörigen Daten dauerhaft. Bitte gib dein Passwort ein, um fortzufahren.',
            'modalSubmitButtonText' => 'Konto löschen',
            'modalCancelButtonText' => 'Abbrechen',
            'modalTextfieldPlaceholder' => 'Dein Passwort',
        ],
    ],
];
