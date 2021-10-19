<?php

namespace App\Interfaces;

interface SocialAuthInterface
{
    public function auth();
    public function callback();
    public function logout();
}
