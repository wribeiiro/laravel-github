<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Socialite;
use Auth;

class GithubAuthController extends Controller
{

    public function githubAuth()
    {
        return Socialite::driver('github')->redirect();
    }
       
    public function callbackGithub()
    {
        try {
            $githubUser = Socialite::driver('github')->user();
            $findUser = User::where('git_id', $githubUser->id)->first();
      
            if ($findUser) {
                Auth::login($findUser);
                return redirect('/home');
            } 

            $user = User::create([
                'name' => $githubUser->name,
                'email' => $githubUser->email,
                'git_id'=> $githubUser->id,
                'oauth_type'=> 'github_oauth',
                'avatar' => $githubUser->avatar,
                'nickname' => $githubUser->nickname,
                'password' => encrypt('555555555555'),
            ]);
    
            Auth::login($user);

            return redirect('/home');

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
