<?php

namespace App\Services;

use App\Enums\HttpCode;
use App\Helpers\Http;
use App\Repositories\SellerRepository;

class SellerService
{
    use Http;

    private SellerRepository $repository;

    public function __construct()
    {
        $this->repository = new SellerRepository();
    }

    public function createSeller(array $sellerDetails): array
    {
        $seller = $this->repository->createSeller($sellerDetails);

        return $this->created($seller);
    }

    public function getSeller(int $sellerId): array
    {
        $error = $this->checkIfHasError($sellerId);

        if (! empty($error)) {
            return $error;
        }

        $seller = $this->repository->getSellerById($sellerId);

        return $this->ok($seller);
    }

    public function getSellers(): array
    {
        $sellers = $this->repository->getSellers();

        return $this->ok($sellers);
    }

    public function updateSeller(int $sellerId, array $sellerDetails): array
    {
        $error = $this->checkIfHasError($sellerId);

        if (! empty($error)) {
            return $error;
        }

        $this->repository->updateSeller($sellerId, $sellerDetails);

        $seller = $this->repository->getSellerById($sellerId);

        return $this->ok($seller);
    }

    public function deleteSeller(int $sellerId): array
    {
        $error = $this->checkIfHasError($sellerId);

        if (! empty($error)) {
            return $error;
        }

        $this->repository->deleteSeller($sellerId);

        return $this->ok('Successfully deleted.');
    }

    private function checkIfHasError(int $sellerId): array
    {
        $seller = $this->repository->getSellerById($sellerId);

        if (empty($seller->id)) {
            return $this->notFound("Seller doesn't exists.");
        }

        return [];
    }
}