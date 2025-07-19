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

         public function listar(): JsonResponse 
         {
            try {
                $produtos = $this->model->with('estoques:produto_id,quantidade')->get();

                return response()->json($produtos,200);
            } catch(\Exception $e) {
                $message = new ApiMessages("Ocorreu um erro, a operção não foi realizada",$e->getMessage());
                return response()->json(['error' => $message->getMessage()], 500);
            }
        }
        
        public function salvar(ProdutoRequest $request): JsonResponse 
        {           
            try {       
                DB::beginTransaction();

                $dados = $request->all();

                $produto = [
                    'nome' => $dados['nome'],
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

                return response()->json($produto, 201);
            } catch(\Exception $e) {
                DB::rollBack();               
                $message = new ApiMessages("Ocorreu um erro, a operção não foi realizada",$e->getMessage());
                return response()->json(['error' => $message->getMessage()], 500);
            } 
        }

        public function buscar(int $id): JsonResponse 
        {
            try {                
                $produto = $this->model->with('estoques:produto_id,quantidade')
                    ->where('id', $id)
                    ->get();

                return response()->json($produto, 200);
            } catch(\Exception $e) {
                $message = new ApiMessages("Ocorreu um erro, a operção não foi realizada",$e->getMessage());
                return response()->json(['error' => $message->getMessage()], 500);
            }
        }

        public function atualizar(int $id, ProdutoRequest $request): JsonResponse 
        {
            try {
                
                $produto = $this->model->find($id);

                $dados = $request->all();

                $produto->nome = $dados['nome'];
                $produto->preco = $dados['preco'];
                $produto->variacoes = $dados['variacoes'];

                $produto->save();

                $estoque = [
                    'produto_id' => $id,
                    'quantidade' => $dados['estoque']['quantidade']
                ];

                if(!$this->serviceEstoque->atualizar($id, $estoque)) {
                    throw new \Exception();
                }

                return response()->json($produto, 200);
                            
            } catch(\Exception $e) {
                $message = new ApiMessages("Ocorreu um erro, a operção não foi realizada",$e->getMessage());
                return response()->json(['error' => $message->getMessage()], 500);
            }
        }

        public function deletar(int $id): JsonResponse 
        {
            try {
                $produto = $this->model->find($id);

                $produto->estoques()->delete();
                $produto->delete();

                return response()->json(['msg' => "Produto Removido Com Sucesso"], 204);
            } catch(\Exception $e) {
                $message = new ApiMessages("Ocorreu um erro, a operção não foi realizada",$e->getMessage());
                return response()->json(['error' => $message->getMessage()], 500);
            }
        }
    }