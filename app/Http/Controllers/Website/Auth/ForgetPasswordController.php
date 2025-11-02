<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordCodeMail;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use function Laravel\Prompts\table;

class ForgetPasswordController extends Controller
{
    public function requestView ()
    {
        return view('website.auth.forget-password');
    }

    public function sendToken (Request $request)
    {
        $request->validate([
            'phone' => ['required','string','exists:clients,phone'],
        ], [
            'phone.exists' => 'رقم الجوال غير مسجّل.'
        ]);

        // Find the client using the validated phone number
        $client = Client::where('phone', $request->phone)->first();
        if (empty($client->email)) {
            return back()->with('error', 'لا يوجد بريد إلكتروني مرتبط بهذا الحساب.');
        }

        $code = random_int(100000, 999999);
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $client->email],
            [
                'token' => $code,
                'created_at' => now()
            ]
        );

        Mail::to($client->email)->queue(new ResetPasswordCodeMail($code));

        return redirect()->route('website.password.reset', ['email' => $client->email])
        ->with('success', 'تم إرسال كود التحقق إلى بريدك الإلكتروني.');
    }

    public function resetView(Request $request) 
    {
        $request->validate([
            'email' => ['required','email','exists:clients,email'],
        ]);

        return view('website.auth.verify-code', [
            'email' => $request->email,
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => ['required','email','exists:clients,email'],
            'verification_code' => ['required','string'],
            'password' => ['required','string','min:8','confirmed'],
        ], [
            'verification_code.required' => 'كود التحقق مطلوب.',
            'password.confirmed'         => 'تأكيد كلمة المرور غير مطابق.',
        ]);

        $record = DB::table('password_reset_tokens')->where('email', $request->email)->where('token', $request->verification_code)->first();

        if (!$record) {
            return back()->with('error', 'كود التحقق غير صحيح');
        }

        if (Carbon::parse($record->created_at)->addMinutes(15)->isPast()) {
            // delete expired tokens
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return back()->with('error', 'كود التحقق منتهي الصلاحية');
        }

        $client = Client::where('email', $request->email)->first();
        $client->password = $request->password;
        $client->save();

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return redirect()->route('website.login')->with('success', 'تم تحديث كلمة المرور بنجاح. يمكنك تسجيل الدخول الآن.');
    }
}
