<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function forgotPasswordPage()
    {
        return view('auth.forgot-password');
    }

    public function forgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'created_at' => now(),
            ]
        );

        $resetLink = route('showResetForm', [$token, $request->email]);

        $subject = "Reset Password Request";
        $message = "Click the button below to reset your password";

        Mail::to($request->email)->send(new ResetEmail($subject, $message, $resetLink));

        return back()->with(['success' => 'Email sent successfully!']);
    }

    public function showResetForm($token, $email)
    {
        // find token & email
        $record = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->where('token', $token)
            ->first();

        if (!$record) {
            return "not found";
        }

        // Token expiry check (e.g., 60 minutes)
        $expiresAt = now()->subMinutes(60);
        if ($record->created_at < $expiresAt) {
            // delete expired token
            DB::table('password_reset_tokens')->where('email', $email)->delete();
            return redirect()->route('forgotPasswordPage')->with(['error' => 'This reset link has expired']);
        }

        return view('auth.reset-password', ['token' => $token, 'email' => $email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required|string',
            'password' => 'required|confirmed|min:8', // enforce min length & confirmed
        ]);

        $email = $request->input('email');
        $token = $request->input('token');

        $record = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->where('token', $token)
            ->first();

        if (!$record) {
            return redirect()->back()->with(['error' => 'This reset link has expired.']);
        }

        // Update user's password
        $user = User::where('email', $email)->first();
        $user->password = $request->password;
        $user->save();

        // delete token after successful reset
        DB::table('password_reset_tokens')->where('email', $email)->delete();

        return redirect()->route('login')->with(['success' => 'Your password has been reset successfully.']);
    }
}
