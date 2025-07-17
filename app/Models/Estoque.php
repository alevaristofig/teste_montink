<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estoque extends Model
{
    protected $fillable = [
        'produto_id', 'quantidade'
    ];

    public function produtos(): HasMany {
        return $this->hasMany(Produto::class);
    }
}


