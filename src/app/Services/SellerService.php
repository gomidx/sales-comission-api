<?php

namespace App\Services;

use App\Enums\HttpCode;
use App\Repositories\SellerRepository;

class SellerService
{
    private SellerRepository $repository;

    public function __construct()
    {
        $this->repository = new SellerRepository();
    }

    public function createSeller(array $sellerDetails): array
    {
        $seller = $this->repository->createSeller($sellerDetails);

        return [
            'code' => HttpCode::CREATED->value,
			'response' => [
                'data' => $seller
            ]
        ];
    }

    public function getSeller(int $sellerId): array
    {
        $error = $this->checkIfHasError($sellerId);

        if (! empty($error)) {
            return $error;
        }

        $seller = $this->repository->getSellerById($sellerId);

        return [
            'code' => HttpCode::SUCCESS->value,
			'response' => [
                'data' => $seller
            ]
        ];
    }

    public function getSellers(): array
    {
        $sellers = $this->repository->getSellers();

        return [
            'code' => HttpCode::SUCCESS->value,
			'response' => [
                'data' => $sellers
            ]
        ];
    }

    public function updateSeller(int $sellerId, array $sellerDetails): array
    {
        $error = $this->checkIfHasError($sellerId);

        if (! empty($error)) {
            return $error;
        }

        $this->repository->updateSeller($sellerId, $sellerDetails);

        $seller = $this->repository->getSellerById($sellerId);

        return [
            'code' => HttpCode::SUCCESS->value,
			'response' => [
                'data' => $seller
            ]
        ];
    }

    public function deleteSeller(int $sellerId): array
    {
        $error = $this->checkIfHasError($sellerId);

        if (! empty($error)) {
            return $error;
        }

        $this->repository->deleteSeller($sellerId);

        return [
            'code' => HttpCode::SUCCESS->value,
			'response' => [
                'data' => 'Successfully deleted.'
            ]
        ];
    }

    private function checkIfHasError(int $sellerId): array
    {
        $seller = $this->repository->getSellerById($sellerId);

        if (empty($seller->id)) {
            return [
                'code' => HttpCode::NOT_FOUND->value,
			    'response' => [
                    'error' => "Seller doesn't exists."
                ]
            ];
        }

        return [];
    }
}