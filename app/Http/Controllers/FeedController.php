<?php

namespace App\Http\Controllers;

use App\Services\PostService;

class FeedController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->middleware('auth');

        $this->postService = $postService;
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
