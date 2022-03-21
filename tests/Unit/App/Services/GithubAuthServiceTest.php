<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Interfaces\SocialAuthInterface;
use App\Services\GithubAuthService;

class GithubAuthServiceFactoryTest extends TestCase
{

    private GithubAuthService $authService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authService = new GithubAuthService();
    }

    /**
     * @test
     */
    public function testShouldReturnAnSocialAuthInterface()
    {
        $this->assertInstanceOf(SocialAuthInterface::class, $this->authService);
    }

    /**
     * @test
     */
    public function testShouldRedirectAuthToDiscordWithSuccess()
    {
        $response = $this->get('/social/auth/github');
        $response->assertStatus(302);
    }
}
