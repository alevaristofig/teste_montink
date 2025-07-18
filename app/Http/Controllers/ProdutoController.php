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

    public function listar(): JsonResponse
    {
        $result = $this->service->listar();

        return response()->json($result,200);
    }

    public function buscar(int $id): JsonResponse
    {
        return $this->service->buscar($id);
    }

    public function salvar(ProdutoRequest $request): JsonResponse
    {
        $result = $this->service->salvar($request);

       return $result;
    }

    public function atualizar(ProdutoRequest $request, int $id): JsonResponse
    {
        return $this->service->atualizar($id, $request);
    }

    public function deletar(int $id): JsonResponse
    {
        return $this->service->deletar($id);
    }
}
