<?php

namespace App\Services;

use App\Interfaces\SocialAuthInterface;
use App\Models\{User, SocialUser};
use Exception;
use Auth;
use Laravel\Socialite\Facades\Socialite;

class DiscordAuthService implements SocialAuthInterface
{
    public function auth()
    {
        return Socialite::driver('discord')->redirect();
    }

    public function callback()
    {
        try {
            $discordUser = Socialite::driver('discord')->stateless()->user();
            $findUser = User::where('email', $discordUser->email)->first();

            if ($findUser) {

                SocialUser::create([
                    'user_id' => $findUser->id,
                    'social_id' => $discordUser->id,
                    'social_type' => 'discord',
                    'avatar' => $discordUser->avatar,
                    'nickname' => $discordUser->nickname,
                ]);

                $findUser = User::with('social')->where('email', $discordUser->email)->first();

                return redirect('/feed');
            }
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function logout()
    {
        try {
            $findSocialUser = SocialUser::where([
                'user_id' => Auth::user()->id,
                'social_type' => 'discord'
            ]);

            if ($findSocialUser) {
                $findSocialUser->delete();
                return redirect('/feed');
            }
        } catch (Exception $e) {
            dd($e);
        }
    }
}
