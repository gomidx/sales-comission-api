<?php

namespace App\Http\Controllers;

use App\Http\Requests\Seller\UpdateSellerRequest;
use App\Http\Requests\Seller\StoreSellerRequest;
use App\Services\SellerService;
use Illuminate\Http\JsonResponse;

class SellerController extends Controller
{
    private SellerService $service;

    public function __construct() 
    {
        $this->service = new SellerService();
    }

    public function store(StoreSellerRequest $request): JsonResponse
    {
        try {
            $seller = $this->service->createSeller($request->validated());

            return response()->json($seller, 201);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function get(int $sellerId): JsonResponse
    {
        try {
            $seller = $this->service->getSeller($sellerId);

            return response()->json($seller);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function list(): JsonResponse
    {
        try {
            $sellers = $this->service->getSellers();

            return response()->json($sellers);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function update(int $sellerId, UpdateSellerRequest $request): JsonResponse
    {
        try {
            $seller = $this->service->updateSeller($sellerId, $request->validated());

            return response()->json($seller);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function delete(int $sellerId): JsonResponse
    {
        try {
            $seller = $this->service->deleteSeller($sellerId);

            return response()->json($seller);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
