<?php

namespace App\Interfaces;

interface SellerRepositoryInterface
{
    public function createSeller(array $sellerDetails);
    public function getSellerById(int $sellerId);
    public function getSellers();
    public function updateSeller(int $sellerId, array $newDetails);
    public function deleteSeller(int $sellerId);
}