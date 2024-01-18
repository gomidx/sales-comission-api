<?php

namespace App\Http\Controllers;

use App\Helpers\Http;
use App\Http\Requests\User\StoreUserRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    use Http;

    private UserService $service;

    public function __construct()
    {
        $this->service = new UserService();
    }

    /**
     * @OA\Post(
     *      path="/user",
     *      operationId="createUser",
     *      tags={"Administradores"},
     *      summary="",
     *      description="Endpoint para criar um administrador.",
	 *		@OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
	 * 				type="object",
	 * 				@OA\Property(property="name", type="string", example="Lucas Gomide"),
	 * 				@OA\Property(property="email", type="string", example="lucasgomide@gmail.com"),
	 * 				@OA\Property(property="password", type="string", example="123456"),
	 * 			)
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Sucesso, administrador criado.",
     *          @OA\JsonContent(
	 * 				@OA\Property(property="data", type="object",
     *                  @OA\Property(property="name", type="string", example="Lucas Gomide"),
	 * 				    @OA\Property(property="email", type="string", example="lucasgomide@gmail.com"),
     *                  @OA\Property(property="created_at", type="string", format="date-time", example="2023-10-25T01:57:56.000000Z"),
     *                  @OA\Property(property="updated_at", type="string", format="date-time", example="2023-10-25T01:57:56.000000Z"),
     *                  @OA\Property(property="id", type="integer", example=1)
     *              )
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
    public function store(StoreUserRequest $request): JsonResponse
    {
        try {
            $data = $this->service->createUser($request->validated());

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    /**
     * @OA\Get(
     *      path="/user/{email}",
     *      operationId="getUser",
     *      tags={"Administradores"},
     *      summary="",
     *      description="Endpoint para consultar um administrador.",
     *      security={{"sanctum": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="E-mail do administrador",
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Sucesso, vendedor encontrado.",
     *          @OA\JsonContent(
	 * 				@OA\Property(property="data", type="object",
     *                  @OA\Property(property="name", type="string", example="Lucas Gomide"),
     *                  @OA\Property(property="email", type="string", example="2023-10-24"),
     *                  @OA\Property(property="email_verified_at", type="string", example="null"),
     *                  @OA\Property(property="updated_at", type="string", format="date-time", example="2023-10-25T01:57:56.000000Z"),
     *                  @OA\Property(property="created_at", type="string", format="date-time", example="2023-10-25T01:57:56.000000Z"),
     *                  @OA\Property(property="id", type="integer", example=1)
     *              )
     *          )
     *       ),
     *       @OA\Response(
     *          response=404,
     *          description="Não encontrado.",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="error", type="string", example="Administrator doesn't exists.")
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
    public function show(string $userEmail): JsonResponse
    {
        try {
            $data = $this->service->getUser($userEmail);

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }
}
