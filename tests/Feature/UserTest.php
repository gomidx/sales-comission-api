<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Support\Str;
use Laravel\Sanctum\Sanctum;

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
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->json(
            'GET',
            '/api/user/' . $user->id
        );

        $response->assertStatus(200);
    }

    public function test_get_user_list(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        User::factory(10)->create();

        $response = $this->json(
            'GET',
            '/api/user/list'
        );

        $response->assertStatus(200);
    }

    public function test_update_a_user(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->json(
            'PUT',
            '/api/user/' . $user->id,
            [
                'name' => fake()->name()
            ]
        );

        $response->assertStatus(200);
    }

    public function test_delete_a_user(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->json(
            'DELETE',
            '/api/user/' . $user->id
        );

        $response->assertStatus(200);
    }
}
