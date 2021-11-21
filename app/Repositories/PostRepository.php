<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository
{
    private Post $post;

    public function __construct()
    {
        $this->post = new Post();
    }

    public function findAll(): mixed
    {
        return $this->post::with(['User', 'User.social', 'Like', 'Comment'])
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
    }

    public function save(array $data)
    {
        $post = $this->post;
        $post->user_id = $data['user_id'];
        $post->content = $data['content'];

        if (!$post->save()) {
            throw new \Exception('Deu ruim, chama o amir!');
        }

        return $post;
    }
}
