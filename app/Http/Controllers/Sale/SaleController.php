<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sale\StoreSaleRequest;
use App\Http\Requests\Sale\UpdateSaleRequest;
use App\Services\SaleService;
use Illuminate\Http\JsonResponse;

class SaleController extends Controller
{
    private SaleService $service;

    public function __construct() 
    {
        $this->service = new SaleService();
    }

    public function store(StoreSaleRequest $request): JsonResponse
    {
        try {
            $sale = $this->service->createSale($request->validated());

            return response()->json($sale, 201);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function get(int $saleId): JsonResponse
    {
        try {
            $sale = $this->service->getSale($saleId);

            return response()->json($sale);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function list(): JsonResponse
    {
        try {
            $sales = $this->service->getSales();

            return response()->json($sales);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function update(int $saleId, UpdateSaleRequest $request): JsonResponse
    {
        try {
            $sale = $this->service->updateSale($saleId, $request->validated());

            return response()->json($sale);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function delete(int $saleId): JsonResponse
    {
        try {
            $sale = $this->service->deleteSale($saleId);

            return response()->json($sale);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
