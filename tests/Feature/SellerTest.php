<?php

namespace Tests\Feature;

use Tests\TestCase;

class SellerTest extends TestCase
{
    public function test_create_a_seller(): void
    {
        $this->createUser();

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
        $this->createUser();

        $seller = $this->createSeller();

        $response = $this->json(
            'GET',
            '/api/seller/' . $seller->id
        );

        $response->assertStatus(200);
    }

    public function test_get_seller_list(): void
    {
        $this->createUser();

        $this->createSellers();

        $response = $this->json(
            'GET',
            '/api/seller/list'
        );

        $response->assertStatus(200);
    }

    public function test_update_a_seller(): void
    {
        $this->createUser();

        $seller = $this->createSeller();

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
        $this->createUser();

        $seller = $this->createSeller();

        $response = $this->json(
            'DELETE',
            '/api/seller/' . $seller->id
        );

        $response->assertStatus(200);
    }
}
