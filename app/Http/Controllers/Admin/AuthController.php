<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\StringHelper;
use App\Helpers\ValidateHelper;
use App\Helpers\RouteHelper;
use App\Helpers\MailHelper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Vendor\IP2Location\IP2Location;
use App\Models\User;
use Sqids\Sqids;

class AuthController extends Controller
{
    /**
     * View for login page
     */
    public function login()
    {
        if (Auth::check()) {
            return redirect('/');
        }

        return view('admin::auth.login');
    }

    /**
     * Handle the login request
     */
    public function loginRequest()
    {
        $email = request()->get('email');
        $password = request()->get('password');
        $csrf = request()->get('csrf');

        // CSRF block
        if ($csrf) {
            return response()->json([
                'error' => 1,
                'errorText' => __('app.errors.default')
            ]);
        }

        // Handle sign up
        $response = $this->handleLogin([
            'email' => $email,
            'password' => $password
        ]);

        return response()->json($response);
    }

    /**
     * Handle the sign in
     */
    private function handleLogin($data)
    {
        $email = !empty($data['email']) ? $data['email'] : '';
        $password = !empty($data['password']) ? $data['password'] : '';

        if (
            Auth::attempt([
                'email' => $email,
                'password' => $password
            ], true) // TODO add remember checkbox
        ) {
            return [
                'success' => true,
            ];
        }

        return [
            'error' => true,
            'errorText' => __('auth.signIn.form.error'),
        ];
    }

    /**
     * Delete account page
     */
    public function delete()
    {
        if (!Auth::check()) {
            return redirect('/'); // TODO
        }

        // TODO view()->share('pageTitle', __('auth.delete.pageTitle'));

        return view('pages.delete');
    }

    /**
     * Delete account request
     */
    public function deleteRequest()
    {
        // Abort if not logged in
        if (!Auth::check()) {
            return response()->json([
                'error' => true,
            ]);
        }

        $password = request()->get('password');

        // Abort if password is wrong
        if (!Hash::check($password, Auth::user()->password)) {
            return response()->json([
                'error' => 1,
                'errorText' => __('auth.delete.form.errorWrongPassword')
            ]);
        }

        // Delete account
        $accountDeleted = $this->deleteAccount(Auth::id());

        // Abort if not logged in
        if (!$accountDeleted) {
            return response()->json([
                'error' => 1,
            ]);
        }

        // Return success
        return response()->json([
            'success' => 1,
        ]);
    }

    /**
     * Delete account
     */
    private function deleteAccount($userId)
    {
        $user = User::where('id', $userId)->first();

        if (!$user) {
            return false;
        }

        // Delete the user
        $user->delete();

        // Show flash message
        session()->flash('message', [
            'color' => 'notice',
            'title' => __('auth.delete.flashMessageTitle'),
            'description' => __('auth.delete.flashMessageDescription'),
        ]);

        return true;
    }

    /**
     * View for reset password page
     */
    public function resetPassword()
    {
        // view()->share('pageTitle', __('auth.resetPassword.pageTitle'));
        // view()->share('metaDescription', __('auth.resetPassword.metaDescription'));
        // view()->share('authPage', true);

        return view('pages.reset-password');
    }

    /**
     * Reset password request
     */
    public function resetPasswordRequest()
    {
        $email = request()->get('email');
        $csrf = request()->get('csrf');

        // CSRF block
        if ($csrf) {
            return response()->json([
                'error' => 1,
                'errorText' => __('app.errors.default')
            ]);
        }

        // Validate email exists
        $user = User::where([
            'email' => $email
        ])->first();

        if (!$user) {
            return response()->json([
                'error' => 1,
                'errorText' => __('auth.resetPassword.form.errorEmailText')
            ]);
        }

        // Set reset hash
        $resetPasswordHash = $user->password_reset_hash ? $user->password_reset_hash : StringHelper::getHash(8);
        $user->password_reset_hash = $resetPasswordHash;
        $user->save();

        // Send mail
        // TODO MailHelper::resetPassword($user);

        return response()->json([
            'success' => 1,
            'successText' => __('auth.resetPassword.form.successText')
        ]);
    }

