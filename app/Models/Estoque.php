<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Estoque extends Model
{
    protected $fillable = [
        'produto_id', 'quantidade'
    ];

    public function produtos(): BelongsTo {
        return $this->belongsTo(Produto::class);
    }
}


