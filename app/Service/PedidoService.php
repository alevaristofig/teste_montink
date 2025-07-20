<?php

    namespace App\Service;

    use App\Repository\PedidoRepository;
    use App\Http\Requests\PedidoRequest;
 //   use App\Models\Estoque;
    use App\Exceptions\ApiMessages;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Support\Facades\Redis;    

    class PedidoService implements PedidoRepository {

        private $nomeCarrinho;

        public function __construct() 
        {
           // $this->model = $model;
           // $this->produto = $produto;
          //  $this->nomeCarrinho = 'carrinho:'.auth('api')->user()->email;
           $this->nomeCarrinho = 'carrinho_teste';
        }

        public function listarPedidos(): JsonResponse 
        {
            try {
                    $carrinho = Redis::hgetall($this->nomeCarrinho); 
                  
                    if (count($carrinho) == 0) 
                    {
                        dd($carrinho);
                        return response()->json([], 200);
                    }  
                
                    return response()->json(json_decode($carrinho['pedido'],true), 200);
            } catch(\Exception $e) {
                $message = new ApiMessages("Ocorreu um erro, a operção não foi realizada",$e->getMessage());
                return response()->json(['error' => $message->getMessage()], 500);
            }
        }
    }