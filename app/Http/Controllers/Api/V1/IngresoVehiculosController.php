<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IngresoVehiculos;

class IngresoVehiculosController extends Controller
{
    //Index
    public function index(Request $request)
    {
        $ingresovehiculos = IngresoVehiculos::all();
        // dd(2);
        return response()->json([
            'status' => true,
            'ingresovehiculos' => $ingresovehiculos
        ]);
    }

    //Crear
    public function store(Request $request)
    {
        //try {
            $ingresovehiculos = IngresoVehiculos::create($request->all());

            return response()->json([
                'status' => true,
                'message' => "IngresoVehiculos creada exitosamente!",
                'ingresovehiculos' => $ingresovehiculos
            ], 200);
        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => "Error al crear la categoría"
        //     ], 500);
        // }
    }

    //Show
    public function show($placa_vehiculo)
    {
        $ingresovehiculos = IngresoVehiculos::find($placa_vehiculo);

        if (!$ingresovehiculos) {
            return response()->json(['error' => 'La ingreso_vehiculo no existe.'], 404);
        }
        return response()->json(['ingresovehiculos' => $ingresovehiculos]);
    }
    //Update
    public function update(Request $request)
    {
        try {
            $ingresovehiculos = IngresoVehiculos::find($request->placa_vehiculo);
            //dd($request->request);
            if (!$ingresovehiculos) {
                return response()->json(['error' => 'La ingreso_vehiculo no existe.'], 404);
            }
            /*$ingresovehiculos->placa_vehiculo = $request->placa_vehiculo;
            $ingresovehiculos->placa_vehiculo = $request->placa_vehiculo;
            $ingresovehiculos->update();*/

            $ingresovehiculos->update($request->all()) ;

            return response()->json([
                'status' => true,
                'message' => "ingreso_vehiculo actualizada correctamente.",
                'ingresovehiculos' => $ingresovehiculos
            ], 200); 
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Error al actualizar la ingreso_vehiculo"
            ], 500);
        }
}
    //Delete
    public function destroy($placa_vehiculo)
    {
        $ingresovehiculos = IngresoVehiculos::find($placa_vehiculo);

        if (!$ingresovehiculos) {
            return response()->json(['error' => 'El ingreso_vehiculo no existe.'], 404);
        }
        $ingresovehiculos->delete();
        return response()->json(['message' => 'El ingreso_vehiculo fue eliminada correctamente.']);
    }
}
