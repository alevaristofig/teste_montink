<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Produto extends Model
{
    protected $fillable = [
        'nome', 'preco', 'variacoes'
    ];

    public function estoques(): HasOne {
        return $this->hasOne(Estoque::class);
    }
}
