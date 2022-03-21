<?php

namespace App\Services;

use App\Interfaces\SocialAuthInterface;
use App\Exceptions\SocialAuthNotFoundException;

class SocialAuthServiceFactory
{
    /**
     * @throws SocialAuthNotFoundException
     */
    public function getClass(string $authName): SocialAuthInterface
    {
        return match (strtolower($authName)) {
            'discord' => new DiscordAuthService(),
            'github' => new GithubAuthService(),
            default => throw new SocialAuthNotFoundException('SocialAuth service not implemented')
        };
    }
}
