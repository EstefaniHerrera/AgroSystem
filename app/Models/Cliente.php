<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    public function pedidoProductosNuevos(){
        return $this->hasMany(PedidosProductosNuevos::class, 'id');
    }

    public function devoluciones(){
        return $this->hasMany(DevolucionCliente::class, 'id');
    }
}
