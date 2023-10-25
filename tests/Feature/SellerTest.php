<?php

namespace Tests\Feature;

use App\Models\Seller;
use App\Models\User;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class SellerTest extends TestCase
{
    public function test_create_a_seller(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->json(
            'POST',
            '/api/seller',
            [
                'name' => fake()->name(),
                'email' => fake()->email()
            ]
        );

        $response->assertStatus(201);
    }

    public function test_get_a_seller(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $seller = Seller::factory()->create();

        $response = $this->json(
            'GET',
            '/api/seller/' . $seller->id
        );

        $response->assertStatus(200);
    }

    public function test_get_seller_list(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        Seller::factory(10)->create();

        $response = $this->json(
            'GET',
            '/api/seller/list'
        );

        $response->assertStatus(200);
    }

    public function test_update_a_seller(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $seller = Seller::factory()->create();

        $response = $this->json(
            'PUT',
            '/api/seller/' . $seller->id,
            [
                'name' => fake()->name()
            ]
        );

        $response->assertStatus(200);
    }

    public function test_delete_a_seller(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $seller = Seller::factory()->create();

        $response = $this->json(
            'DELETE',
            '/api/seller/' . $seller->id
        );

        $response->assertStatus(200);
    }
}
