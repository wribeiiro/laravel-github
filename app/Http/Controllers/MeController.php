<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class MeController extends Controller
{
    private UserService $userService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $userService) {
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
        $userExperience = $this->userService->experience(Auth::user());
        return view('home', compact('users', 'userExperience'));
    }
}
