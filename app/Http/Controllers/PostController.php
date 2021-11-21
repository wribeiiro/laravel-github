<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Validations\PostStoreValidation;
use App\Services\PostService;

class PostController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function store(Request $request)
    {
        $validator = PostStoreValidation::formValidate($request->all());

        if (is_string($validator) && !empty($validator)) {
            return redirect('/feed')->withErrors($validator, 'feed');
        }

        try {
            $this->postService->save($validator);

            return redirect('/feed');
        } catch (\Exception $error) {
            redirect('/feed')->with('alert', 'Deu ruim!');
        }
    }
}
