<?php

namespace Tests;

use App\Models\Sale;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Sanctum\Sanctum;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function createUser(): User
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        return $user;
    }

    protected function createSeller(): Seller
    {
        return Seller::factory()->create();
    }

    protected function createSellers(): void
    {
        Seller::factory(10)->create();
    }

    protected function createSale(): Sale
    {
        return Sale::factory()->create();
    }

    protected function createSales(): void
    {
        Sale::factory(10)->create();
    }

    protected function createSalesForSpecificSeller(int $sellerId): void
    {
        Sale::factory(10)->create(['seller_id' => $sellerId]);
    }
}
