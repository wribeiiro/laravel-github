<?php

namespace App\Repositories;

use App\Exceptions\LikeNotFoundException;
use App\Models\Like;

class LikeRepository
{
    public function __construct(
        private Like $like
    ) {}

    public function findFirst(array $data)
    {
        return $this->like::where($data)->first();
    }

    public function findAll(): mixed
    {
        return $this->post::with(['User', 'User.social', 'Like', 'Comment'])
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
    }

    /**
     * @throws LikeNotFoundException
     */
    public function save(array $data)
    {
        $like = $this->like;
        $like->user_id = $data['user_id'];
        $like->post_id = $data['post_id'];

        if (!$like->save()) {
            throw new LikeNotFoundException('Deu ruim, chama o amir!');
        }

        return $like;
    }

    public function countLikesByPost(int $postId): int
    {
        return Like::where(['post_id' => $postId])->count();
    }
}