    /**
     * View for setting new password page
     */
    public function newPassword($userId, $resetPasswordHash)
    {
        $sqids = new Sqids(config('app.sqids_salt'));

        $userId = $sqids->decode($userId);
        $userId = empty($userId) ? null : $userId[0];

        $user = User::where([
            'id' => $userId,
            'password_reset_hash' => $resetPasswordHash
        ])->first();

        // No user found, error
        if (!$user) {
            session()->flash('message', [
                'color' => 'error',
                'title' => __('auth.newPassword.flashMessageErrorResetLinkExpiredTitle'),
                'description' => __('auth.newPassword.flashMessageErrorResetLinkExpiredDescription', ['route' => RouteHelper::getRoute('reset-password')]),
            ]);
            return redirect(RouteHelper::getRoute('/'));
        }

        view()->share('userId', $user->id);
        view()->share('resetPasswordHash', $user->password_reset_hash);

        view()->share('pageTitle', __('auth.newPassword.pageTitle'));
        view()->share('metaDescription', __('auth.newPassword.metaDescription'));
        view()->share('authPage', true);

        return view('pages.new-password');
    }

    /**
     * New password request
     */
    public function newPasswordRequest()
    {
        $userId = request()->get('userId');
        $resetPasswordHash = request()->get('resetPasswordHash');
        $csrf = request()->get('csrf');

        // CSRF block
        if ($csrf) {
            return response()->json([
                'error' => 1,
                'errorText' => __('app.errors.default')
            ]);
        }

        // Check for user
        $user = User::where([
            'id' => $userId,
            'password_reset_hash' => $resetPasswordHash
        ])->first();

        if (!$user) {
            return response()->json([
                'error' => 1,
                'errorText' => __('auth.newPassword.validate.errorExpired')
            ]);
        }

        $password = request()->get('password');
        $passwordRepeat = request()->get('passwordRepeat');

        // Validate password
        if (strlen($password) < 8) {
            return response()->json([
                'error' => 1,
                'errorText' => __('auth.newPassword.validate.errorPasswordMin')
            ]);
        }
        if (strlen($password) > 50) {
            return response()->json([
                'error' => 1,
                'errorText' => __('auth.newPassword.validate.errorPasswordMax')
            ]);
        }
        if ($password != $passwordRepeat) {
            return response()->json([
                'error' => 1,
                'errorText' => __('auth.newPassword.validate.errorPasswordMatch')
            ]);
        }

        // Save new password
        $user->password = Hash::make($password);
        $user->password_changed_at = new \DateTime();
        $user->password_reset_hash = null;
        $user->save();

        return response()->json([
            'success' => 1,
            'successText' => __('auth.newPassword.form.successText')
        ]);
    }

    /**
     * Handle verify email
     */
    public function verifyEmail($userId, $email, $emailVerifyHash)
    {
        $sqids = new Sqids(config('app.sqids_salt'));

        $userId = $sqids->decode($userId);
        $userId = empty($userId) ? null : $userId[0];

        $email = StringHelper::decrypt($email);

        // Get user
        $user = User::where([
            'id' => $userId,
            'email' => $email ? $email : null,
            'email_verify_hash' => $emailVerifyHash
        ])->first();

        // No user found, error
        if (!$user) {
            session()->flash('message', [
                'color' => 'error',
                'title' => __('auth.verifyEmail.flashMessageErrorTitle'),
                'description' => __('auth.verifyEmail.flashMessageErrorDescription'),
            ]);
            return redirect(RouteHelper::getRoute('/'));
        }

        // Log user in
        Auth::login($user, true);

        // Update user
        $user->email_verify_hash = null;
        $user->email_verified_at = new \DateTime();
        $user->save();

        session()->flash('message', [
            'color' => 'success',
            'title' => __('auth.verifyEmail.flashMessageSuccessTitle'),
        ]);

        return redirect('/');
    }

    /**
     * Sign out and redirect
     */
    public function signOut()
    {
        Auth::logout();

        return redirect(RouteHelper::getRoute('/'));
    }
}
