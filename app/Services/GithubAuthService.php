<?php

namespace App\Services;

use App\Interfaces\SocialAuthInterface;
use App\Models\{User, SocialUser};
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Auth;

class GithubAuthService implements SocialAuthInterface
{
    public function auth()
    {
        return Socialite::driver('github')->redirect();
    }

    public function callback()
    {
        try {
            $githubUser = Socialite::driver('github')
                ->setScopes(['read:user'])
                ->stateless()->user();

            $findUser = User::with(['social' => function ($q) {
                $q->where('social_type', '=', 'github');
            }])->where('email', $githubUser->email)->first();

            if ($findUser) {
                Auth::login($findUser);
                return redirect('/feed');
            }

            $user = User::create([
                'name' => $githubUser->name,
                'email' => $githubUser->email,
                'password' => encrypt('555555555555'),
            ]);

            SocialUser::create([
                'user_id' => $user->id,
                'social_id' => $githubUser->id,
                'social_type' => 'github',
                'avatar' => $githubUser->avatar,
                'nickname' => $githubUser->nickname,
                'description' => $githubUser->user['bio']
            ]);

            $findUser = User::with(['social' => function ($q) {
                $q->where('social_type', '=', 'github');
            }])->where('email', $githubUser->email)->first();

            Auth::login($findUser);

            return redirect('/feed');
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function logout()
    {
        try {
            $findSocialUser = SocialUser::where([
                'user_id' => Auth::user()->id,
                'social_type' => 'github'
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
