<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpFoundation\Response;

class CustomAuthException extends AuthenticationException
{
	public function __construct(string $message = 'Invalid token.', array $guards = [])
    {
        parent::__construct($message, $guards);
    }

    public function render(): object
    {
        return response()->json([
			'data'   => $this->message
		], Response::HTTP_UNAUTHORIZED);
    }
}