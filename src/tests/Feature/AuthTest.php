<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Str;

class AuthTest extends TestCase
{
    public function test_generate_token(): void
    {
        $email = fake()->email();
        $password = Str::random(20);

        $this->json(
            'POST',
            '/api/user',
            [
                'name' => fake()->name(),
                'email' => $email,
                'password' => $password
            ]
        );

        $response = $this->json(
            'POST',
            '/api/token',
            [
                'email' => $email,
                'password' => $password
            ]
        );

        $response->assertStatus(200);
    }

    public function test_logout(): void
    {
        $this->createUser();

        $response = $this->json(
            'POST',
            '/api/logout'
        );

        $response->assertStatus(200);
    }
}
