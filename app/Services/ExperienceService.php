<?php

namespace App\Services;

use App\Models\ActivityUser;
use Auth;

class ExperienceService
{
    const BASE_NEXT_XP = 250;

    /**
     * Retrieve current Experience
     *
     * @return integer
     */
    public function myXp(): int
    {
        return ActivityUser::where('user_id', '=', Auth::user()->id)->count() * 10;
    }

    /**
     * Retrieve current Level
     *
     * @return integer
     */
    public function myLevel(): int
    {
        return floor(log($this->myXp() / self::BASE_NEXT_XP + 1, 2));
    }

    /**
     * Retrieve the limit value to up next Level
     *
     * @return integer
     */
    public function limitToUp(): int
    {
        return self::BASE_NEXT_XP * pow(2, $this->myLevel() - 1);
    }

    /**
     * Retrieve the value to progressbar
     *
     * @return integer
     */
    public function calculateProgress(): int
    {
        return ($this->myXp() / $this->totalXpNextLevel()) * 100;
    }

    /**
     * Retrieve the xp to up to next level
     *
     * @return integer
     */
    public function totalXpNextLevel(): int
    {
        $totalXpNextLevel = self::BASE_NEXT_XP * (pow(2, $this->myLevel() + 1) - 1);
        return $totalXpNextLevel - $this->myXp();
    }
}
