<?php
return [
    // Empty list
    'empty' => [
        'items' => 'No items found.',
        'trash' => 'Trash is empty.',
    ],

    // Buttons
    'buttons' => [
        'add' => 'Add',
    ],

    // Pagination
    'pagination' => [
        'inputPlaceholderText' => 'Page',
    ],

    // Labels
    'columnLabel' => [
        'name' => 'Name',
        'title' => 'Title',
        'created-by' => 'Created by',
        'updated-by' => 'Updated by',
        'created-at' => 'Created',
        'updated-at' => 'Updated',
        'deleted-at' => 'Deleted',
        'email' => 'Email',
        'role' => 'Role',
        'last-seen' => 'Latest activity',
    ],

    // Action labels
    'actionLabel' => [
        'edit' => 'Edit',
        'delete' => 'Delete',
        'force-delete' => 'Delete permanently',
        'restore' => 'Restore',
        'reorder' => 'Reorder',
        'reorder-up' => 'Move Up',
        'reorder-down' => 'Move Down',
        'reorder-to-top' => 'Move to top',
        'reorder-to-bottom' => 'Move to bottom',
        'media-preview' => 'Open in new tab',
        'media-download' => 'Download',
        'activate' => 'Activate',
        'deactivate' => 'Deactivate',
        'duplicate' => 'Duplicate',
        'copy-url' => 'Copy URL',
        'copy-url-success' => 'URL copied to clipboard.',
    ],

    // Item count
    'itemCount' => [
        'items0' => 'No items',
        'items1' => '1 item',
        'itemsN' => '{n} items',
        'trash0' => 'Trash is empty',
        'trash1' => '1 in trash',
        'trashN' => '{n} in trash',
    ],

    // Delete modal
    'deleteModal' => [
        'title' => 'Delete',
        'textSoftDelete' => 'Are you sure you want to move this item to the trash? You can restore it later.',
        'textSoftDeleteBulk' => 'Are you sure you want to move the selected items to the trash? You can restore them later.',
        'textForceDelete' => '<b class="-error-text"><span class="icon -error-warning-icon">warning</span>Caution:</b> The item will be permanently deleted. This cannot be undone.',
        'textForceDeleteBulk' => '<b class="-error-text"><span class="icon -error-warning-icon">warning</span>Caution:</b> All selected items will be permanently deleted. This cannot be undone.',
        'submitButtonText' => 'Delete',
        'cancelButtonText' => 'Cancel',
    ],

    // Multiselect
    'multiselect' => [
        'buttonText1' => '1 Selected item',
        'buttonTextN' => '{n} Selected items',
        'actionRestore' => 'Restore',
        'actionDelete' => 'Delete',
        'actionForceDelete' => 'Delete permanently',
        'actionActivate' => 'Activate',
        'actionDeactivate' => 'Deactivate',
    ],
];
