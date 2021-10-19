<?php

namespace App\Services;

use App\Interfaces\SocialAuthInterface;
use InvalidArgumentException;

class SocialAuthServiceFactory
{
    public function getClass(string $authName): SocialAuthInterface
    {
        switch (strtolower($authName)) {
            case 'discord':
                return new DiscordAuthService();
            case 'github':
                return new GithubAuthService();
            default:
                throw new InvalidArgumentException('Auth service not implemented');
                break;
        }
    }
}
