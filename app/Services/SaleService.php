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
        $error = $this->checkIfHasError($saleId);

        if (! empty($error)) {
            return $error;
        }

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
        $error = $this->checkIfHasError($saleId);

        if (! empty($error)) {
            return $error;
        }

        $this->repository->deleteSale($saleId);

        $this->httpCode = 200;

        return [
            'data' => 'Successfully deleted.'
        ];
    }

    private function checkIfHasError(int $saleId): array
    {
        $sale = $this->repository->getSaleById($saleId);

        if (empty($sale->id)) {
            $this->httpCode = 404;

            return [
                'error' => "Sale doesn't exists."
            ];
        }

        return [];
    }
}