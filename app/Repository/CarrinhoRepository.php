<?php

    namespace App\Repository;

    use App\Http\Requests\CarrinhoRequest;
  //  use App\Models\Estoque;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Database\Eloquent\Collection;

    interface CarrinhoRepository {
        
      public function removerCarrinho(): JsonResponse;
      public function retirarItem(CarrinhoRequest $request): JsonResponse;
      public function adicionarCarrinho(PedidoRequest $request): JsonResponse;
       // public function listarPedidos(): JsonResponse;
       // public function realizarPedidos(PedidoRequest $request): JsonResponse;
        //public function buscar(int $id): Produtos;        
       // public function deletar(int $id): void;*/
       //public function removerCarrinho(): JsonResponse;
    }