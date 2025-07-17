<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery;
use App\Models\Produto;

class ProdutoTest extends TestCase
{
    public function test_InserirProdutoSucesso(): void {

        $dados = [
            "nome" => "Produto Teste",
            "preco" => "100",
            "variacoes" => "teste",
        ];

        $mock = Mockery::mock('alias:' . Produto::class);
        $mock->shouldReceive('create')
            ->once()
            ->with($dados)
            ->andReturn((object) $dados);

        $result = Produto::create($dados);

        $this->assertEquals("Produto Teste",$result->nome);
        $this->assertEquals(100,$result->preco);
    }
}
