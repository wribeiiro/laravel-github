<?php

namespace App\Repositories;

use App\Exceptions\PostNotFoundException;
use App\Models\Post;

class PostRepository
{
    public function __construct(
        private Post $post
    ) {}

    public function findAll()
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
            throw new PostNotFoundException('Deu ruim, chama o amir!');
        }

        return $post;
    }

    public function destroy(int $postId): bool
    {
        $postUser = $this->post::find($postId);

        if ($postUser === null) {
            throw new PostNotFoundException('Post not found');
        }

        if ($postUser->user_id != auth()->id()) {
            throw new \Exception('User does not permission to delete this post');
        }

        return $postUser->delete();
    }
}
