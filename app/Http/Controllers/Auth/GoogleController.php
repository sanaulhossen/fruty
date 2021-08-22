<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\facades\Auth;
use Illuminate\Support\facades\Hash;
use Carbon\Carbon;
use App\User;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();

        if (!User::where('email', $user->getEmail())->exists()) {
            User::insert([
                'name'          => $user->getName(),
                'email'         => $user->getEmail(),
                'password'      => Hash::make('abc@123'),
                'role'          => 2,
                'created_at'    => Carbon::now()
            ]);
        }

        if (Auth::attempt(['email' => $user->getEmail(), 'password' => 'abc@123'])) {
            return redirect('profile/page');
        }
    }
}
