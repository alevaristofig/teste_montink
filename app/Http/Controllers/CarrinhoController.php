<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Service\CarrinhoService;
use App\Http\Requests\CarrinhoRequest;

class CarrinhoController extends Controller
{
    private $service;

    public function __construct(CarrinhoService $service) 
    {
        $this->service = $service;
    }

    public function retirarItem(CarrinhoRequest $request): JsonResponse
    {
        return $this->service->retirarItem($request); 
    }
}