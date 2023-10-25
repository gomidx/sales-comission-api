<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private UserRepository $repository;
    public int $httpCode;

    public function __construct() 
    {
        $this->repository = new UserRepository;
    }

    public function createUser(array $userDetails): array
    {
        $userDetails['password'] = Hash::make($userDetails['password']);

        $user = $this->repository->createUser($userDetails);

        $this->httpCode = 201;

        return [
            'data' => $user
        ];
    }

    public function getUser(int $userId): array
    {
        $error = $this->checkIfHasError($userId);

        if (! empty($error)) {
            return $error;
        }

        $user = $this->repository->getUserById($userId);

        $this->httpCode = 200;

        return [
            'data' => $user
        ];
    }

    private function checkIfHasError(int $userId): array
    {
        if (! $this->userExists($userId)) {
            $this->httpCode = 404;

            return [
                'error' => "User doesn't exists."
            ];
        } elseif (auth()->user()->id !== $userId) {
            $this->httpCode = 403;

            return [
                'error' => "You don't have permission to update this user"
            ];
        }

        return [];
    }

    private function userExists(int $userId): bool
    {
        $user = $this->repository->getUserById($userId);

        if (empty($user->id)) {
            return false;
        }

        return true;
    }
}