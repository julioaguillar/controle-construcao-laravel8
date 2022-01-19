<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormaPagamento extends Model
{

    protected $table = 'formas_pagamento';
    protected $fillable = ['descricao'];

    public function servicosTomado()
    {
        return $this->hasMany(ServicoTomado::class, 'forma_pagamento_id');
    }

    public function comprasProduto()
    {
        return $this->hasMany(CompraProduto::class, 'forma_pagamento_id');
    }

}
