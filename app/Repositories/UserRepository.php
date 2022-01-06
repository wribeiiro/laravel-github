<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    private User $userModel;

    public function __construct() 
    {
        $this->userModel = new User();
    }

    public function findAll()
    {
        return $this->userModel::with(['social'])->get();
    }

    public function increaseExperience(array $data)
    {
        $result = $this->userModel
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
