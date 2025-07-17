<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery;
use App\Models\Cupom;

class CuponTest extends TestCase
{
    public function test_InserirCuponsSucesso(): void {

        $dados = [
            "nome" => "Cupom Teste",
            "desconto" => "100",
            "validade" => "2025-07-14"
        ];

        $mockProduto = Mockery::mock('alias:' . Cupom::class);

        $mockProduto->shouldReceive('create')
            ->once()
            ->with($dados)
            ->andReturn((object) $dados);

        $result = Cupom::create($dados);

        $this->assertEquals("Cupom Teste",$result->nome);
        $this->assertEquals(100,$result->desconto);
        $this->assertEquals("2025-07-14",$result->validade);
    }
}
