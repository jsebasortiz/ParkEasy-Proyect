<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspacioEstacionamiento extends Model
{
    use HasFactory;

    protected $table = 'espacio_estacionamiento';
    protected $primaryKey = 'id_espacio';
    public $timestamps = false;

    protected $fillable = [
        'nombre_espacio',
        'tipo_vehiculo',
        'id_espacio',
        'ocupado',
    ];

    protected $casts = [
        'ocupado' => 'boolean', // Para indicar que 'ocupado' es un campo booleano
    ];
}
