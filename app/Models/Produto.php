<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produto extends Model
{
    protected $fillable = [
        'nome', 'preco', 'variacoes'
    ];

    public function estoques(): BelongsTo {
        return $this->belongsTo(Estoque::class);
    }
}
