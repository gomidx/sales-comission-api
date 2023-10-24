<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface 
{
    public function createUser(array $userDetails): User
    {
        return User::create($userDetails);
    }

    public function getUserById(int $userId): User
    {
        return User::find($userId);
    }

    public function getUsers(): Collection
    {
        return User::all();
    }

    public function updateUser(int $userId, array $newDetails): User
    {
        return User::whereId($userId)->update($newDetails);
    }

    public function deleteUser(int $userId): void
    {
        User::destroy($userId);
    }
}