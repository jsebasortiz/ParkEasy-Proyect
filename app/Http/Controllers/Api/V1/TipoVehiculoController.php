<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipoVehiculo;


class TipoVehiculoController extends Controller
{
    //Index
    public function index(Request $request)
    {
        $tipovehiculos = TipoVehiculo::all();
        // dd(2);
        return response()->json([
            'status' => true,
            'tipovehiculos' => $tipovehiculos
        ]);
    }

    //Crear
    public function store(Request $request)
    {
        //try {
            $tipovehiculo = TipoVehiculo::create($request->all());

            return response()->json([
                'status' => true,
                'message' => "TipoVehiculo creada exitosamente!",
                'tipovehiculo' => $tipovehiculo
            ], 200);
        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => "Error al crear la categoría"
        //     ], 500);
        // }
    }

    //Show
    public function show($id)
    {
        $tipovehiculo = TipoVehiculo::find($id);

        if (!$tipovehiculo) {
            return response()->json(['error' => 'La tipo_vehiculo no existe.'], 404);
        }
        return response()->json(['tipovehiculo' => $tipovehiculo]);
    }
    //Update
    public function update(Request $request)
    {
        try {
            $tipovehiculo = TipoVehiculo::find($request->id_vehiculo);
            //dd($request->request);
            if (!$tipovehiculo) {
                return response()->json(['error' => 'La tipo_vehiculo no existe.'], 404);
            }
            /*$tipovehiculo->placa_vehiculo = $request->placa_vehiculo;
            $tipovehiculo->placa_vehiculo = $request->placa_vehiculo;
            $tipovehiculo->update();*/

            $tipovehiculo->update($request->all()) ;

            return response()->json([
                'status' => true,
                'message' => "tipo_vehiculo actualizada correctamente.",
                'tipovehiculo' => $tipovehiculo
            ], 200); 
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Error al actualizar la tipo_vehiculo"
            ], 500);
        }
}
    //Delete
    public function destroy($id)
    {
        $tipovehiculo = TipoVehiculo::find($id);

        if (!$tipovehiculo) {
            return response()->json(['error' => 'El tipo_vehiculo no existe.'], 404);
        }
        $tipovehiculo->delete();
        return response()->json(['message' => 'El tipo_vehiculo fue eliminada correctamente.']);
    }
}
