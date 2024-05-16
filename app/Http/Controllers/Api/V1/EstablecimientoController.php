<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Establecimiento;

class EstablecimientoController extends Controller{
    public function index(Request $request)
    {
        $establecimiento = Establecimiento::all();
        // dd(2);
        return response()->json([
            'status' => true,
            'establecimiento' => $establecimiento
        ]);
    }

    public function store(Request $request)
    {
        //try {
            $establecimiento = Establecimiento::create($request->all());

            return response()->json([
                'status' => true,
                'message' => "Establecimiento fue creado exitosamente!",
                'establecimiento' => $Establecimiento
            ], 200);
        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => "Error al crear el Establecimiento"
        //     ], 500);
        // }
    }

    public function show($id)
    {
        $establecimiento = Establecimiento::find($id);

        if (!$establecimiento) {
            return response()->json(['error' => 'La categoría no existe.'], 404);
        }
        return response()->json(['establecimiento' => $establecimiento]);
    }

    public function update(Request $request, $id)
    {
        try {
            $establecimiento = Establecimiento::find($id);

            if (!$establecimiento) {
                return response()->json(['error' => 'La categoría no existe.'], 404);
            }
            $tipovehiculo->update($request->all());
            return response()->json([
                'status' => true,
                'message' => "Establecimiento actualizada correctamente.",
                'establecimiento' => $establecimiento
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Error al actualizar el Establecimiento"
            ], 500);
        }
    }

    public function destroy($id)
    {
        $establecimiento = Establecimiento::find($id);

        if (!$tipovehiculo) {
            return response()->json(['error' => 'El Establecimiento no existe.'], 404);
        }
        $establecimiento->delete();
        return response()->json(['message' => 'El establecimiento fue eliminado correctamente.']);
    }
}