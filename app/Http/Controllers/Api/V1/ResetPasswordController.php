<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordCodeMail;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    public function sendResetCode(Request $request)
    {
        // Validate the incoming phone number
        $request->validate([
            'phone' => 'required|string|exists:clients,phone',
        ]);

        // Find the client using the validated phone number
        $client = Client::where('phone', $request->phone)->first();

        // cases where the user has no email
        if (!$client->email) {
            return response()->json([
                'message' => 'This account does not have an email address associated with it. Cannot send reset code.'
            ], 422);
        }

        // Generate the code and save it using the client's email
        $code = random_int(100000, 999999);
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $client->email],
            [
                'token' => $code,
                'created_at' => now()
            ]
        );
        // Queue the email to be sent to the client's email address
        Mail::to($client->email)->queue(new ResetPasswordCodeMail($code));

        return response()->json(['message' => 'Reset code sent to your email.']);
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|integer',
            'password' => 'required|min:6|confirmed',
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->code)
            ->first();

        // First, check if the record exists at all
        if (!$record) {
            return response()->json(['message' => 'Invalid reset code.'], 400);
        }

        // If it exists, then check if it's expired
        if (Carbon::parse($record->created_at)->addMinutes(15)->isPast()) {
            // delete expired tokens
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return response()->json(['message' => 'Expired reset code.'], 400);
        }

        $client = Client::where('email', $request->email)->first();
        $client->password = $request->password;
        $client->save();

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        return response()->json(['message' => 'Password has been successfully reset.']);
    }
}
