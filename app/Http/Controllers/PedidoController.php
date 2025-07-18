<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\PedidoService;
use Illuminate\Http\JsonResponse;

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
}
