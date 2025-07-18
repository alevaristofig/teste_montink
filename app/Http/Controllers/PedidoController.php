<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Service\PedidoService;
use App\Http\Requests\PedidoRequest;

class PedidoController extends Controller
{
    private $service;

    public function __construct(PedidoService $service) 
    {
        $this->service = $service;
    }

    public function listar(): JsonResponse
    {
        return $this->service->listarPedidos();        
    }

    public function realizarPedidos(PedidoRequest $request): JsonResponse 
    {
        return $this->service->realizarPedidos($request); 
    }
}
