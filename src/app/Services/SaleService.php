<?php

namespace App\Services;

use App\Enums\HttpCode;
use App\Repositories\SaleRepository;

class SaleService
{
    private SaleRepository $repository;

    public function __construct()
    {
        $this->repository = new SaleRepository;
    }

    public function createSale(array $saleDetails): array
    {
        $sale = $this->repository->createSale($saleDetails);

        return [
            'code' => HttpCode::CREATED->value,
			'response' => [
                'data' => $sale
            ]
        ];
    }

    public function getSale(int $saleId): array
    {
        $error = $this->checkIfHasError($saleId);

        if (! empty($error)) {
            return $error;
        }

        $sale = $this->repository->getSaleById($saleId);

        return [
            'code' => HttpCode::SUCCESS->value,
			'response' => [
                'data' => $sale
            ]
        ];
    }

    public function getSalesBySellerId(int $sellerId): array
    {
        $sales = $this->repository->getSalesBySellerId($sellerId);

        foreach ($sales as $key => $sale) {
            $sales[$key]['seller_name'] = $sale->seller->name;
        }

        return [
            'code' => HttpCode::SUCCESS->value,
			'response' => [
                'data' => $sales
            ]
        ];
    }

    public function getSales(): array
    {
        $sales = $this->repository->getSales();

        foreach ($sales as $key => $sale) {
            $sales[$key]['seller_name'] = $sale->seller->name;
        }

        return [
            'code' => HttpCode::SUCCESS->value,
			'response' => [
                'data' => $sales
            ]
        ];
    }

    public function deleteSale(int $saleId): array
    {
        $error = $this->checkIfHasError($saleId);

        if (! empty($error)) {
            return $error;
        }

        $this->repository->deleteSale($saleId);

        return [
            'code' => HttpCode::SUCCESS->value,
			'response' => [
                'data' => 'Successfully deleted.'
            ]
        ];
    }

    private function checkIfHasError(int $saleId): array
    {
        $sale = $this->repository->getSaleById($saleId);

        if (empty($sale->id)) {
            return [
                'code' => HttpCode::NOT_FOUND->value,
			    'response' => [
                    'error' => "Sale doesn't exists."
                ]
            ];
        }

        return [];
    }
}