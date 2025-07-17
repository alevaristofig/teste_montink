<?php

    namespace App\Service;

    use App\Repository\EstoqueRepository;
    use App\Http\Requests\EstoqueRequest;
    use App\Models\Estoque;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Database\Eloquent\Collection;
    use App\Exceptions\ApiMessages;

    class EstoqueService implements EstoqueRepository {

        private $model;

        public function __construct(Estoque $model) {
            $this->model = $model;
        }

        public function salvar(Array $dados): void 
        {
             try {                                            
                $this->model->create($dados);             
            } catch(\Exception $e) {
                $message = new ApiMessages("Ocorreu um erro, a operção não foi realizada",$e->getMessage());
                response()->json(['error' => $message->getMessage()], 500);
            }
        }

        public function atualizar(int $id, Array $dados): bool 
        {
            try {
                
                $estoque = $this->model->where('produto_id',$id)->get();

                $estoque[0]->produto_id = $id;
                $estoque[0]->quantidade = $dados['quantidade'];

                $estoque[0]->save();   
                
                return true;
                            
            } catch(\Exception $e) {                
                return false;
            }
        }
    }