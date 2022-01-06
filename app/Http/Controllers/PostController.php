<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Validations\PostStoreValidation;
use App\Services\{PostService, UserService};
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    private PostService $postService;
    private UserService $userService;

    public function __construct(PostService $postService, UserService $userService)
    {
        $this->postService = $postService;
        $this->userService = $userService;
    }

    public function store(Request $request)
    {
        $validator = PostStoreValidation::formValidate($request->all());

        if (is_string($validator) && !empty($validator)) {
            return redirect('/feed')->withErrors($validator, 'feed');
        }

        try {
            $this->postService->save($validator);
            $this->userService->increaseExperience(Auth::user());

            return redirect('/feed');
        } catch (\Exception $error) {
            redirect('/feed')->with('alert', 'Deu ruim!');
        }
    }
}
