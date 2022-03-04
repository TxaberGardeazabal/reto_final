<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // hipotetico
    /*public function pedidos() {
        return $this->hasMany(Pedido::class);
    }*/

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class,'productos_pedidos','producto_id','pedido_id')->withPivot('cantidad');
    }
}
