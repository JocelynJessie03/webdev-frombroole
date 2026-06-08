<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
{
    $googleUser = Socialite::driver('google')->user();

    $googleId = $googleUser->getId();
    $googleName = $googleUser->getName();
    $googleEmail = $googleUser->getEmail();
    $googleAvatar = $googleUser->getAvatar();

    $role = str_ends_with($googleEmail, '@frombroole.com')
        ? 'admin'
        : 'customer';

    $user = User::where('google_id', '=', $googleId, 'and')
        ->orWhere('email', $googleEmail)
        ->first();

    if (!$user) {

        $user = User::create([
            'name' => $googleName,
            'email' => $googleEmail,
            'google_id' => $googleId,
            'password' => bcrypt('google-login'),
            'role' => $role,
        ]);

        if ($role === 'customer') {
            \App\Models\Customer::create([
                'customer_ID' => fake()->unique()->numerify('CUST###'),
                'customer_name' => $googleName,
                'email' => $googleEmail,
                'phone' => '-',
                'password' => bcrypt('google-login'),
                'total_spend' => 0,
                'member_points' => 0,
                'tier' => 'Bronze',
            ]);
        }
    } else {
        if (!$user->google_id) {
            $user->update([
                'google_id' => $googleId
            ]);
        }
    }

    Auth::login($user);

    if ($user->role === 'admin') {

        return redirect('/dashboard');
    }

    return redirect('/home');
    }
}