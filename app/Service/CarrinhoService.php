<?php

    namespace App\Service;

    use App\Repository\CarrinhoRepository;
   // use App\Http\Requests\PedidoRequest;
 //   use App\Models\Estoque;
    use App\Exceptions\ApiMessages;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Support\Facades\Redis;    

    class CarrinhoService implements CarrinhoRepository 
    {
        public function retirarItem(int $produto_id, string $data): JsonResponse
        {
            $produtos = Redis::hget($this->nomeCarrinho,'produtos');   
        }
    }