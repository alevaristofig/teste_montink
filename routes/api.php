<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('erp_gerenciamento')->group(function() {
    Route::group([
        'as' => 'produto'
       // 'middleware'=> \Tymon\JWTAuth\Http\Middleware\Authenticate::class
    ], function() {
       // Route::resource('produtos',ProdutoController::class);
        Route::post('/produto',[ProdutoController::class,'salvar']);
    });
});
