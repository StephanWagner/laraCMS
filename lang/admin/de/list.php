<?php
return [
    // Empty list
    'empty' => [
        'items' => 'Keine Einträge gefunden.',
        'trash' => 'Der Papierkorb ist leer.',
    ],

    // Buttons
    'buttons' => [
        'add' => 'Hinzufügen',
    ],

    // Pagination
    'pagination' => [
        'inputPlaceholderText' => 'Seite',
    ],

    // Labels
    'columnLabel' => [
        'name' => 'Name',
        'title' => 'Titel',
        'created-by' => 'Erstellt von',
        'updated-by' => 'Geändert von',
        'created-at' => 'Erstellt',
        'updated-at' => 'Geändert',
        'deleted-at' => 'Gelöscht',
        'email' => 'E-Mail',
        'role' => 'Rolle',
        'last-seen' => 'Zuletzt aktiv',
    ],

    // Action labels
    'actionLabel' => [
        'edit' => 'Bearbeiten',
        'delete' => 'Löschen',
        'force-delete' => 'Dauerhaft löschen',
        'restore' => 'Wiederherstellen',
        'media-download' => 'Download',
        'toggle-activate' => 'Aktivieren',
        'toggle-deactivate' => 'Deaktivieren',
        'duplicate' => 'Duplizieren',
        'copy-url' => 'URL kopieren',
        'copy-url-success' => 'URL wurde in die Zwischenablage kopiert.',
    ],

    // Item count
    'itemCount' => [
        'items0' => 'Keine Einträge',
        'items1' => '1 Eintrag',
        'itemsN' => '{n} Einträge',
        'trash0' => 'Papierkorb ist leer',
        'trash1' => '1 im Papierkorb',
        'trashN' => '{n} im Papierkorb',
    ],

    // Delete modal
    'deleteModal' => [
        'title' => 'Löschen',
        'textSoftDelete' => 'Möchtest du diesen Eintrag wirklich in den Papierkorb verschieben? Du kannst ihn später wiederherstellen.',
        'textSoftDeleteBulk' => 'Möchtest du die ausgewählten Einträge wirklich in den Papierkorb verschieben? Du kannst sie später wiederherstellen.',
        'textForceDelete' => '<b class="-error-text"><span class="icon -error-text-icon">warning</span>Achtung:</b> Der Eintrag wird dauerhaft gelöscht und kann nicht wiederhergestellt werden.',
        'textForceDeleteBulk' => '<b class="-error-text"><span class="icon -error-text-icon">warning</span>Achtung:</b> Alle ausgewählten Einträge werden dauerhaft gelöscht und können nicht wiederhergestellt werden.',
        'submitButtonText' => 'Löschen',
        'cancelButtonText' => 'Abbrechen',
    ],

    // Multiselect
    'multiselect' => [
        'buttonText1' => '1 ausgewählter Eintrag',
        'buttonTextN' => '{n} ausgewählte Einträge',
        'actionRestore' => 'Wiederherstellen',
        'actionDelete' => 'Löschen',
        'actionForceDelete' => 'Dauerhaft löschen',
        'actionActivate' => 'Aktivieren',
        'actionDeactivate' => 'Deaktivieren',
    ],
];
