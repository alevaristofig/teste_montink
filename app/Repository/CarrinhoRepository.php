<?php

    namespace App\Repository;

    use App\Http\Requests\PedidoRequest;
  //  use App\Models\Estoque;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Database\Eloquent\Collection;

    interface CarrinhoRepository {
        
        public function retirarItem(int $id): JsonResponse;
       // public function listarPedidos(): JsonResponse;
       // public function realizarPedidos(PedidoRequest $request): JsonResponse;
        //public function buscar(int $id): Produtos;        
       // public function deletar(int $id): void;*/
       //public function removerCarrinho(): JsonResponse;
    }