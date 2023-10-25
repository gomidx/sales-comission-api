<?php

namespace App\Services;

use App\Repositories\SaleRepository;

class SaleService
{
    private SaleRepository $repository;

    public int $httpCode;

    public function __construct() 
    {
        $this->repository = new SaleRepository;
    }

    public function createSale(array $saleDetails): array
    {
        $sale = $this->repository->createSale($saleDetails);

        $this->httpCode = 201;

        return [
            'data' => $sale
        ];
    }

    public function getSale(int $saleId): array
    {
        $sale = $this->repository->getSaleById($saleId);

        $this->httpCode = 200;

        return [
            'data' => $sale
        ];
    }

    public function getSalesBySellerId(int $sellerId): array
    {
        $sales = $this->repository->getSalesBySellerId($sellerId);

        $this->httpCode = 200;

        return [
            'data' => $sales
        ];
    }

    public function getSales(): array
    {
        $sales = $this->repository->getSales();

        $this->httpCode = 200;

        return [
            'data' => $sales
        ];
    }

    public function deleteSale(int $saleId): array
    {
        if (! $this->saleExists($saleId)) {
            $this->httpCode = 404;

            return [
                'error' => "Sale doesn't exists."
            ];
        }

        $sale = $this->repository->deleteSale($saleId);

        $this->httpCode = 200;

        return [
            'data' => $sale
        ];
    }

    private function saleExists(int $saleId): bool
    {
        $sale = $this->repository->getSaleById($saleId);

        if (empty($sale->id)) {
            return false;
        }

        return true;
    }
}