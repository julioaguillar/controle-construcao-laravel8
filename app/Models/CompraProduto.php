<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;

class CompraProduto extends Model
{

    protected $table = 'compras_produto';
    protected $fillable = ['data', 'fornecedor_id', 'forma_pagamento_id', 'pdf', 'nome_pdf'];

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class, 'fornecedor_id');
    }

    public function forma_pagamento()
    {
        return $this->belongsTo(FormaPagamento::class, 'forma_pagamento_id');
    }

    public function dataFormatada()
    {
        return Helper::formatDateBr($this->data);
    }

    public function compra_produto_itens()
    {
        return $this->hasMany(CompraProdutoItem::class, 'compras_produto_id');
    }

}
