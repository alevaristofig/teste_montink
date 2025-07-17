<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CupomRequest;
use App\Service\CupomService;
use Illuminate\Http\JsonResponse;

class CupomController extends Controller
{
    private $service;

    public function __construct(CupomService $service) {
        $this->service = $service;
    }

    public function salvar(CupomRequest $request): JsonResponse
    {        
        $result = $this->service->salvar($request);

       return $result;
    }
}
