<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Caja;


class CajaController extends Controller
{
    //Index
    public function index(Request $request)
    {
        $caja = Caja::all();
        // dd(2);
        return response()->json([
            'status' => true,
            'caja' => $caja
        ]);
    }

    //Create
    public function store(Request $request)
    {
        //try {
            $caja = Caja::create($request->all());

            return response()->json([
                'status' => true,
                'message' => "Caja creada exitosamente!",
                'caja' => $caja
            ], 200);
    }
    //Show
    public function show($id)
    {
        $caja = Caja::find($id);

        if (!$caja) {
            return response()->json(['error' => 'La caja no existe.'], 404);
        }
        return response()->json(['caja' => $caja]);
    }
    //Update
    public function update(Request $request)
    {
        try {
            $caja = Caja::find($request->id_factura);
            //dd($request->request);

            if (!$caja) {
                return response()->json(['error' => 'La caja no existe.'], 404);
            }
            $caja->update($request->all()) ;
            return response()->json([
                'status' => true,
                'message' => "caja actualizada correctamente.",
                'caja' => $caja
            ], 200); 
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Error al actualizar la caja"
            ], 500);
        }
}
    //Delete
    public function destroy($id)
    {
        $caja = Caja::find($id);

        if (!$caja) {
            return response()->json(['error' => 'La caja no existe.'], 404);
        }
        $caja->delete();
        return response()->json(['message' => 'La caja fue eliminada correctamente.']);
    }
}
