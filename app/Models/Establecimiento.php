<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establecimiento extends Model
{
    use HasFactory;

    protected $table = 'establecimiento';
    protected $primaryKey = 'id_establecimiento';

    protected $fillable = [
        'id_establecimiento',
        'nombre_establecimiento',
        'descripcion',
        'direccion',
        'nit'
    ];
}