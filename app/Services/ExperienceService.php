<?php

namespace App\Services;
use App\Models\ActivityUser;
use Auth;

class ExperienceService
{
    const LIMIT_XP_TO_UP = [1200, 2500, 4000, 6750, 7345, 8123, 9000, 12000, 15000, 20000];

    public function __construct()
    {
        
    }

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
        return 1;
    }

    /**
     * Retrieve the limit value to up next Level
     *
     * @return integer
     */
    public function limitToUp(): int
    {
        return 1200;
    }

    /**
     * Retrieve the value to progressbar
     *
     * @return integer
     */
    public function calculateProgress(): int
    {
        return ($this->myXp() / $this->limitToUp()) * 100;
    }
}
