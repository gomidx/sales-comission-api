<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="0.0.1",
 *      title="Cadastro de vendas - Docs",
 *      description="Documentação da API do projeto <b>Cadastro de vendas</b>",
 *      @OA\Contact(
 *          email="lucasgomidecv@gmail.com"
 *      )
 * )
 *
 * @OA\Server(
 *      url="http://localhost:8001/api",
 *      description="API url"
 * )
 *
 * @OA\SecurityScheme(
 *      type="apiKey",
 *      description="Insira o token no formato: <b>Bearer {token}</b>",
 *      in="header",
 *      name="Authorization",
 * 		scheme="sanctum",
 * 		securityScheme="sanctum"
 * )
 *
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
