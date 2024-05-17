<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngresoVehiculos extends Model
{
    use HasFactory;

    protected $table = 'ingreso_vehiculos';
    protected $primaryKey = 'placa_vehiculo'; // Cambia 'mi_clave_primaria' por el nombre de tu columna de clave primaria personalizada
    protected $keyType = 'string'; // Esto indica que la clave primaria es de tipo string
    
    protected $fillable = [
        'placa_vehiculo',
        'fecha_ingreso',
        'tipo_vehiculo',
        'id_espacio',
        'fecha_salida',
    ];

    public $timestamps = false;
}
