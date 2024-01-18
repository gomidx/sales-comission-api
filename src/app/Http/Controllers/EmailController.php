<?php

namespace App\Http\Controllers;

use App\Helpers\Http;
use App\Services\EmailService;
use Illuminate\Http\JsonResponse;

class EmailController extends Controller
{
    use Http;

    private EmailService $service;

    public function __construct()
    {
        $this->service = new EmailService();
    }

    /**
     * @OA\Get(
     *      path="/seller/{id}/email",
     *      operationId="getSellerSales",
     *      tags={"Vendedores"},
     *      summary="",
     *      description="Endpoint para consultar os dados do e-mail de relatório de vendas do vendedor.",
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
     *          description="Sucesso, dados encontrados.",
     *          @OA\JsonContent(
	 * 				@OA\Property(property="data", type="object",
     *                  @OA\Property(property="totalSales", type="number", example="6"),
     *                  @OA\Property(property="totalValue", type="number", example="598"),
     *                  @OA\Property(property="totalComission", type="number", example="50.83"),
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
    public function sellerSalesEmail(int $sellerId): JsonResponse
    {
        try {
            $data = $this->service->calculateSellerSalesValueForEmail($sellerId);

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    /**
     * @OA\Get(
     *      path="/seller/list/email",
     *      operationId="getSellersSales",
     *      tags={"Vendedores"},
     *      summary="",
     *      description="Endpoint para consultar os dados do e-mail de relatório de vendas de todos os vendedores.",
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
     *          description="Sucesso, dados encontrados.",
     *          @OA\JsonContent(
	 * 				@OA\Property(property="data", type="object",
	 * 				    @OA\Property(property="lucas@gmail.com", type="object",
     *                      @OA\Property(property="totalSales", type="number", example="6"),
     *                      @OA\Property(property="totalValue", type="number", example="598"),
     *                      @OA\Property(property="totalComission", type="number", example="50.83"),
     *                  ),
     *                  @OA\Property(property="joao@gmail.com", type="object",
     *                      @OA\Property(property="totalSales", type="number", example="9"),
     *                      @OA\Property(property="totalValue", type="number", example="843"),
     *                      @OA\Property(property="totalComission", type="number", example="71.65"),
     *                  ),
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Não encontrado.",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="error", type="string", example="Seller doesn't exists.")
	 * 			)
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Token inválido.",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="error", type="string", example="Invalid token.")
	 * 			)
     *      ),
	 * 		@OA\Response(
	 *     	    response=500,
	 *     		description="Erro interno.",
	 *     	 	@OA\JsonContent(
	 *         		@OA\Property(property="error", type="string", example="Internal error, contact an administrator."),
	 *     	 	)
	 * 		)
     * )
     */
    public function sellersSalesEmail(): JsonResponse
    {
        try {
            $data = $this->service->calculateSellersSalesValueForEmail();

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    /**
     * @OA\Get(
     *      path="/sale/list/email",
     *      operationId="getAllSellersSales",
     *      tags={"Vendas"},
     *      summary="",
     *      description="Endpoint para consultar os dados do e-mail de relatório de todas as vendas.",
     *      @OA\Response(
     *          response=200,
     *          description="Sucesso, dados encontrados.",
     *          @OA\JsonContent(
	 * 				@OA\Property(property="data", type="object",
     *                  @OA\Property(property="totalSales", type="number", example="6"),
     *                  @OA\Property(property="totalValue", type="number", example="598"),
     *              )
     *          )
     *      ),
	 * 		@OA\Response(
	 *     	    response=500,
	 *     		description="Erro interno.",
	 *     	 	@OA\JsonContent(
	 *         		@OA\Property(property="error", type="string", example="Internal error, contact an administrator."),
	 *     	 	)
	 * 		)
     * )
     */
    public function allSalesEmail(): JsonResponse
    {
        try {
            $data = $this->service->calculateAllSalesValueForEmail();

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }
}
