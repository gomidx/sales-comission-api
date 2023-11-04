<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class AuthService
{
	private UserRepository $userRepository;

	public int $httpCode;
 
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
				$this->httpCode = 422;

				return [
					'error' => 'Invalid password.'
				];
			}
		} else {
			$this->httpCode = 404;

			return [
				'error' => "User doesn't exists."
			];
		}

		$user->tokens()->delete();

		$token = $user->createToken($userDetails['email'])->plainTextToken;

		$this->httpCode = 200;

		return [
			'data' => $token
		];
	}

	public function logout(): array
	{
		$user = $this->userRepository->getUserById(auth()->user()->id);

		$user->tokens()->delete();

		$this->httpCode = 200;

		return [
			'data' => 'Successfully disconnected.'
		];
	}
}