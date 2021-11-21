<?php

namespace App\Http\Controllers;

use App\Services\UserService;

class MeController extends Controller
{
    private UserService $userService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        UserService $userService
    ) {
        $this->middleware('auth');
        $this->userService = $userService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = $this->userService->findAll();
        $experience = $this->userService->findMyExperience();

        return view('home', compact('experience', 'users'));
    }
}
