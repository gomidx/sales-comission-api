<?php

namespace App\Http\Controllers;

use App\Helpers\Http;
use App\Http\Requests\Sale\StoreSaleRequest;
use App\Services\SaleService;
use Illuminate\Http\JsonResponse;

class SaleController extends Controller
{
    use Http;

    private SaleService $service;

    public function __construct()
    {
        $this->service = new SaleService();
    }

    /**
     * @OA\Post(
     *      path="/sale",
     *      operationId="createSale",
     *      tags={"Vendas"},
     *      summary="",
     *      description="Endpoint para criar uma venda.",
     *      security={{"sanctum": {}}},
	 *		@OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
	 * 				type="object",
	 * 				@OA\Property(property="total_value", type="number", example=300),
	 * 				@OA\Property(property="date_of_sale", type="string", example="2023-10-24"),
	 * 				@OA\Property(property="seller_id", type="integer", example=1),
	 * 			)
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
    public function store(StoreSaleRequest $request): JsonResponse
    {
        try {
            $data = $this->service->createSale($request->validated());

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    /**
     * @OA\Get(
     *      path="/sale/{id}",
     *      operationId="getSale",
     *      tags={"Vendas"},
     *      summary="",
     *      description="Endpoint para consultar uma venda através do ID.",
     *      security={{"sanctum": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="ID da venda",
     *          in="path",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Sucesso, venda encontrada.",
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
     *       @OA\Response(
     *          response=404,
     *          description="Não encontrada.",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="error", type="string", example="Sale doesn't exists.")
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
    public function show(int $saleId): JsonResponse
    {
        try {
            $data = $this->service->getSale($saleId);

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    /**
     * @OA\Get(
     *      path="/sale/list",
     *      operationId="getSales",
     *      tags={"Vendas"},
     *      summary="",
     *      description="Endpoint para consultar todas as vendas.",
     *      security={{"sanctum": {}}},
     *      @OA\Response(
     *          response=200,
     *          description="Sucesso, vendas encontradas.",
     *          @OA\JsonContent(
	 * 				@OA\Property(property="data", type="array",
     *                  @OA\Items(type="object",
     *                      @OA\Property(property="total_value", type="number", format="float", example=300),
     *                      @OA\Property(property="date_of_sale", type="string", format="date", example="2023-10-24"),
     *                      @OA\Property(property="seller_id", type="integer", example=1),
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
            $data = $this->service->getSales();

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    /**
     * @OA\Get(
     *      path="/seller/{id}/sales",
     *      operationId="getSalesBySeller",
     *      tags={"Vendas"},
     *      summary="",
     *      description="Endpoint para consultar todas as vendas de um vendedor.",
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
     *          description="Sucesso, vendas encontradas.",
     *          @OA\JsonContent(
	 * 				@OA\Property(property="data", type="array",
     *                  @OA\Items(type="object",
     *                      @OA\Property(property="total_value", type="number", format="float", example=300),
     *                      @OA\Property(property="date_of_sale", type="string", format="date", example="2023-10-24"),
     *                      @OA\Property(property="seller_id", type="integer", example=1),
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
    public function listBySellerId(int $sellerId): JsonResponse
    {
        try {
            $data = $this->service->getSalesBySellerId($sellerId);

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    /**
     * @OA\Delete(
     *      path="/sale/{id}",
     *      operationId="deleteSale",
     *      tags={"Vendas"},
     *      summary="",
     *      description="Endpoint para deletar uma venda.",
     *      security={{"sanctum": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="ID da venda",
     *          in="path",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Sucesso, venda deletada.",
     *          @OA\JsonContent(
	 * 				@OA\Property(property="data", type="string", example="Successfully deleted")
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
    public function destroy(int $saleId): JsonResponse
    {
        try {
            $data = $this->service->deleteSale($saleId);

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }
}
