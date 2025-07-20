<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CupomController;
use App\Http\Controllers\PedidoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('erp_gerenciamento')->group(function() {
    Route::group([
        'as' => 'produto'
       // 'middleware'=> \Tymon\JWTAuth\Http\Middleware\Authenticate::class
    ], function() {      
        Route::get('/produto',[ProdutoController::class,'listar']);
        Route::post('/produto',[ProdutoController::class,'salvar']);
        Route::put('/produto/{id}',[ProdutoController::class,'atualizar']);
        Route::get('/produto/{id}',[ProdutoController::class,'buscar']);
        Route::delete('/produto/{id}',[ProdutoController::class,'deletar']);
    });

    Route::group([
        'as' => 'cupom'
       // 'middleware'=> \Tymon\JWTAuth\Http\Middleware\Authenticate::class
    ], function() {      
        Route::get('/cupom',[CupomController::class,'listar']);
        Route::get('/cupom/{id}',[CupomController::class,'buscar']);
        Route::post('/cupom',[CupomController::class,'salvar']);
        Route::put('/cupom/{id}',[CupomController::class,'atualizar']);
        Route::delete('/cupom/{id}',[CupomController::class,'deletar']);
    });

     Route::group([
        'as' => 'pedido'
       // 'middleware'=> \Tymon\JWTAuth\Http\Middleware\Authenticate::class
    ], function() {      
        Route::get('/pedido',[PedidoController::class,'listar']);
        Route::post('/pedido',[PedidoController::class,'realizarPedidos']);
        Route::delete('/pedido',[PedidoController::class,'removerCarrinho']);
    });
});
