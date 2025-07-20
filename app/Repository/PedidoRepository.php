<?php

    namespace App\Repository;

    use App\Http\Requests\PedidoRequest;
  //  use App\Models\Estoque;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Database\Eloquent\Collection;

    interface PedidoRepository {
        
       // public function salvar(Array $request): void;
       // public function atualizar(int $id, Array $request): bool;
        public function listarPedidos(): JsonResponse;        
        //public function buscar(int $id): Produtos;        
       // public function deletar(int $id): void;*/       
    }