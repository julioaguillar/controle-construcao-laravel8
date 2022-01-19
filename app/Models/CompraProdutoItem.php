<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;

class CompraProdutoItem extends Model
{

    protected $table = 'compras_produto_item';
    protected $fillable = ['compra_produto_id', 'produto_id', 'valor', 'quantidade', 'total'];

    public function setValorAttribute($value)
    {
        $this->attributes['valor'] = Helper::valToUS($value);
    }

    public function setQuantidadeAttribute($value)
    {
        $this->attributes['quantidade'] = Helper::valToUS($value);
    }

    public function setTotalAttribute($value)
    {
        $this->attributes['total'] = Helper::valToUS($value);
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }

    public function compra_produto()
    {
        return $this->belongsTo(CompraProduto::class, 'id');
    }

}
