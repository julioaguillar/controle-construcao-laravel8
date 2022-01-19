<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrestadorServico extends Model
{

    protected $table = 'prestadores_servico';
    protected $fillable = ['cnpj', 'cpf', 'nome', 'endereco', 'telefone', 'celular', 'contato', 'email'];

    public function servicosTomado()
    {
        return $this->hasMany(ServicoTomado::class, 'prestador_servico_id');
    }

}
