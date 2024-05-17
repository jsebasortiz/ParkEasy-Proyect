<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EspacioEstacionamiento;

class EspacioEstacionamientoController extends Controller
{
      //Index
    public function index()
    {
        $espaciosEstacionamiento = EspacioEstacionamiento::all();
        return response()->json([
            'status' => true,
            'espacios_estacionamiento' => $espaciosEstacionamiento
        ]);
    }

       //Create
    public function store(Request $request)
    {
        try {
            $espacioEstacionamiento = EspacioEstacionamiento::create($request->all());
            return response()->json([
                'status' => true,
                'message' => "Espacio de estacionamiento creado exitosamente!",
                'espacio_estacionamiento' => $espacioEstacionamiento
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Error al crear el espacio de estacionamiento"
            ], 500);
        }
    }
   //Show
    public function show($id_espacio)
    {
        $espacioEstacionamiento = EspacioEstacionamiento::find($id_espacio);
        if (!$espacioEstacionamiento) {
            return response()->json(['error' => 'El espacio de estacionamiento no existe.'], 404);
        }
        return response()->json(['espacio_estacionamiento' => $espacioEstacionamiento]);
    }

    //Update
    public function update(Request $request)
    {
        try {
            $espacioEstacionamiento = EspacioEstacionamiento::find($request->id_espacio);
            //dd($request->request);

            if (!$espacioEstacionamiento) {
                return response()->json(['error' => 'La espacioEstacionamiento no existe.'], 404);
            }
            /*$espacioEstacionamiento->placa_vehiculo = $request->placa_vehiculo;
            $espacioEstacionamiento->placa_vehiculo = $request->placa_vehiculo;
            $espacioEstacionamiento->update();*/
            $espacioEstacionamiento->update($request->all()) ;
            return response()->json([
                'status' => true,
                'message' => "espacioEstacionamiento actualizada correctamente.",
                'espacioEstacionamiento' => $espacioEstacionamiento
            ], 200); 
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Error al actualizar la espacioEstacionamiento"
            ], 500);
        }
}
   //Delete
    public function destroy($id_espacio)
    {
        $espacioEstacionamiento = EspacioEstacionamiento::find($id_espacio);
        if (!$espacioEstacionamiento) {
            return response()->json(['error' => 'El espacio de estacionamiento no existe.'], 404);
        }
        $espacioEstacionamiento->delete();
        return response()->json(['message' => 'El espacio de estacionamiento fue eliminado correctamente.']);
    }
}
