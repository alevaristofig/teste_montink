<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProdutoRequest;
use App\Service\ProdutoService;
use Illuminate\Http\JsonResponse;

class ProdutoController extends Controller
{
    private $service;

    public function __construct(ProdutoService $service) {
        $this->service = $service;
    }

    public function salvar(ProdutoRequest $request): JsonResponse
    {
       // $result = $this->service->salvar($request);

      //  return response()->json($result,201);

       return response()->json("Teste",201);
    }
}
