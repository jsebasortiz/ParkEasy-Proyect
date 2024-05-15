<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoVehiculo extends Model
{
    use HasFactory;

    protected $table = 'tipovehiculo';
    protected $primaryKey = 'id_vehiculo'; // Cambia 'mi_clave_primaria' por el nombre de tu columna de clave primaria personalizada

    protected $fillable = [
        'id_vehiculo',
        'nombre',
        'valor_hora',
        'valor_dia',
        'valor_mes',
    ];

    public $timestamps = false;
}
