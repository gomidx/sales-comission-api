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

    public function getUser(int $userEmail): array
    {
        $error = $this->checkIfHasError($userEmail);

        if (! empty($error)) {
            return $error;
        }

        $user = $this->repository->getUserByEmail($userEmail);

        $this->httpCode = 200;

        return [
            'data' => $user
        ];
    }

    private function checkIfHasError(int $userEmail): array
    {
        if (! $this->userExists($userEmail)) {
            $this->httpCode = 404;

            return [
                'error' => "User doesn't exists."
            ];
        } elseif (auth()->user()->email !== $userEmail) {
            $this->httpCode = 403;

            return [
                'error' => "You don't have permission to update this user"
            ];
        }

        return [];
    }

    private function userExists(int $userEmail): bool
    {
        $user = $this->repository->getUserByEmail($userEmail);

        if (empty($user->id)) {
            return false;
        }

        return true;
    }
}