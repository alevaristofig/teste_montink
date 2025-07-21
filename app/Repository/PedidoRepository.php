<?php

    namespace App\Repository;

    use App\Http\Requests\PedidoRequest;
    use Illuminate\Http\Request;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Database\Eloquent\Collection;

    interface PedidoRepository {
        
       public function confirmar(PedidoRequest $request): JsonResponse;
       public function listar(): JsonResponse;  
       public function atualizarStatus(int $id, Request $request): JsonResponse;                  
    }