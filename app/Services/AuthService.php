<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class AuthService
{
	private UserRepository $userRepository;
 
    public function __construct() 
    {
        $this->userRepository = new UserRepository;
    }

	public function generateToken(array $userDetails): array
	{
		$user = $this->userRepository->getUserByEmail($userDetails['email']);

		if (! empty($user->id)) {
			$checkPass = Hash::check($userDetails['password'], $user->password);

			if (! $checkPass) {
				return [
					'error' => 'Senha inválida.'
				];
			}
		} else {
			return [
				'error' => 'Usuário não encontrado.'
			];
		}

		$user->tokens()->delete();

		$token = $user->createToken($userDetails['email'])->plainTextToken;

		return [
			'data' => $token
		];
	}

	public function logout(int $userId): array
	{
		$user = $this->userRepository->getUserById($userId);

		$user->tokens()->delete();

		return [
			'data' => 'Successfully disconnected.'
		];
	}
}