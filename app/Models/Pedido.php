<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    // hipotetico
    public function productos() {
        return $this->hasMany(Producto::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
