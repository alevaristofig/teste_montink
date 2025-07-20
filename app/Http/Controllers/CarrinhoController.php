<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Service\CarrinhoService;
use App\Http\Requests\CarrinhoRequest;
use App\Http\Requests\CarrinhoItemRequest;

class CarrinhoController extends Controller
{
    private $service;

    public function __construct(CarrinhoService $service) 
    {
        $this->service = $service;
    }

    public function listarCarrinho(): JsonResponse
    {
        return $this->service->listarCarrinho();        
    }  

    public function retirarItem(CarrinhoItemRequest $request): JsonResponse
    {
        return $this->service->retirarItem($request); 
    }

    public function removerCarrinho(): JsonResponse 
    {
        return $this->service->removerCarrinho(); 
    }

    public function adicionarCarrinho(CarrinhoRequest $request): JsonResponse 
    {
        return $this->service->adicionarCarrinho($request); 
    }
}