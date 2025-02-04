<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $fillable = ['cpf', 'cnpj', 'nome', 'razao_social', 'telefone_1', 'telefone_2'];
    public function contatos(): HasMany
    {
        return $this->hasMany(Contato::class);
    }
}
