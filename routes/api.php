<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CupomController;

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
    });

    Route::group([
        'as' => 'cupom'
       // 'middleware'=> \Tymon\JWTAuth\Http\Middleware\Authenticate::class
    ], function() {      
        Route::post('/cupom',[CupomController::class,'salvar']);
    });
});
