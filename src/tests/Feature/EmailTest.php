<?php

namespace Tests\Feature;

use Tests\TestCase;

class EmailTest extends TestCase
{
    public function test_get_seller_sales(): void
    {
        $this->createUser();

        $seller = $this->createSeller();

        $response = $this->json(
            'GET',
            '/api/seller/' . $seller->id . '/email'
        );

        $response->assertStatus(200);
    }

    public function test_get_all_sellers_sales(): void
    {
        $this->createUser();

        $response = $this->json(
            'GET',
            '/api/sale/list/email'
        );

        $response->assertStatus(200);
    }

    public function test_get_sellers_sales(): void
    {
        $response = $this->json(
            'GET',
            '/api/seller/list/email'
        );

        $response->assertStatus(200);
    }
}
