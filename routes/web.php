<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('erp_gerenciamento')->group(function() {
    Route::group([
        'as' => 'produto'
       // 'middleware'=> \Tymon\JWTAuth\Http\Middleware\Authenticate::class
    ], function() {
       // Route::resource('produtos',ProdutoController::class);
        Route::post('/',[ProdutoController::class,'salvar']);
    });
});
