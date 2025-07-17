<?php

    namespace App\Service;

    use App\Repository\CupomRepository;
    use App\Http\Requests\CupomRequest;
    use App\Models\Cupom;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Database\Eloquent\Collection;
    use App\Exceptions\ApiMessages;

    class CupomService implements CupomRepository {

        private $model;

        public function __construct(Cupom $model) {
            $this->model = $model;
        }

        public function salvar(CupomRequest $dados): JsonResponse {
             try {                                                      
                $cupom = $this->model->create($dados->all());   
                
                return response()->json($cupom, 201);
            } catch(\Exception $e) {
                $message = new ApiMessages("Ocorreu um erro, a operção não foi realizada",$e->getMessage());
                response()->json(['error' => $message->getMessage()], 500);
            }
        }
    }