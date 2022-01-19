<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $table = 'fornecedores';
    protected $fillable = ['cnpj', 'cpf', 'nome', 'endereco', 'telefone', 'celular', 'contato', 'email'];

    public function comprasProduto()
    {
        return $this->hasMany(CompraProduto::class, 'fornecedor_id');
    }

}
