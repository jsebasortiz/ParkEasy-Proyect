<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\MovimientosCaja;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MovimientosCajaController extends Controller 
{
    //obtener todos los registros
    public function index(Request $request)
    {
        $movimientos = MovimientosCaja::all();
        return response()->json([
            'status' => true,
            'movimientos' => $movimientos
        ]);
    }

    //crear registro
    public function store(Request $request)
    {
        try {
            $movimiento = MovimientosCaja::create($request->all());

            return response()->json([
                'status' => true,
                'message' => "¡¡Movimiento creado exitosamente!!",
                'movimiento' => $movimiento
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "--Error al crear el movimiento--"
            ], 500);
        }
    }

    //obtener registro específico por ID
    public function show($id)
    {
        $movimiento = MovimientosCaja::find($id);

        if (!$movimiento) {
            return response()->json(['error' => 'El movimiento no existe.'], 404);
        }
        return response()->json(['movimiento' => $movimiento]);
    }

    //actualizar  registro específico por ID
    public function update(Request $request)
    {
        try {
            $movimiento = MovimientosCaja::find($request->id_movimiento);
            //dd($request->request);

            if (!$movimiento) {
                return response()->json(['error' => 'La movimiento no existe.'], 404);
            }
            /*$movimiento->placa_vehiculo = $request->placa_vehiculo;
            $movimiento->placa_vehiculo = $request->placa_vehiculo;
            $movimiento->update();*/

            $movimiento->update($request->all()) ;

            return response()->json([
                'status' => true,
                'message' => "movimiento actualizada correctamente.",
                'movimiento' => $movimiento
            ], 200); 
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Error al actualizar el movimiento"
            ], 500);
        }
}

    

    //eliminar registro específico por ID
    public function destroy($id)
    {
        try {
            $movimiento = MovimientosCaja::find($id);

            if (!$movimiento) {
                return response()->json(['error' => 'El movimiento no existe.'], 404);
            }
            $movimiento->delete();
            return response()->json(['message' => 'El movimiento fue eliminado correctamente.']);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Error al eliminar el movimiento"
            ], 500);
        }
    }
}

