<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Throwable;

abstract class DefaultException
{
    public static function make(Throwable $exception): JsonResponse
	{
		return response()->json([
			'error' => $exception->getMessage()
		], 500);
	}
}