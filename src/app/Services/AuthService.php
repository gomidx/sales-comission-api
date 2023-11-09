<?php

namespace App\Services;

use App\Enums\HttpCode;
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
					'code' => HttpCode::UNPROCESSABLE_ENTITY->value,
					'response' => [
						'error' => 'Invalid password.'
					]
				];
			}
		} else {
			return [
				'code' => HttpCode::NOT_FOUND->value,
				'response' => [
					'error' => "User doesn't exists."
				]
			];
		}

		$user->tokens()->delete();

		$token = $user->createToken($userDetails['email'])->plainTextToken;

		return [
			'code' => HttpCode::SUCCESS->value,
			'response' => [
				'data' => $token
			]
		];
	}

	public function logout(): array
	{
		$user = $this->userRepository->getUserById(auth()->user()->id);

		$user->tokens()->delete();

		return [
			'code' => HttpCode::SUCCESS->value,
			'response' => [
				'data' => 'Successfully disconnected.'
			]
		];
	}
}