<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Termwind\Components\Dd;

class SocialAuthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleCallback(Request $request)
    {
        $request->validate([
            'given_name' => 'required|string|max:255',
            'family_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            // 'email' => 'required|string|email|max:255|unique:' . User::class,

        ]);

        try {
            $existingUser = User::where('provider_id', $request->sub)->first();

            if ($existingUser) {
                Auth::login($existingUser, true);
                return redirect()->intended();

            } else {
                $newUser = User::create([
                    'first_name' => $request->given_name,
                    'last_name' => $request->family_name,
                    'email' => $request->email,
                    'provider_id' => $request->sub,
                    'avatar' => $request->picture,
                    'password' => encrypt($request->sub),
                ]);

                Auth::login($newUser, true);
                event(new Registered($newUser));
                return redirect()->intended();
            }
        } catch (\Exception $e) {
            return back();
        }
    }
}