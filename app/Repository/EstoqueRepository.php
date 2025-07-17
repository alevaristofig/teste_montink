<?php

    namespace App\Repository;

    use App\Http\Requests\EstoqueRequest;
    use App\Models\Estoque;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Database\Eloquent\Collection;

    interface EstoqueRepository {
        
        public function salvar(Array $request): void;
        public function atualizar(int $id, Array $request): bool;
        /*public function listar(): Collection;
        public function buscar(int $id): Produtos;        
        public function deletar(int $id): void;*/
    }