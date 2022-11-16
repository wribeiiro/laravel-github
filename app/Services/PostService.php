<?php

namespace App\Services;

use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Auth;

class PostService
{
    public function __construct(
        private PostRepository $postRepository
    ) {}

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

    public function destroy(int $postId): bool
    {
        return $this->postRepository->destroy($postId);
    }
}
