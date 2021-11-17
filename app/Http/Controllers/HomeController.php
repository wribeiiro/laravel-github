<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ExperienceService;
use stdClass;

class HomeController extends Controller
{
    /**
     * @var ExperienceService
     */
    private $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ExperienceService $experience)
    {
        $this->service = $experience;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $experience = new stdClass;
        $experience->level = $this->service->myLevel();
        $experience->xp = $this->service->myXp();
        $experience->xpnextlevel = $this->service->totalXpNextLevel();
        $experience->progress = $this->service->calculateProgress();

        $users = \App\Models\User::with(['social'])->get();

        return view('home', compact('experience', 'users'));
    }
}
