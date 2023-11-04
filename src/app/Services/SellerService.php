<?php

namespace App\Services;

use App\Repositories\SellerRepository;

class SellerService
{
    private SellerRepository $repository;

    public int $httpCode;

    public function __construct()
    {
        $this->repository = new SellerRepository();
    }

    public function createSeller(array $sellerDetails): array
    {
        $seller = $this->repository->createSeller($sellerDetails);

        $this->httpCode = 201;

        return [
            'data' => $seller
        ];
    }

    public function getSeller(int $sellerId): array
    {
        $error = $this->checkIfHasError($sellerId);

        if (! empty($error)) {
            return $error;
        }

        $seller = $this->repository->getSellerById($sellerId);

        $this->httpCode = 200;

        return [
            'data' => $seller
        ];
    }

    public function getSellers(): array
    {
        $sellers = $this->repository->getSellers();

        $this->httpCode = 200;

        return [
            'data' => $sellers
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

        $this->httpCode = 200;

        return [
            'data' => $seller
        ];
    }

    public function deleteSeller(int $sellerId): array
    {
        $error = $this->checkIfHasError($sellerId);

        if (! empty($error)) {
            return $error;
        }

        $this->repository->deleteSeller($sellerId);

        $this->httpCode = 200;

        return [
            'data' => 'Successfully deleted.'
        ];
    }

    private function checkIfHasError(int $sellerId): array
    {
        $seller = $this->repository->getSellerById($sellerId);

        if (empty($seller->id)) {
            $this->httpCode = 404;

            return [
                'error' => "Seller doesn't exists."
            ];
        }

        return [];
    }
}