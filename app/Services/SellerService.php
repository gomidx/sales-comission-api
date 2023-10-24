<?php

namespace App\Services;

use App\Repositories\SellerRepository;
use Illuminate\Support\Facades\Hash;

class SellerService
{
    private SellerRepository $sellerRepository;

    public function __construct() 
    {
        $this->sellerRepository = new SellerRepository;
    }

    public function createSeller(array $sellerDetails): array
    {
        $sellerDetails['password'] = Hash::make($sellerDetails['password']);

        $seller = $this->sellerRepository->createSeller($sellerDetails);

        return [
            'data' => $seller
        ];
    }

    public function getSeller(int $sellerId): array
    {
        $seller = $this->sellerRepository->getSellerById($sellerId);

        return [
            'data' => $seller
        ];
    }

    public function getSellers(): array
    {
        $sellers = $this->sellerRepository->getSellers();

        return [
            'data' => $sellers
        ];
    }

    public function updateSeller(int $sellerId, array $sellerDetails): array
    {
        if (! empty($sellerDetails['password'])) {
            $sellerDetails['password'] = Hash::make($sellerDetails['password']);
        }
        
        $seller = $this->sellerRepository->updateSeller($sellerId, $sellerDetails);

        return [
            'data' => $seller
        ];
    }

    public function deleteSeller(int $sellerId): array
    {
        $seller = $this->sellerRepository->deleteSeller($sellerId);

        return [
            'data' => $seller
        ];
    }
}