<?php

    namespace App\Repository;

    use App\Http\Requests\ProdutoRequest;
    use App\Models\Produto;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Database\Eloquent\Collection;

    interface ProdutoRepository {
        
        public function salvar(ProdutoRequest $request): JsonResponse;
        public function listar(): JsonResponse;
        public function atualizar(int $id, ProdutoRequest $request): JsonResponse;
        public function buscar(int $id): JsonResponse;        
        public function deletar(int $id): JsonResponse;
    }