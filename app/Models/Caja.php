<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;
    protected $table = 'caja';
    protected $primaryKey = 'id_caja'; // Cambia 'mi_clave_primaria' por el nombre de tu columna de clave primaria personalizada

    protected $fillable = [
        'id_caja',
        'nombre_caja',
        'saldo',
        'nombre_admin'    
    ];

    public $timestamps = false;
}
