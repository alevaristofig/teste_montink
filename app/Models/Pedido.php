<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    
    protected $fillable = [
        "id_usuario", "produtos", "valor_total", "quantidade", "endereco", "valor_frete",
        "desconto", "status"
    ];
}
