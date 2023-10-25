<?php

namespace App\Http\Controllers;

use App\Exceptions\DefaultException;
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
            $data = $this->service->createSeller($request->validated());

            return response()->json($data, $this->service->httpCode);
        } catch (\Throwable $th) {
            return DefaultException::make($th);
        }
    }

    public function get(int $sellerId): JsonResponse
    {
        try {
            $data = $this->service->getSeller($sellerId);

            return response()->json($data, $this->service->httpCode);
        } catch (\Throwable $th) {
            return DefaultException::make($th);
        }
    }

    public function list(): JsonResponse
    {
        try {
            $data = $this->service->getSellers();

            return response()->json($data, $this->service->httpCode);
        } catch (\Throwable $th) {
            return DefaultException::make($th);
        }
    }

    public function update(int $sellerId, UpdateSellerRequest $request): JsonResponse
    {
        try {
            $data = $this->service->updateSeller($sellerId, $request->validated());

            return response()->json($data, $this->service->httpCode);
        } catch (\Throwable $th) {
            return DefaultException::make($th);
        }
    }

    public function delete(int $sellerId): JsonResponse
    {
        try {
            $data = $this->service->deleteSeller($sellerId);

            return response()->json($data, $this->service->httpCode);
        } catch (\Throwable $th) {
            return DefaultException::make($th);
        }
    }
}
