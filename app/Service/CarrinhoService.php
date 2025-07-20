<?php

    namespace App\Service;

    use App\Repository\CarrinhoRepository;
    use App\Http\Requests\CarrinhoRequest;
 //   use App\Models\Estoque;
    use App\Exceptions\ApiMessages;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Support\Facades\Redis;    

    class CarrinhoService implements CarrinhoRepository 
    {
        private $nomeCarrinho;

        public function __construct() 
        {
           // $this->model = $model;
           // $this->produto = $produto;
          //  $this->nomeCarrinho = 'carrinho:'.auth('api')->user()->email;
           $this->nomeCarrinho = 'carrinho_teste';
        }

        public function retirarItem(CarrinhoRequest $request): JsonResponse
        {
            try {

                $produtosRetirar = $request->all();
                $produtos = Redis::hget($this->nomeCarrinho,'pedido'); 
                $produtosCarrinho =  json_decode($produtos,true); 

                foreach($produtosCarrinho as $i => $item) 
                {                
                    if($produtosRetirar['produto_id'] == $item['produto_id'] && $produtosRetirar['data'] == $item['data'] 
                       && $produtosRetirar['nome'] == $item['nome']
                      )
                    {
                            unset($produtosCarrinho[$i]);
                    }
                }
            
                $carrinho['pedido'] = json_encode($produtosCarrinho); 

                Redis::hmset($this->nomeCarrinho,$carrinho);
                
                return response()->json(['msg' => "Produto retirado do carrinho com Sucesso"], 200); 

            Redis::hmset($this->nomeCarrinho,$carrinho);
            } catch(\Exception $e) {
                $message = new ApiMessages("Ocorreu um erro, a operção não foi realizada",$e->getMessage());
                return response()->json(['error' => $message->getMessage()], 500);
            }                          
        }

        public function removerCarrinho(): JsonResponse
        {
            try {

                if(Redis::del($this->nomeCarrinho)) {
                    return response()->json(['msg' => "Produtos removidos do carrinho com Sucesso"], 200);
                } else {
                    return response()->json(['msg' => "O carrinho está vazio"], 200);
                }           
                
            } catch(\Exception $e) {
                $message = new ApiMessages("Ocorreu um erro, a operção não foi realizada",$e->getMessage());
                return response()->json(['error' => $message->getMessage()], 500);
            }
        }
    }