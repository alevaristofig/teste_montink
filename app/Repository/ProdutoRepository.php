<?php

    namespace App\Repository;

    use App\Http\Requests\ProdutoRequest;
    use App\Models\Produto;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Database\Eloquent\Collection;

    interface ProdutoRepository {
        
        public function salvar(ProdutoRequest $request): JsonResponse;
        public function listar(): Collection;
       /* public function buscar(int $id): Produto;
        public function atualizar(int $id, ProdutoRequest $request): Produto;
        public function deletar(int $id): void;*/
    }