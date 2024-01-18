<?php

namespace App\Services;

use App\Enums\HttpCode;
use App\Helpers\Http;
use App\Repositories\SaleRepository;
use App\Repositories\SellerRepository;
use Illuminate\Database\Eloquent\Collection;

class EmailService
{
    use Http;

    private SellerRepository $sellerRepository;
    private SaleRepository $saleRepository;

    public function __construct()
    {
        $this->sellerRepository = new SellerRepository();
        $this->saleRepository = new SaleRepository();
    }

    public function calculateAllSalesValueForEmail(): array
    {
        $sales = $this->saleRepository->getDaySales();

        $data = [
            'totalSales' => count($sales),
            'totalValue' => $this->calculateTotalSalesValue($sales)
        ];

        return $this->ok($data);
    }

    public function calculateSellerSalesValueForEmail(int $sellerId): array
    {
        $error = $this->checkIfHasError($sellerId);

        if (! empty($error)) {
            return $error;
        }

        $sellerSales = $this->saleRepository->getDaySalesBySellerId($sellerId);

        $data = [
            'totalSales' => count($sellerSales),
            'totalValue' => $this->calculateTotalSalesValue($sellerSales),
            'totalComission' => $this->calculateSalesComissionValue($sellerSales)
        ];

        return $this->ok($data);
    }

    public function calculateSellersSalesValueForEmail(): array
    {
        $result = [];

        $sellers = $this->sellerRepository->getSellers();

        foreach ($sellers as $seller) {
            $sellerSales = $this->saleRepository->getDaySalesBySellerId($seller->id);

            $result[$seller->email] = [
                'totalSales' => count($sellerSales),
                'totalValue' => $this->calculateTotalSalesValue($sellerSales),
                'totalComission' => $this->calculateSalesComissionValue($sellerSales)
            ];
        }

        return $this->ok($result);
    }

    private function calculateTotalSalesValue(Collection $sellerSales): int
    {
        $totalValue = 0;

        foreach ($sellerSales as $sale) {
            $totalValue += $sale->total_value;
        }

        return $totalValue;
    }

    private function calculateSalesComissionValue(Collection $sellerSales): int
    {
        $totalComission = 0;

        foreach ($sellerSales as $sale) {
            $totalComission += ($sale->total_value * 8.5) / 100;
        }

        return $totalComission;
    }

    private function checkIfHasError(string $sellerId): array
    {
        if (! $this->sellerExists($sellerId)) {
            return $this->notFound("Seller doesn't exists.");
        }

        return [];
    }

    private function sellerExists(string $sellerId): bool
    {
        $seller = $this->sellerRepository->getSellerById($sellerId);

        if (empty($seller->id)) {
            return false;
        }

        return true;
    }
}