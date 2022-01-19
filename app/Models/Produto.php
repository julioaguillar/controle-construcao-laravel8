<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['codigo', 'gtin', 'descricao', 'unidade_medida'];

    public function compraProdutoItens()
    {
        return $this->hasMany(CompraProdutoItem::class, 'produto_id');
    }

}
