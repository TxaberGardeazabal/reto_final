<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos_pedido extends Model
{
    use HasFactory;

    public function productos(){
        return $this->hasMany(Producto::class);
    }

    public function pedido(){
        return $this->hasOne(Pedido::class);
    }
}
