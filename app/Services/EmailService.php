<?php

namespace App\Services;

use App\Repositories\SaleRepository;
use App\Repositories\SellerRepository;
use Illuminate\Database\Eloquent\Collection;

class EmailService
{
    private SellerRepository $repository;

    public int $httpCode = 400;

    public function __construct()
    {
        $this->repository = new SellerRepository();
    }

    public function calculateSellerSalesValueForEmail(): array
    {
        $result = [];

        $saleRepository = new SaleRepository();

        $sellers = $this->repository->getSellers();

        foreach ($sellers as $seller) {
            $sellerSales = $saleRepository->getDaySalesBySellerId($seller->id);

            $result[$seller->id] = [
                'totalSales' => count($sellerSales),
                'totalValue' => $this->calculateTotalSalesValue($sellerSales),
                'totalComission' => $this->calculateSalesComissionValue($sellerSales),
            ];
        }

        $this->httpCode = 200;

        return $result;
    }

    public function calculateAllSalesValueForEmail(): int
    {
        $saleRepository = new SaleRepository();

        $sellerSales = $saleRepository->getDaySales();

        $totalValue = $this->calculateTotalSalesValue($sellerSales);

        return $totalValue;
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
}