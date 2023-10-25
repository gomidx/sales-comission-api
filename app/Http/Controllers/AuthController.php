<?php

namespace App\Http\Controllers;

use App\Exceptions\DefaultException;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    private AuthService $service;

    public function __construct() 
    {
        $this->service = new AuthService();
    }

    public function generateToken(LoginRequest $request): JsonResponse
    {
        try {
            $token = $this->service->generateToken($request->validated());

            return response()->json($token, $this->service->httpCode);
        } catch (\Throwable $th) {
            return DefaultException::make($th);
        }
    }

    public function logout(): JsonResponse
    {
        try {
            $response = $this->service->logout();

            return response()->json($response, $this->service->httpCode);
        } catch (\Throwable $th) {
            return DefaultException::make($th);
        }
    }
}
