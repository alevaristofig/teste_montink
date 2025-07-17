<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cupom extends Model
{
    protected $table = "cupons";

     protected $fillable = [
        'nome', 'desconto', 'validade'
    ];
}
