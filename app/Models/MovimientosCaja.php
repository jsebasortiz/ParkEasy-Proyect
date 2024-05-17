<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Se importa la base de datos para la consulta de secuencias

class MovimientosCaja extends Model
{
    use HasFactory;

    protected $table = 'movimientos_caja'; 
    protected $primaryKey = 'id_caja';
    public $incrementing = false; //el incremento automatico del id_caja comienza en falso
    protected $keyType = 'integer';//clave de tipo entero
    public $timestamps = false;
    

    protected $fillable = [
        'descripcion_movimiento',
        'tipo_movimiento',
        'monto_pagar',
        
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {//esto se ejecuta antes de que un registro sea insertado en la BD.
            // Obtener el siguiente valor de la secuencia que comienza en 1 e incrementa de uno en uno.
            $nextId = DB::selectOne("SELECT nextval('movimientoscaja_id_caja_seq') as id")->id;
            $model->id_caja = $nextId;//el valor obtenido  se agina a la propiedad id_caja
        });
    }
}