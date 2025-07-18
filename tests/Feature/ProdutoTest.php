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

    public function test_ListarProdutosSucesso(): void 
    {

        $produto1 = new Produto();
        $produto1->nome = "Produto Teste";
        $produto1->preco = 100;
        $produto1->variacoes = "variacoes teste 1";

        $produto2 = new Produto();
        $produto2->nome = "Produto Teste 2";
        $produto2->preco = 100.44;
        $produto2->variacoes = "variacoes teste 2";
        $produto1->estoque = [
            "id" => 2,
            "id_produto" => 2,
            "quantidade" => 8
        ];

        $dados = [
            $produto1,
            $produto2
        ];

        $mock = Mockery::mock('alias:' . Produto::class);
        $mock->shouldReceive('all')
            ->once()            
            ->andReturn($dados);

        $result = Produto::all();

        $this->assertCount(2,$result);
        $this->assertEquals('Produto Teste',$result[0]->nome);
        $this->assertEquals(100.44,$result[1]->preco);
    }

    public function test_BuscarProdutoSucesso(): void 
    {

        $id = 1;
        $produto = new Produto();
        $produto->nome = "Produto Teste";
        $produto->preco = 100;
        $produto->variacoes = "variacoes teste 1";
        $produto->estoque = [
            "id" => 1,
            "id_produto" => 1,
            "quantidade" => 10
        ];

        $mock = Mockery::mock('alias:' . Produto::class);
        $mock->shouldReceive('find')
            ->once()    
            ->with($id)        
            ->andReturn($produto);

        $result = Produto::find($id);

        $this->assertEquals('variacoes teste 1',$result->variacoes);
        $this->assertEquals(10,$result->estoque['quantidade']);
    }

    public function test_AtualizarProdutoSucesso(): void 
    {

        $id = 1;
        $produto = new Produto();
        $produto->nome = "Produto Teste";
        $produto->preco = 100;
        $produto->variacoes = "variacoes teste 1";
        $produto->estoque = [
            "id" => 1,
            "id_produto" => 1,
            "quantidade" => 10
        ];

        $mock = Mockery::mock('alias:' . Produto::class);
        $mockEstoque = Mockery::mock('alias:' . Estoque::class);

        $mock->shouldReceive('find')
            ->once()    
            ->with($id)        
            ->andReturn($produto);

        $produtoUpdate = Produto::find($id);

        $produtoUpdate->nome = "Produto Teste Update";
        $produtoUpdate->preco = 200;
        $produtoUpdate->variacoes = "variacoes teste update";
        $produtoUpdate->estoque = [
            "id" => 1,
            "id_produto" => 1,
            "quantidade" => 5
        ];

        $mock->shouldReceive('create')
            ->once()
            ->with($produtoUpdate)
            ->andReturn($produtoUpdate);

         $mockEstoque->shouldReceive('create')
            ->once()
            ->with($produtoUpdate->estoque)
            ->andReturn($produtoUpdate->estoque);

        $result = Produto::create($produtoUpdate);
        $resultEstoque = Estoque::create($produtoUpdate->estoque);

        $this->assertInstanceOf(Produto::class,$result);
        $this->assertEquals('Produto Teste Update',$result->nome);  
        $this->assertEquals(5,$resultEstoque['quantidade']);        
    }

        public function test_DeletarProdutoSucesso(): void 
        {

        $id = 1;

        $mock = Mockery::mock('alias:' . Produto::class);      

        $mock->shouldReceive('delete')
            ->once()
            ->with($id)
            ->andReturnTrue();

        $result = Produto::delete($id);
       
        $this->assertTrue($result);                
    }
}
