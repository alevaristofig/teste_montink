<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery;
use App\Models\Produto;
use App\Models\Estoque;

class ProdutoTest extends TestCase
{
    public function test_InserirProdutoEEstoqueSucesso(): void {

        $dados = [
            "nome" => "Produto Teste",
            "preco" => "100",
            "variacoes" => "teste",
            "estoque" => [
                "id" => 1,
                "id_produto" => 1,
                "quantidade" => 10
            ]
        ];

        $mockProduto = Mockery::mock('alias:' . Produto::class);
        $mockEstoque = Mockery::mock('alias:' . Estoque::class);

        $mockProduto->shouldReceive('create')
            ->once()
            ->with($dados)
            ->andReturn((object) $dados);

        $mockEstoque->shouldReceive('create')
            ->once()
            ->with($dados['estoque'])
            ->andReturn((object) $dados['estoque']);

        $resultProduto = Produto::create($dados);
        $resultEstoque = Estoque::create($dados['estoque']);

        $this->assertEquals("Produto Teste",$resultProduto->nome);
        $this->assertEquals(100,$resultProduto->preco);

        $this->assertEquals(1,$resultEstoque->id_produto);
        $this->assertEquals(10,$resultEstoque->quantidade);
    }
}
