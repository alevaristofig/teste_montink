<?php

    namespace App\Service;

    use App\Repository\PedidoRepository;
    use App\Http\Requests\PedidoRequest;
    use App\Models\Pedido;
    use App\Models\Produto;
    use App\Exceptions\ApiMessages;
    use App\Mail\SendMail;
    use Illuminate\Http\Request;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Support\Facades\Redis; 
    //use Mail;   
    use Illuminate\Support\Facades\Mail;

    class PedidoService implements PedidoRepository {


        private $model;
        private $modelProduto;

        public function __construct(Pedido $model, Produto $modelProduto) 
        {
            $this->model = $model;
            $this->modelProduto = $modelProduto;
           // $this->produto = $produto;
          //  $this->nomeCarrinho = 'carrinho:'.auth('api')->user()->email;
           $this->nomeCarrinho = 'carrinho_teste';
        }

        public function listar(): JsonResponse
        {
            try {                                                      
                  $pedidos = $this->model->where('id_usuario',1)->get(); 
                  $ids = '';

                  foreach($pedidos as $key => $item) {
                    $id_produtos = json_decode($item->produtos);

                    $ids.= implode(",",$id_produtos).',';
                    $ids = substr($ids,0,strlen($ids)-1);

                    $produtosAux = $this->modelProduto->select('nome')->whereIN('id',explode(",",$ids))->get();
                    $pedidos[$key]['produtos'] = $produtosAux;
                  }
                  
                  return response()->json($pedidos, 201);
            } catch(\Exception $e) {
                $message = new ApiMessages("Ocorreu um erro, a operção não foi realizada",$e->getMessage());
                response()->json(['error' => $message->getMessage()], 500);
            }
        }

        public function confirmar(PedidoRequest $dados): JsonResponse
        {
            try {      
                  $endereco = $dados->all();
                                                                                
                  $pedido = $this->model->create($dados->all());
                  
                  $mensagem = 'Seu pedido foi registrado e em breve será envia para o endereço '.$endereco;
                
                  $this->enviarEmail($mensagem);
                  return response()->json($pedido, 201);
            } catch(\Exception $e) {
                $message = new ApiMessages("Ocorreu um erro, a operção não foi realizada",$e->getMessage());
                return response()->json(['msg' => $message->getMessage()], 500);
            }
        }

        public function atualizarStatus(int $id, Request $request): JsonResponse
        {
            try {
                
                $pedido = $this->model->find($id);

                $dados = $request->all();

                $pedido->status = $dados['status'];

                $pedido->save();

                return response()->json(['msg' => 'Status atualizado com sucesso'], 200);
                            
            } catch(\Exception $e) {
                $message = new ApiMessages("Ocorreu um erro, a operção não foi realizada",$e->getMessage());
                return response()->json(['error' => $message->getMessage()], 500);
            }
        }

        private function enviarEmail(string $mensagem): void 
        {
            try {
                $data = [
                    'name' => '',
                    'message' => $mesagem
                ];
 
                Mail::to("alevaristofig@gmail.com")->send(new SendMail($data));
            } catch(\Exception $e) {
                dd($e->getMessage());
            }
            
        }
    }