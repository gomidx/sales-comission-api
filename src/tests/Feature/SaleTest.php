<?php

namespace Tests\Feature;

use Tests\TestCase;

class SaleTest extends TestCase
{
    public function test_create_a_sale(): void
    {
        $this->createUser();

        $seller = $this->createSeller();

        $response = $this->json(
            'POST',
            '/api/sale',
            [
                'total_value' => rand(0, 500),
                'date_of_sale' => fake()->date(),
                'seller_id' => $seller->id
            ]
        );

        $response->assertStatus(201);
    }

    public function test_get_a_sale(): void
    {
        $this->createUser();

        $sale = $this->createSale();

        $response = $this->json(
            'GET',
            '/api/sale/' . $sale->id
        );

        $response->assertStatus(200);
    }

    public function test_get_sale_list(): void
    {
        $this->createUser();

        $this->createSales();

        $response = $this->json(
            'GET',
            '/api/sale/list'
        );

        $response->assertStatus(200);
    }

    public function test_get_sale_list_by_seller(): void
    {
        $this->createUser();

        $seller = $this->createSeller();

        $this->createSalesForSpecificSeller($seller->id);

        $response = $this->json(
            'GET',
            '/api/seller/' . $seller->id . '/sales'
        );

        $response->assertStatus(200);
    }

    public function test_delete_a_sale(): void
    {
        $this->createUser();

        $sale = $this->createSale();

        $response = $this->json(
            'DELETE',
            '/api/sale/' . $sale->id
        );

        $response->assertStatus(200);
    }
}
