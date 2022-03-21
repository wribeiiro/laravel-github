<?php

namespace App\Http\Controllers;

use App\Services\PostService;

class FeedController extends Controller
{
    public function __construct(
        private PostService $postService
    ) {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postService->findAll();

        return view('feed', compact('posts'));
    }
}
