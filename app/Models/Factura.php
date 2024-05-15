<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    protected $table = 'factura';
    protected $primaryKey = 'id_factura'; // Cambia 'mi_clave_primaria' por el nombre de tu columna de clave primaria personalizada

    protected $fillable = [
        'id_factura',
        'placa_vehiculo',
        'monto_pagar',
        'fecha_salida'    
    ];

    public $timestamps = false;
}
