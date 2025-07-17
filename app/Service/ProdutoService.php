<?php

    namespace App\Service;

    use Illuminate\Http\JsonResponse;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Pagination\LengthAwarePaginator;
    use Illuminate\Support\Facades\DB;
    use App\Repository\ProdutoRepository;
    use App\Http\Requests\ProdutoRequest;
    use App\Models\Produto;
    use App\Exceptions\ApiMessages;

    class ProdutoService implements ProdutoRepository {

        private $model;
        private $serviceEstoque;

        public function __construct(Produto $model, EstoqueService $serviceEstoque) {
            $this->model = $model;
            $this->serviceEstoque = $serviceEstoque;
        }
        
        public function salvar(ProdutoRequest $request): JsonResponse {
           
            try {       
                DB::beginTransaction();

                $dados = $request->all();

                $produto = [
                    'nomez' => $dados['nome'],
                    'preco' => $dados['preco'],
                    'variacoes' => $dados['variacoes'], 
                ];                                                

                $produto = $this->model->create($produto);  

                $estoque = [
                    'produto_id' => $produto['id'],
                    'quantidade' => $dados['estoque']['quantidade']
                ];

                $this->serviceEstoque->salvar($estoque);
                
                DB::commit();

                return response()->json($produto, 201);;
            } catch(\Exception $e) {
                DB::rollBack();               
                $message = new ApiMessages("Ocorreu um erro, a operção não foi realizada",$e->getMessage());
                return response()->json(['error' => $message->getMessage()], 500);
            } 
        }

        public function listar(): Collection {
            try {

                
              /*  if(auth('api')->user()->tipo == 'A') {
                    return $this->model->all();
                }

                $produto = $this->model->whereHas('fornecedor.fornecedorUsuario', function ($query) {
                    $query->where('usuario_id', auth('api')->user()->id);
                })->with(['fornecedor'])->get();

                return $produto;*/
                
            } catch(\Exception $e) {
                dd($e);
            }
        }

        public function buscar(int $id): Produtos {
            try {
                return $this->model->find($id);
            } catch(\Exception $e) {
                dd($e);
            }
        }

        public function atualizar(int $id, ProdutoRequest $request): Produtos {
            try {
                
                $produto = $this->model->find($id);

                $produto->referencia = $request->referencia;
                $produto->nome = $request->nome;
                $produto->cor = $request->cor;
                $produto->preco = $request->preco;

                $produto->save();

                return $produto;
                            
            } catch(\Exception $e) {
                dd($e);
            }
        }

        public function deletar(int $id): void {
            try {
                $produto = $this->model->find($id);

                $produto->delete();
            } catch(\Exception $e) {
                dd($e);
            }
        }
    }