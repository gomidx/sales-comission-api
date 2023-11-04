<?php

namespace App\Repositories;

use App\Interfaces\SaleRepositoryInterface;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Collection;

class SaleRepository implements SaleRepositoryInterface
{
    public function createSale(array $sellerDetails): Sale
    {
        return Sale::create($sellerDetails);
    }

    public function getSaleById(int $saleId): ?Sale
    {
        return Sale::find($saleId);
    }

    public function getSalesBySellerId(int $sellerId): Collection
    {
        return Sale::where('seller_id', $sellerId)->get();
    }

    public function getDaySalesBySellerId(int $sellerId): Collection
    {
        return Sale::where('seller_id', $sellerId)->where('date_of_sale', date('Y-m-d'))->get();
    }

    public function getSales(): Collection
    {
        return Sale::all();
    }

    public function getDaySales(): Collection
    {
        return Sale::where('date_of_sale', date('Y-m-d'))->get();
    }

    public function deleteSale(int $sellerId): void
    {
        Sale::destroy($sellerId);
    }
}
