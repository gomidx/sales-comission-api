<?php

namespace Tests\Feature;

use App\Http\Controllers\AuthController;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testGenerateToken()
    {
        $authService = $this->getMockBuilder(AuthService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $authService->expects($this->once())
            ->method('generateToken');

        $authController = new AuthController();

        $authController->service = $authService;

        $user = $this->createUser();

        $loginRequest = new LoginRequest([
            'email' => $user->email,
            'password' => $user->password
        ]);

        $response = $authController->generateToken($loginRequest);

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    public function testLogout()
    {
        $authService = $this->getMockBuilder(AuthService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $authService->expects($this->once())
            ->method('logout')
            ->willReturn(['code' => 200, 'response' => ['data' => 'Successfully disconnected.']]);

        $authController = new AuthController();

        $authController->service = $authService;

        $user = $this->createUser();

        $response = $authController->logout();

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertEquals(['data' => 'Successfully disconnected.'], json_decode($response->getContent(), true));
    }
}
