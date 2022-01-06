<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Interfaces\SocialAuthInterface;
use App\Services\DiscordAuthService;

class DiscordAuthServiceFactoryTest extends TestCase
{

    private DiscordAuthService $authService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authService = new DiscordAuthService();
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
        $response = $this->get('/social/auth/discord');
        $response->assertStatus(302);
    }
}
