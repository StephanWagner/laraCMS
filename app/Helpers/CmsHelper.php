<?php

namespace App\Helpers;

use App\Models\User;

class CmsHelper
{
    /**
     * Delete a user account
     */
    static function deleteUserAccount($userId)
    {
        $user = User::where('id', $userId)->first();

        if (!$user) {
            return false;
        }

        // Delete the user
        $user->forceDelete();

        // Show flash message
        session()->flash('message', [
            'color' => 'notice',
            'title' => __('admin::auth.delete.flashMessageTitle'),
            'description' => __('admin::auth.delete.flashMessageDescription'),
        ]);

        return true;
    }
}
