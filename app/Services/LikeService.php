<?php

namespace App\Services;

use App\Repositories\LikeRepository;
use Illuminate\Support\Facades\Auth;

class LikeService
{
    public function __construct(
        private LikeRepository $likeRepository
    ) {}

    /**
     * findAll
     *
     * @return array
     */
    public function findAll()
    {
        return $this->likeRepository->findAll();
    }

    /**
     * findFirst
     *
     * @return array
     */
    public function findFirst(array $data)
    {
        $newData = [
            'user_id' => Auth::user()->id,
            'post_id' => (int) $data['post_id']
        ];

        return $this->likeRepository->findFirst($newData);
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
            'post_id' => (int) $data['post_id']
        ];

        return $this->likeRepository->save($newData);
    }

    public function countLikesByPost(int $postId): int
    {
        return $this->likeRepository->countLikesByPost($postId);
    }
}
