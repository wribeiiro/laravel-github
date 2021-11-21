<?php

namespace App\Services;

use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Auth;

class PostService
{
    private PostRepository $postRepository;

    public function __construct(
        PostRepository $postRepository
    ) {
        $this->postRepository = $postRepository;
    }

    /**
     * findAll
     *
     * @return array
     */
    public function findAll()
    {
        return $this->postRepository->findAll();
    }

    /**
     * save
     *
     * @param array $data
     * @return void
     */
    public function save(array $data)
    {
        $newData = [
            'user_id' => Auth::user()->id,
            'content' => htmlspecialchars($data['content'], ENT_QUOTES)
        ];

        return $this->postRepository->save($newData);
    }
}
