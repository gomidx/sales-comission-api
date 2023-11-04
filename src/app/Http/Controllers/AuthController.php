<?php

namespace App\Http\Controllers;

use App\Exceptions\DefaultException;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    private AuthService $service;

    public function __construct()
    {
        $this->service = new AuthService();
    }

    /**
     * @OA\Post(
     *      path="/token",
     *      operationId="generateToken",
     *      tags={"Autenticação"},
     *      summary="",
     *      description="Endpoint para gerar o token utilizado para a autenticação das requisições. É necessário primeiramente criar o adminsitrador e posteriormente gerar o token com seus respectivos dados.",
	 *		@OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
	 * 				type="object",
	 * 				@OA\Property(property="email", type="string", example="lucasgomide@gmail.com"),
	 * 				@OA\Property(property="password", type="string", example="abc142536%")
	 * 			)
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Sucesso, token gerado.",
     *          @OA\JsonContent(
	 * 				@OA\Property(property="data", type="string", example="{{token}}")
	 * 			)
     *       ),
     *       @OA\Response(
     *          response=404,
     *          description="Não encontrado.",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="error", type="string", example="User doesn't exists.")
	 * 			)
     *       ),
     *       @OA\Response(
     *          response=422,
     *          description="Senha inválida.",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="error", type="string", example="Invalid password.")
	 * 			)
     *       ),
	 * 		 @OA\Response(
	 *     	    response=500,
	 *     		description="Erro interno.",
	 *     	 	@OA\JsonContent(
	 *         		@OA\Property(property="error", type="string", example="Internal error, contact an administrator."),
	 *     	 	)
	 * 		 )
     * )
     */
    public function generateToken(LoginRequest $request): JsonResponse
    {
        try {
            $token = $this->service->generateToken($request->validated());

            return response()->json($token, $this->service->httpCode);
        } catch (\Throwable $th) {
            return DefaultException::make($th);
        }
    }

    /**
     * @OA\Post(
     *      path="/logout",
     *      operationId="disconnectUser",
     *      tags={"Autenticação"},
     *      summary="",
     *      description="Endpoint para desconectar o usuário.",
     *      security={{"sanctum": {}}},
     *      @OA\Response(
     *          response=200,
     *          description="Sucesso, usuário desconectado.",
     *          @OA\JsonContent(
	 * 				@OA\Property(property="data", type="string", example="Successfully disconnected.")
	 * 			)
     *       ),
     *       @OA\Response(
     *          response=401,
     *          description="Token inválido.",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="error", type="string", example="Invalid token.")
	 * 			)
     *       ),
	 * 		 @OA\Response(
	 *     	    response=500,
	 *     		description="Erro interno.",
	 *     	 	@OA\JsonContent(
	 *         		@OA\Property(property="error", type="string", example="Internal error, contact an administrator."),
	 *     	 	)
	 * 		 )
     * )
     */
    public function logout(): JsonResponse
    {
        try {
            $response = $this->service->logout();

            return response()->json($response, $this->service->httpCode);
        } catch (\Throwable $th) {
            return DefaultException::make($th);
        }
    }
}
