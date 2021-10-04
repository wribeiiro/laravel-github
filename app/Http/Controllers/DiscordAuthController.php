<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SocialUser;
use Exception;
use Socialite;
use Auth;

class DiscordAuthController extends Controller
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

                return redirect('/home');
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
                return redirect('/home');
            } 

        } catch (Exception $e) {
            dd($e);
        }
    }
}
