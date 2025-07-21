<?php

    namespace App\Service;

    use App\Repository\PedidoRepository;
    use App\Http\Requests\PedidoRequest;
    use App\Models\Pedido;
    use App\Exceptions\ApiMessages;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Support\Facades\Redis;    

    class PedidoService implements PedidoRepository {


        private $model;

        public function __construct(Pedido $model) 
        {
            $this->model = $model;
           // $this->produto = $produto;
          //  $this->nomeCarrinho = 'carrinho:'.auth('api')->user()->email;
           $this->nomeCarrinho = 'carrinho_teste';
        }

        public function confirmar(PedidoRequest $dados): JsonResponse
        {
            try {                                                      
                  $pedido = $this->model->create($dados->all());   
                
                return response()->json($pedido, 201);
            } catch(\Exception $e) {
                $message = new ApiMessages("Ocorreu um erro, a operção não foi realizada",$e->getMessage());
                response()->json(['error' => $message->getMessage()], 500);
            }
        }
    }