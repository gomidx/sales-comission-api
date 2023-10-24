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

    public function getSaleById(int $saleId): Sale
    {
        return Sale::find($saleId);
    }

    public function getSalesBySellerId(int $sellerId)
    {
        return Sale::where('seller_id', $sellerId)->all();
    }

    public function getSales(): Collection
    {
        return Sale::all();
    }

    public function updateSale(int $sellerId, array $newDetails): Sale
    {
        return Sale::whereId($sellerId)->update($newDetails);
    }

    public function deleteSale(int $sellerId): void
    {
        Sale::destroy($sellerId);
    }
}
