<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\SocialAuthServiceFactory;
use App\Interfaces\SocialAuthInterface;
use App\Exceptions\SocialAuthNotFoundException;

class SocialAuthServiceFactoryTest extends TestCase
{
    private SocialAuthServiceFactory $factory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->factory = new SocialAuthServiceFactory();
    }

    /**
     * @test
     */
    public function testShouldReturnAnSocialAuthInterface()
    {
        $factory = $this->factory->getClass('discord');

        $this->assertInstanceOf(SocialAuthInterface::class, $factory);
    }

    /**
     * @test
     */
    public function testShouldReturnAException()
    {
        $this->expectException(SocialAuthNotFoundException::class);
        $this->expectExceptionMessage('SocialAuth service not implemented');
        $this->factory->getClass('exception');
    }
}
