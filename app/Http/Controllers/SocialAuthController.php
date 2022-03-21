<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SocialAuthServiceFactory;
use App\Interfaces\SocialAuthInterface;

class SocialAuthController extends Controller
{
    private SocialAuthInterface $authService;

    public function __construct(
        private SocialAuthServiceFactory $factoryService,
        Request $request
    ) {
        $this->authService = $factoryService->getClass($request->route('socialName'));
    }

    public function auth()
    {
        return $this->authService->auth();
    }

    public function callback()
    {
        return $this->authService->callback();
    }

    public function logout()
    {
        return $this->authService->logout();
    }
}
