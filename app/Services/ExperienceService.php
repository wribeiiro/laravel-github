<?php

namespace App\Services;

use App\Models\Post;

class ExperienceService
{
    const BASE_NEXT_XP = 250;

    private int $userId = 0;

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;
        return $this;
    }
    /**
     * Retrieve current Experience
     *
     * @return integer
     */
    public function xp(): int
    {
        return Post::where('user_id', '=', $this->userId)->count() * 10;
    }

    /**
     * Retrieve current Level
     *
     * @return integer
     */
    public function level(): int
    {
        return floor(log($this->xp() / self::BASE_NEXT_XP + 1, 2));
    }

    /**
     * Retrieve the limit value to up next Level
     *
     * @return integer
     */
    public function limitToUp(): int
    {
        return self::BASE_NEXT_XP * pow(2, $this->level() - 1);
    }

    /**
     * Retrieve the value to progressbar
     *
     * @return integer
     */
    public function calculateProgress(): int
    {
        return ($this->xp() / $this->totalXpNextLevel()) * 100;
    }

    /**
     * Retrieve the xp to up to next level
     *
     * @return integer
     */
    public function totalXpNextLevel(): int
    {
        $totalXpNextLevel = self::BASE_NEXT_XP * (pow(2, $this->level() + 1) - 1);
        return $totalXpNextLevel - $this->xp();
    }

    public function experience(): object
    {
        $experience = new \stdClass();

        $experience->level = $this->level();
        $experience->xp = $this->xp();
        $experience->xpnextlevel = $this->totalXpNextLevel();
        $experience->progress = $this->calculateProgress();

        return $experience;
    }
}
