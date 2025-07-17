<?php

    namespace App\Service;

    use App\Repository\EstoqueRepository;
    use App\Http\Requests\EstoqueRequest;
    use App\Models\Estoque;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Pagination\LengthAwarePaginator;

    class EstoqueService implements EstoqueRepository {

        private $model;

        public function __construct(Estoque $model) {
            $this->model = $model;
        }

        public function salvar(EstoqueRequest $request): Estoque {
             try {                                
                return $this->model->create($request->all());             
            } catch(\Exception $e) {
                dd($e->getMessage());
            }
        }
    }