<?php

namespace App\Http\Controllers;

use App\Exceptions\DefaultException;
use App\Http\Requests\Sale\StoreSaleRequest;
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
            $data = $this->service->createSale($request->validated());

            return response()->json($data, $this->service->httpCode);
        } catch (\Throwable $th) {
            return DefaultException::make($th);
        }
    }

    public function get(int $saleId): JsonResponse
    {
        try {
            $data = $this->service->getSale($saleId);

            return response()->json($data, $this->service->httpCode);
        } catch (\Throwable $th) {
            return DefaultException::make($th);
        }
    }

    public function list(): JsonResponse
    {
        try {
            $data = $this->service->getSales();

            return response()->json($data, $this->service->httpCode);
        } catch (\Throwable $th) {
            return DefaultException::make($th);
        }
    }

    public function listBySellerId(int $sellerId): JsonResponse
    {
        try {
            $data = $this->service->getSalesBySellerId($sellerId);

            return response()->json($data, $this->service->httpCode);
        } catch (\Throwable $th) {
            return DefaultException::make($th);
        }
    }

    public function delete(int $saleId): JsonResponse
    {
        try {
            $data = $this->service->deleteSale($saleId);

            return response()->json($data, $this->service->httpCode);
        } catch (\Throwable $th) {
            return DefaultException::make($th);
        }
    }
}
