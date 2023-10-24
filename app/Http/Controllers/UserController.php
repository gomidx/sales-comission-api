<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private UserService $service;

    public function __construct() 
    {
        $this->service = new UserService();
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        try {
            $user = $this->service->createUser($request->validated());

            return response()->json($user, $this->service->httpCode);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function get(int $userId): JsonResponse
    {
        try {
            $user = $this->service->getUser($userId);

            return response()->json($user, $this->service->httpCode);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function list(): JsonResponse
    {
        try {
            $users = $this->service->getUsers();

            return response()->json($users, $this->service->httpCode);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function update(int $userId, UpdateUserRequest $request): JsonResponse
    {
        try {
            $user = $this->service->updateUser($userId, $request->validated());

            return response()->json($user, $this->service->httpCode);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function delete(int $userId): JsonResponse
    {
        try {
            $response = $this->service->deleteUser($userId);

            return response()->json($response, $this->service->httpCode);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
