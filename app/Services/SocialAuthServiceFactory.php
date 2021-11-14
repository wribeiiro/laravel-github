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
        switch (strtolower($authName)) {
            case 'discord':
                return new DiscordAuthService();
            case 'github':
                return new GithubAuthService();
            default:
                throw new SocialAuthNotFoundException('SocialAuth service not implemented');
                break;
        }
    }
}
