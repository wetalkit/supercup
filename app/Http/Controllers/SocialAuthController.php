<?php

namespace App\Http\Controllers;

use App\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

class SocialAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(Request $request)
    {
        if (!$request->has('code') || $request->has('denied')) {
            return redirect('/');
        }

        $providerUser = \Socialite::driver('facebook')->user();

        if (!$user = User::where('fb_id', object_get($providerUser, 'id'))->first()) {
            
            if (!$fbEmail = object_get($providerUser, 'email')) {
                $fbEmail = object_get($providerUser, 'id').'@facebook.com';
            }

            $user = User::create([
                'name' => object_get($providerUser, 'name'),
                'email' => $fbEmail,
                'fb_id' => object_get($providerUser, 'id'),
                'fb_link' => object_get($providerUser, 'profileUrl'),
                'fb_avatar' => object_get($providerUser, 'avatar'),
                'fb_token' => object_get($providerUser, 'token'),
                'verified' => array_get(object_get($providerUser, 'user'), 'verified'),
                'gender' => array_get(object_get($providerUser, 'user'), 'gender'),
            ]);
        }

        auth()->login($user);

        return redirect()->back();
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->to('/');
    }
}
