<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;

class ServicoTomado extends Model
{
    protected $table = 'servicos_tomado';
    protected $fillable = ['data', 'servico_id', 'prestador_servico_id', 'forma_pagamento_id', 'valor', 'pdf', 'nome_pdf'];

    public function setValorAttribute($value)
    {
        $this->attributes['valor'] = Helper::valToUS($value);
    }

    public function servico()
    {
        return $this->belongsTo(Servico::class, 'servico_id');
    }

    public function prestador_servico()
    {
        return $this->belongsTo(PrestadorServico::class, 'prestador_servico_id');
    }

    public function forma_pagamento()
    {
        return $this->belongsTo(FormaPagamento::class, 'forma_pagamento_id');
    }

    public function dataFormatada()
    {
        return Helper::formatDateBr($this->data);
    }

}
