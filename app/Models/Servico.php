<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{

    protected $fillable = ['descricao'];

    public function servicosTomado()
    {
        return $this->hasMany(ServicoTomado::class, 'servico_id');
    }

}
