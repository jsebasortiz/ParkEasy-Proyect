<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Factura;


class FacturaController extends Controller
{
    //Index
    public function index(Request $request)
    {
        $factura = Factura::all();
        // dd(2);
        return response()->json([
            'status' => true,
            'factura' => $factura
        ]);
    }

     //Create
    public function store(Request $request)
    {
        //try {
            $factura = Factura::create($request->all());

            return response()->json([
                'status' => true,
                'message' => "Factura creada exitosamente!",
                'factura' => $factura
            ], 200);
        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => "Error al crear la factura"
        //     ], 500);
        // }
    }
    //Show
    public function show($id_factura)
    {
        $factura = Factura::find($id_factura);

        if (!$factura) {
            return response()->json(['error' => 'La factura no existe.'], 404);
        }
        return response()->json(['factura' => $factura]);
    }
    //Update
    public function update(Request $request)
    {
        try {
            $factura = Factura::find($request->id_factura);
            //dd($request->request);

            if (!$factura) {
                return response()->json(['error' => 'La factura no existe.'], 404);
            }
            /*$factura->placa_vehiculo = $request->placa_vehiculo;
            $factura->placa_vehiculo = $request->placa_vehiculo;
            $factura->update();*/

            $factura->update($request->all()) ;

            return response()->json([
                'status' => true,
                'message' => "factura actualizada correctamente.",
                'factura' => $factura
            ], 200); 
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Error al actualizar la factura"
            ], 500);
        }
}
    //Delete
    public function destroy($id)
    {
        $factura = Factura::find($id);

        if (!$factura) {
            return response()->json(['error' => 'La factura no existe.'], 404);
        }
        $factura->delete();
        return response()->json(['message' => 'La factura fue eliminada correctamente.']);
    }
}
