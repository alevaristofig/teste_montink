<?php

    namespace App\Service;

    use App\Repository\ProdutoRepository;
    use App\Http\Requests\ProdutoRequest;
    use App\Models\Produto;
   // use App\Models\Estoque;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Pagination\LengthAwarePaginator;
    use Illuminate\Support\Facades\DB;

    class ProdutoService implements ProdutoRepository {

        private $model;
        private $serviceEstoque;

        public function __construct(Produto $model, EstoqueService $serviceEstoque) {
            $this->model = $model;
            $this->serviceEstoque = $serviceEstoque;
        }
        
        public function salvar(ProdutoRequest $request): Produto {
            try {       
                DB::beginTransaction();

                $produto = $this->model->create($request->all());  

                $this->serviceEstoque->salvar();
                
                DB::commit();
            } catch(\Exception $e) {
                DB::rollBack();
                dd($e->getMessage());
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