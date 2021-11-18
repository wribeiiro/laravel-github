<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ExperienceService;
use stdClass;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $experienceService = new ExperienceService(Auth::user()->id);
        $experienceService->setUserId(Auth::user()->id);

        $experience = new stdClass;
        $experience->level = $experienceService->level();
        $experience->xp = $experienceService->xp();
        $experience->xpnextlevel = $experienceService->totalXpNextLevel();
        $experience->progress = $experienceService->calculateProgress();

        $users = \App\Models\User::with(['social'])->get();
        $experienceService = new ExperienceService();

        $newUsers = collect();
        foreach ($users as $user) {
            $experienceService->setUserId($user->id);

            $newUser = $user;
            $newUser['xp'] = $experienceService->xp();
            $newUsers->push($newUser);
        }

        $users = $newUsers->sortBy('xp', SORT_REGULAR, true)
            ->values()
            ->all();

        return view('home', compact('experience', 'users'));
    }
}
