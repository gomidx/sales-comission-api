<?php

namespace App\Repositories;

use App\Interfaces\SellerRepositoryInterface;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Collection;

class SellerRepository implements SellerRepositoryInterface 
{
    public function createSeller(array $sellerDetails): Seller
    {
        return Seller::create($sellerDetails);
    }

    public function getSellerById(int $sellerId): ?Seller
    {
        return Seller::find($sellerId);
    }

    public function getSellers(): Collection
    {
        return Seller::all();
    }

    public function updateSeller(int $sellerId, array $newDetails): void
    {
        Seller::whereId($sellerId)->update($newDetails);
    }

    public function deleteSeller(int $sellerId): void
    {
        Seller::destroy($sellerId);
    }
}
