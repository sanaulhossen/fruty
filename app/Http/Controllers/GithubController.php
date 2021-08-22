<?php

namespace App\Http\Controllers;


use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Support\facades\Auth;
use Illuminate\Support\facades\Hash;
use Carbon\Carbon;
use App\User;

class GithubController extends Controller
{

    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }


    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();

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
