<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery;

class PedidoTest extends TestCase
{
    public function test_AdicionarPedidoSucesso(): void {

        $dados = [
            "id_user" => 1,
            "produto_id" => 1,
            "quantidade" => 3,
            "data" => "2025-05-12 22:29:26",            
            "valor_total" => 169.2,
            "status" => "Pendente"
        ];

        $mock = Mockery::mock('alias:' . Pedido::class);
        $mock->shouldReceive('create')
            ->once()
            ->with($dados)
            ->andReturn((object) $dados);

        $result = Pedido::create($dados);

        $this->assertEquals(169.2,$result->valor_total);
        $this->assertEquals(1,$result->id_user);
    }
}
