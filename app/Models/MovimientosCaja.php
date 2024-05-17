<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Se importa la base de datos para la consulta de secuencias

class MovimientosCaja extends Model
{
    use HasFactory;

    protected $table = 'movimientoscaja'; 
    protected $primaryKey = 'id_movimiento';

    protected $fillable = [
        'descripcion_movimiento',
        'tipo_movimiento',
        'monto_pagar',
        'id_caja',
        'id_movimiento'
        
    ];

    public $timestamps = false;
}
