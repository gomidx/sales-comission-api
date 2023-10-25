<?php

namespace App\Http\Controllers;

use App\Exceptions\DefaultException;
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
            $data = $this->service->createUser($request->validated());

            return response()->json($data, $this->service->httpCode);
        } catch (\Throwable $th) {
            return DefaultException::make($th);
        }
    }

    public function get(int $userId): JsonResponse
    {
        try {
            $data = $this->service->getUser($userId);

            return response()->json($data, $this->service->httpCode);
        } catch (\Throwable $th) {
            return DefaultException::make($th);
        }
    }

    public function list(): JsonResponse
    {
        try {
            $data = $this->service->getUsers();

            return response()->json($data, $this->service->httpCode);
        } catch (\Throwable $th) {
            return DefaultException::make($th);
        }
    }

    public function update(int $userId, UpdateUserRequest $request): JsonResponse
    {
        try {
            $data = $this->service->updateUser($userId, $request->validated());

            return response()->json($data, $this->service->httpCode);
        } catch (\Throwable $th) {
            return DefaultException::make($th);
        }
    }

    public function delete(int $userId): JsonResponse
    {
        try {
            $data = $this->service->deleteUser($userId);

            return response()->json($data, $this->service->httpCode);
        } catch (\Throwable $th) {
            return DefaultException::make($th);
        }
    }
}
