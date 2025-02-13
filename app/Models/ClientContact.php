<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientContact extends Model
{
    protected $fillable = ['nome', 'cpf', 'telefone', 'cliente_id'];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
