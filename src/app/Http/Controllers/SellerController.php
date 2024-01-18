<?php

namespace App\Http\Controllers;

use App\Http\Requests\Seller\UpdateSellerRequest;
use App\Http\Requests\Seller\StoreSellerRequest;
use App\Services\SellerService;
use Illuminate\Http\JsonResponse;

class SellerController extends Controller
{
    private SellerService $service;

    public function __construct()
    {
        $this->service = new SellerService();
    }

    /**
     * @OA\Post(
     *      path="/seller",
     *      operationId="createSeller",
     *      tags={"Vendedores"},
     *      summary="",
     *      description="Endpoint para criar um vendedor.",
     *      security={{"sanctum": {}}},
	 *		@OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="name", type="string", example="Lucas Gomide"),
     *              @OA\Property(property="email", type="string", example="lucasgomide@gmail.com"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Sucesso, venda criada.",
     *          @OA\JsonContent(
	 * 				@OA\Property(property="data", type="object",
     *                  @OA\Property(property="total_value", type="number", format="float", example=300),
     *                  @OA\Property(property="date_of_sale", type="string", format="date", example="2023-10-24"),
     *                  @OA\Property(property="seller_id", type="integer", example=1),
     *                  @OA\Property(property="updated_at", type="string", format="date-time", example="2023-10-25T01:57:56.000000Z"),
     *                  @OA\Property(property="created_at", type="string", format="date-time", example="2023-10-25T01:57:56.000000Z"),
     *                  @OA\Property(property="id", type="integer", example=1)
     *              )
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
    public function store(StoreSellerRequest $request): JsonResponse
    {
        try {
            $data = $this->service->createSeller($request->validated());

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    /**
     * @OA\Get(
     *      path="/seller/{id}",
     *      operationId="getSeller",
     *      tags={"Vendedores"},
     *      summary="",
     *      description="Endpoint para consultar um vendedor.",
     *      security={{"sanctum": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="ID do vendedor",
     *          in="path",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Sucesso, vendedor encontrado.",
     *          @OA\JsonContent(
	 * 				@OA\Property(property="data", type="object",
     *                  @OA\Property(property="name", type="string", example="Lucas Gomide"),
     *                  @OA\Property(property="email", type="string", example="lucasgomide@gmail.com"),
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
	 * 				@OA\Property(property="error", type="string", example="Seller doesn't exists.")
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
    public function show(int $sellerId): JsonResponse
    {
        try {
            $data = $this->service->getSeller($sellerId);

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    /**
     * @OA\Get(
     *      path="/seller/list",
     *      operationId="getSellers",
     *      tags={"Vendedores"},
     *      summary="",
     *      description="Endpoint para consultar todos os vendedores.",
     *      security={{"sanctum": {}}},
     *      @OA\Response(
     *          response=200,
     *          description="Sucesso, vendedores encontrados.",
     *          @OA\JsonContent(
	 * 				@OA\Property(property="data", type="array",
     *                  @OA\Items(type="object",
     *                      @OA\Property(property="name", type="string", example="Lucas Gomide"),
     *                      @OA\Property(property="email", type="string", example="lucasgomide@gmail.com"),
     *                      @OA\Property(property="updated_at", type="string", format="date-time", example="2023-10-25T01:57:56.000000Z"),
     *                      @OA\Property(property="created_at", type="string", format="date-time", example="2023-10-25T01:57:56.000000Z"),
     *                      @OA\Property(property="id", type="integer", example=1)
     *                  )
	 * 			    )
     *          )
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
    public function list(): JsonResponse
    {
        try {
            $data = $this->service->getSellers();

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    /**
     * @OA\Put(
     *      path="/seller/{id}",
     *      operationId="updateSeller",
     *      tags={"Vendedores"},
     *      summary="",
     *      description="Endpoint para atualizar um vendedor.",
     *      security={{"sanctum": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="ID do vendedor",
     *          in="path",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(type="object",
	 * 				@OA\Property(property="name", type="string", example="Lucas Gomide Pavão"),
	 * 			)
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Sucesso, vendedor atualizado.",
     *          @OA\JsonContent(
	 * 				@OA\Property(property="data", type="array",
     *                  @OA\Items(type="object",
     *                      @OA\Property(property="name", type="string", example="Lucas Gomide Pavão"),
     *                      @OA\Property(property="email", type="string", example="lucasgomide@gmail.com"),
     *                      @OA\Property(property="updated_at", type="string", format="date-time", example="2023-10-25T01:57:56.000000Z"),
     *                      @OA\Property(property="created_at", type="string", format="date-time", example="2023-10-25T01:57:56.000000Z"),
     *                      @OA\Property(property="id", type="integer", example=1)
     *                  )
	 * 			    )
     *          )
     *       ),
     *       @OA\Response(
     *          response=401,
     *          description="Token inválido.",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="error", type="string", example="Invalid token.")
	 * 			)
     *       ),
     *       @OA\Response(
     *          response=404,
     *          description="Não encontrado.",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="error", type="string", example="Seller doesn't exists.")
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
    public function update(int $sellerId, UpdateSellerRequest $request): JsonResponse
    {
        try {
            $data = $this->service->updateSeller($sellerId, $request->validated());

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    /**
     * @OA\Delete(
     *      path="/seller/{id}",
     *      operationId="deleteSeller",
     *      tags={"Vendedores"},
     *      summary="",
     *      description="Endpoint para deletar um vendedor.",
     *      security={{"sanctum": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="ID do vendedor",
     *          in="path",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Sucesso, vendedor deletado.",
     *          @OA\JsonContent(
	 * 				@OA\Property(property="data", type="string", example="Successfully deleted")
	 * 			)
     *       ),
     *       @OA\Response(
     *          response=404,
     *          description="Não encontrado.",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="error", type="string", example="Seller doesn't exists.")
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
    public function destroy(int $sellerId): JsonResponse
    {
        try {
            $data = $this->service->deleteSeller($sellerId);

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }
}
