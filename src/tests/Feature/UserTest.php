<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Str;

class UserTest extends TestCase
{
    public function test_create_a_user(): void
    {
        $response = $this->json(
            'POST',
            '/api/user',
            [
                'name' => fake()->name(),
                'email' => fake()->email(),
                'password' => Str::random(20)
            ]
        );

        $response->assertStatus(201);
    }

    public function test_get_a_user(): void
    {
        $user = $this->createUser();

        $response = $this->json(
            'GET',
            '/api/user/' . $user->email
        );

        $response->assertStatus(200);
    }
}
