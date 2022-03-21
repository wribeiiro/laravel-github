<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function __construct(
        private User $user
    ) {}

    public function findAll()
    {
        return $this->user::with(['social'])->get();
    }

    public function increaseExperience(array $data)
    {
        $result = $this->user
            ->where('id', $data['user_id'])
            ->update([
                'experience' => $data['experience'],
                'level' => $data['level']
            ]);

        if (!$result) {
            throw new \Exception('Deu ruim, chama o amir!');
        }

        return $result;
    }
}
