<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    use HasFactory;

    public function proveedors(){
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    protected $table='catalogo';
    protected $primarykey = 'id_doc';
    public $timestamps = false;
     protected $fillable= [
        'NombreCatálogo',
        'proveedor_id',
        'FechaDeCatalogo',
        'Documento',
    ];
}
