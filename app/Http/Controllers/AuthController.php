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

            return response()->json($token, 201);
        } catch (\Throwable $th) {
            return DefaultException::make($th);
        }
    }

    public function logout(int $userId): JsonResponse
    {
        try {
            $response = $this->service->logout($userId);

            return response()->json($response, 201);
        } catch (\Throwable $th) {
            return DefaultException::make($th);
        }
    }
}
