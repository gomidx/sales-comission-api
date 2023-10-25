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
        if (! $this->sellerExists($sellerId)) {
            $this->httpCode = 404;

            return [
                'error' => "Seller doesn't exists."
            ];   
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
        if (! $this->sellerExists($sellerId)) {
            $this->httpCode = 404;

            return [
                'error' => "Seller doesn't exists."
            ];
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
        if (! $this->sellerExists($sellerId)) {
            $this->httpCode = 404;

            return [
                'error' => "Seller doesn't exists."
            ];
        }

        $this->repository->deleteSeller($sellerId);

        $this->httpCode = 200;

        return [
            'data' => 'Successfully deleted.'
        ];
    }

    private function sellerExists(int $sellerId): bool
    {
        $seller = $this->repository->getSellerById($sellerId);

        if (empty($seller->id)) {
            return false;
        }

        return true;
    }
}