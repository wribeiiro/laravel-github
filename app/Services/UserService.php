<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    const EXPERIENCE_TO_UP = 250;

    public function __construct(
        private UserRepository $userRepository
    ) {}

    /**
     * findAll
     *
     * @return array
     */
    public function findAll()
    {
        return $this->userRepository->findAll()
            ->sortBy('level', SORT_REGULAR, true)
            ->values()
            ->all();
    }

    public function increaseExperience(object $user)
    {
        $newXp = $user->experience + rand(4, 70);
        $level = $user->level;

        if ($newXp >= self::EXPERIENCE_TO_UP) {
            $level = $level + 1;
            $newXp = 0;
        }

        $userData['experience'] = $newXp;
        $userData['level'] = $level;
        $userData['user_id'] = $user->id;

        return $this->userRepository->increaseExperience($userData);
    }

    public function experience(object $user): object
    {
        $objectUser = new \stdClass();
        $objectUser->progressLevel = ($user->experience / self::EXPERIENCE_TO_UP) * 100;
        $objectUser->experience = $user->experience;
        $objectUser->level = $user->level;
        $objectUser->experienceToUp = self::EXPERIENCE_TO_UP;

        return $objectUser;
    }
}
