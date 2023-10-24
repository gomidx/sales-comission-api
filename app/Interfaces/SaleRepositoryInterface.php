<?php

namespace App\Interfaces;

interface SaleRepositoryInterface
{
    public function createSale(array $saleDetails);
    public function getSaleById(int $saleId);
    public function getSalesBySellerId(int $sellerId);
    public function getSales();
    public function updateSale(int $saleId, array $newDetails);
    public function deleteSale(int $saleId);
}