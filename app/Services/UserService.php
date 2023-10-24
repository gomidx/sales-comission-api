<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private UserRepository $userRepository;

    public function __construct() 
    {
        $this->userRepository = new UserRepository;
    }

    public function createUser(array $userDetails): array
    {
        $userDetails['password'] = Hash::make($userDetails['password']);

        $user = $this->userRepository->createUser($userDetails);

        return [
            'data' => $user
        ];
    }

    public function getUser(int $userId): array
    {
        $user = $this->userRepository->getUserById($userId);

        return [
            'data' => $user
        ];
    }

    public function getUsers(): array
    {
        $users = $this->userRepository->getUsers();

        return [
            'data' => $users
        ];
    }

    public function updateUser(int $userId, array $userDetails): array
    {
        if (! empty($userDetails['password'])) {
            $userDetails['password'] = Hash::make($userDetails['password']);
        }
        
        $user = $this->userRepository->updateUser($userId, $userDetails);

        return [
            'data' => $user
        ];
    }

    public function deleteUser(int $userId): array
    {
        $user = $this->userRepository->deleteUser($userId);

        return [
            'data' => $user
        ];
    }
}