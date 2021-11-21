<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Services\ExperienceService;
use Illuminate\Support\Facades\Auth;

class UserService
{
    private UserRepository $userRepository;
    private ExperienceService $experienceService;

    public function __construct(
        UserRepository $userRepository,
        ExperienceService $experienceService
    ) {
        $this->userRepository = $userRepository;
        $this->experienceService = $experienceService;
    }

    /**
     * findAll
     *
     * @return array
     */
    public function findAll()
    {
        $usersCollection = collect();
        foreach ($this->userRepository->findAll() as $user) {
            $this->experienceService->setUserId($user->id);

            $users = $user;
            $users['xp'] = $this->experienceService->xp();
            $usersCollection->push($users);
        }

        return $usersCollection->sortBy('xp', SORT_REGULAR, true)
            ->values()
            ->all();
    }

    /**
     * findMyExperience
     *
     * @return object
     */
    public function findMyExperience(): object
    {
        $this->experienceService->setUserId(Auth::user()->id);

        return $this->experienceService->experience();
    }
}
