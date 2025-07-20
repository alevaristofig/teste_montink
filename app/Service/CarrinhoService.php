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
        public function retirarItem(CarrinhoRequest $request): JsonResponse
        {
            $produtos = Redis::hget($this->nomeCarrinho,'produtos');   
        }
    }