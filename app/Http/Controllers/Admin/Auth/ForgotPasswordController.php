<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function showLinkRequestForm()
    {
        // استخدم المسار الصحيح للـ Blade لو داخل مجلد admin
        return view('auth.passwords.email');
    }

    public function broker()
    {
        return Password::broker('admins');
    }

    /**
     * Send the password reset link email to the admin user.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        // Send the password reset link using the custom broker
        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($request, $response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }

    /**
     * Override the success response after sending the reset link.
     */
    protected function sendResetLinkResponse(Request $request, $response)
    {
        return back()->with('status', trans($response));
    }

    /**
     * Override the failure response if sending the reset link fails.
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => trans($response)]);
    }

    /**
     * Make sure the notification email uses the correct route (admin.password.reset)
     */
    protected function sendResetLink($user, $token)
    {
        $resetUrl = route('admin.password.reset', ['token' => $token, 'email' => $user->getEmailForPasswordReset()]);
        $user->sendPasswordResetNotification($token, $resetUrl);
    }
}
