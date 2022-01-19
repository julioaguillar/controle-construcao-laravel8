<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;

class Obra extends Model
{

    protected $fillable = ['proprietario', 'endereco', 'inicio', 'fim', 'termino', 'metragem', 'cub'];

    //public function getMetragemAttribute($value)
    //{
    //    return Helper::valToBR($value);
    //}

    public function setMetragemAttribute($value)
    {
        $this->attributes['metragem'] = Helper::valToUS($value);
    }

    //public function getCubAttribute($value)
    //{
    //    return Helper::valToBR($value);
    //}

    public function setCubAttribute($value)
    {
        $this->attributes['cub'] = Helper::valToUS($value);
    }

    //public function getValorPrevistoAttribute()
    //{
    //    return Helper::valToBR(Helper::valToUS($this->metragem) * Helper::valToUS($this->cub));
    //}

    public function getValorPrevistoAttribute()
    {
        return $this->metragem * $this->cub;
    }

}
