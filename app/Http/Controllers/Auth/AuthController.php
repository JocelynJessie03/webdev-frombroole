<?php

namespace App\Http\Controllers\Auth;

use App\Models\EmailOtp;
use App\Models\User;
use App\Mail\SendOtpMail;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {

                return redirect('/dashboard');
            }

            return redirect('/home'); //nnt buat pelanggan
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

public function sendForgotOtp(Request $request)
{
    $request->validate([
        'email' => ['required', 'email', 'exists:users,email'],
    ], [

        'email.exists' => 'No account found with this email.',
    ]);

    $otp = rand(100000, 999999);

    // EmailOtp::where('email', '=', $request->email, 'and')->delete();
    EmailOtp::query()
    ->where('email', $request->email)
    ->delete();

    EmailOtp::create([
        'name' => 'reset',
        'email' => $request->email,
        'password' => 'reset',
        'otp' => $otp,
        'expires_at' => now()->addMinutes(5),
    ]);

    Mail::to($request->email)->send(new SendOtpMail($otp));

    session([
        'reset_email' => $request->email,
    ]);

    return redirect('/verify-reset-otp');
}

public function resetPassword(Request $request)
{
    $request->validate([
        'otp' => ['required'],
        'password' => [
            'required',
            'min:8',
            'regex:/[0-9]/',
        ],
    ], [

        'password.min' => 'Password must be at least 8 characters.',

        'password.regex' => 'Password must contain at least one number.',
    ]);

    $email = session('reset_email');

    $record = EmailOtp::query()
    ->where('email', $email)
    ->where('otp', $request->otp)
    ->first();

    if (!$record) {

        return back()->withErrors([
            'otp' => 'Invalid OTP code.',
        ]);
    }

    if (now()->greaterThan($record->expires_at)) {

        EmailOtp::destroy($record->id);

        return back()->withErrors([
            'otp' => 'OTP expired.',
        ]);
    }

    $user = User::query()
    ->where('email', $email)
    ->first();

    $user->update([
        'password' => Hash::make($request->password),
    ]);

    EmailOtp::destroy($record->id);

    return redirect('/login')->with([
        'success' => 'Password reset successful.',
    ]);
}

    public function sendOtp(Request $request)
{
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => [
                'required',
                'unique:users,phone',
                'regex:/^08[0-9]+$/',
                'min:10',
            ],
            'password' => [
                'required',
                'min:8',
                'regex:/[0-9]/',
            ],
    ], [

        'email.unique' => 'This email is already registered.',

        'phone.unique' => 'This phone number is already registered.',

        'phone.regex' => 'Phone number must start with 08 and contain only numbers.',

        'phone.min' => 'Phone number is too short.',

        'password.min' => 'Password must be at least 8 characters.',

        'password.regex' => 'Password must contain at least one number.',
    ]);

    $otp = rand(100000, 999999);

    EmailOtp::query()
    ->where('email', $validated['email'])
    ->delete();

    EmailOtp::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'phone' => $validated['phone'],
        'password' => Hash::make($validated['password']),
        'otp' => $otp,
        'expires_at' => now()->addMinutes(5),
    ]);

    Mail::to($validated['email'])->send(new SendOtpMail($otp));

    session([
        'otp_email' => $validated['email'],
    ]);

    return redirect('/verify-otp');
}

public function verifyOtp(Request $request)
{
    $request->validate([
        'otp' => ['required'],
    ]);

    $email = session('otp_email');

   $record = EmailOtp::query()
    ->where('email', $email)
    ->where('otp', $request->otp)
    ->first();

    if (!$record) {
        return back()->withErrors([
            'otp' => 'Invalid OTP code.',
        ]);
    }

    if (now()->greaterThan($record->expires_at)) {

        EmailOtp::destroy($record->id);

        return back()->withErrors([
            'otp' => 'OTP expired.',
        ]);
    }

    $role = str_ends_with($record->email, '@frombroole.com')
    ? 'admin'
    : 'customer'; // check if email ends with @frombroole.com then it is an admin

    $user = User::create([
        'name' => $record->name,
        'email' => $record->email,
        'phone' => $record->phone,
        'password' => $record->password,
        'role' => $role,
    ]);

    EmailOtp::destroy($record->id);

    Auth::login($user);

    return redirect('/dashboard');
}

public function verifyResetOtp(Request $request)
{
    $request->validate([
        'otp' => ['required'],
    ]);

    $email = session('reset_email');

    $record = EmailOtp::query()
    ->where('email', $email)
    ->where('otp', $request->otp)
    ->first();

    if (!$record) {

        return back()->withErrors([
            'otp' => 'Invalid OTP code.',
        ]);
    }

    if (now()->greaterThan($record->expires_at)) {

        EmailOtp::destroy($record->id);

        return back()->withErrors([
            'otp' => 'OTP expired.',
        ]);
    }

    session([
        'verified_reset_email' => $email,
    ]);

    return redirect('/new-password');
}

public function updatePassword(Request $request)
{
    $request->validate([
        'password' => [
            'required',
            'confirmed',
            'min:8',
            'regex:/[0-9]/',
        ],
    ], [

        'password.confirmed' => 'Password confirmation does not match.',

        'password.min' => 'Password must be at least 8 characters.',

        'password.regex' => 'Password must contain at least one number.',
    ]);

    $email = session('verified_reset_email');

    // $user = User::where('email', '=', $email, 'and')->first();
    $user = User::query()
    ->where('email', $email)
    ->first();

    if (!$user) {

        return redirect('/forgot-password');
    }

    $user->update([
        'password' => Hash::make($request->password),
    ]);

    // EmailOtp::where('email', '=', $email, 'and')->delete();
    EmailOtp::query()
    ->where('email', $email)
    ->delete();
    

    $request->session()->forget([
        'reset_email',
        'verified_reset_email',
    ]);

    return redirect('/login')->with([
        'success' => 'Password updated successfully.',
    ]);
}

public function resendOtp(Request $request)
{
    $email = session('otp_email');

    if (!$email) {

        return response()->json([
            'success' => false
        ]);
    }

    $otp = rand(100000, 999999);

    // $record = EmailOtp::where('email', '=', $email, 'and')->first();
    $record = EmailOtp::query()
    ->where('email', $email)
    ->first();

    if (!$record) {

        return response()->json([
            'success' => false
        ]);
    }

    $record->update([
        'otp' => $otp,
        'expires_at' => now()->addMinutes(5),
    ]);

    Mail::to($email)->send(new SendOtpMail($otp));

    return response()->json([
        'success' => true
    ]);
}

public function resendResetOtp()
{
    $email = session('reset_email');

    if (!$email) {

        return response()->json([
            'success' => false
        ]);
    }

    $otp = rand(100000, 999999);

    $record = EmailOtp::query()
    ->where('email', $email)
    ->first();

    if (!$record) {

        return response()->json([
            'success' => false
        ]);
    }

    $record->update([
        'otp' => $otp,
        'expires_at' => now()->addMinutes(5),
    ]);

    Mail::to($email)->send(new SendOtpMail($otp));

    return response()->json([
        'success' => true
    ]);
}

}