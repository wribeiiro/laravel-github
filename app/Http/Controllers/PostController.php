<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Validations\PostStoreValidation;
use App\Services\{PostService, UserService};
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct(
        private PostService $postService, 
        private UserService $userService
    ) {}

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

    public function destroy(Request $request)
    {
        try {
            $this->postService->destroy($request->all()['post_id']);
            
            return response()->json([
                'data' => [],
                'status' => Response::HTTP_NO_CONTENT
            ], Response::HTTP_NO_CONTENT);
        } catch (\Exception $error) {
            return response()->json([
                'data' => $error,
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
