<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\UserService;
use App\Repositories\UserRepository;

class UserServiceTest extends TestCase
{

    private UserService $userService;

    protected function setUp(): void
    {
        parent::setUp();
        //$this->userService = new UserService();
    }

    /**
     * @test
     */
    public function testShouldReturnAllUsers()
    {
        //$users = $this->userService->getAll();

    }
}
