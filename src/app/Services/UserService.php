<?php

namespace App\Services;

use App\Enums\HttpCode;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private UserRepository $repository;

    public function __construct()
    {
        $this->repository = new UserRepository;
    }

    public function createUser(array $userDetails): array
    {
        $userDetails['password'] = Hash::make($userDetails['password']);

        $user = $this->repository->createUser($userDetails);

        return [
            'code' => HttpCode::CREATED->value,
			'response' => [
                'data' => $user
            ]
        ];
    }

    public function getUser(string $userEmail): array
    {
        $error = $this->checkIfHasError($userEmail);

        if (! empty($error)) {
            return $error;
        }

        $user = $this->repository->getUserByEmail($userEmail);

        return [
            'code' => HttpCode::SUCCESS->value,
			'response' => [
                'data' => $user
            ]
        ];
    }

    private function checkIfHasError(string $userEmail): array
    {
        if (! $this->userExists($userEmail)) {
            return [
                'code' => HttpCode::NOT_FOUND->value,
			    'response' => [
                    'error' => "User doesn't exists."
                ]
            ];
        }

        return [];
    }

    private function userExists(string $userEmail): bool
    {
        $user = $this->repository->getUserByEmail($userEmail);

        if (empty($user->id)) {
            return false;
        }

        return true;
    }
}