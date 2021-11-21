<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function findAll(): mixed
    {
        return User::with(['social'])->get();
    }
}
