<?php

    namespace App\Repository;

    use App\Http\Requests\CupomRequest;
    use App\Models\Cupom;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Database\Eloquent\Collection;

    interface CupomRepository {
        
        public function salvar(CupomRequest $request): JsonResponse;
        public function listar(): JsonResponse;
        public function buscar(int $id): JsonResponse;
        /*public function atualizar(int $id, ProdutoRequest $request): Produtos;
        public function deletar(int $id): void;*/
    }