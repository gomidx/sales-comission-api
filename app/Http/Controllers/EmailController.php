<?php

namespace App\Http\Controllers;

use App\Exceptions\DefaultException;
use App\Services\EmailService;
use Illuminate\Http\JsonResponse;

class EmailController extends Controller
{
    private EmailService $service;

    public function __construct()
    {
        $this->service = new EmailService();
    }

    public function sellerSalesEmail(): JsonResponse
    {
        try {
            $data = $this->service->calculateSellerSalesValueForEmail();

            return response()->json($data, $this->service->httpCode);
        } catch (\Throwable $th) {
            return DefaultException::make($th);
        }
    }
}
