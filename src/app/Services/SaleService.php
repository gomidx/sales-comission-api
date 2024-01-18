<?php

namespace App\Services;

use App\Enums\HttpCode;
use App\Helpers\Http;
use App\Repositories\SaleRepository;

class SaleService
{
    use Http;

    private SaleRepository $repository;

    public function __construct()
    {
        $this->repository = new SaleRepository;
    }

    public function createSale(array $saleDetails): array
    {
        $sale = $this->repository->createSale($saleDetails);

        return $this->created($sale);
    }

    public function getSale(int $saleId): array
    {
        $error = $this->checkIfHasError($saleId);

        if (! empty($error)) {
            return $error;
        }

        $sale = $this->repository->getSaleById($saleId);

        return $this->ok($sale);
    }

    public function getSalesBySellerId(int $sellerId): array
    {
        $sales = $this->repository->getSalesBySellerId($sellerId);

        foreach ($sales as $key => $sale) {
            $sales[$key]['seller_name'] = $sale->seller->name;
        }

        return $this->ok($sales);
    }

    public function getSales(): array
    {
        $sales = $this->repository->getSales();

        foreach ($sales as $key => $sale) {
            $sales[$key]['seller_name'] = $sale->seller->name;
        }

        return $this->ok($sales);
    }

    public function deleteSale(int $saleId): array
    {
        $error = $this->checkIfHasError($saleId);

        if (! empty($error)) {
            return $error;
        }

        $this->repository->deleteSale($saleId);

        return $this->ok('Successfully deleted.');
    }

    private function checkIfHasError(int $saleId): array
    {
        $sale = $this->repository->getSaleById($saleId);

        if (empty($sale->id)) {
            return $this->notFound("Sale doesn't exists.");
        }

        return [];
    }
}