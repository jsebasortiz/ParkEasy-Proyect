<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EspacioEstacionamiento;

class EspacioEstacionamientoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/espacios-estacionamiento",
     *     summary="Obtener todos los espacios de estacionamiento",
     *     @OA\Response(
     *         response=200,
     *         description="Retorna todos los espacios de estacionamiento."
     *     )
     * )
     */
    public function index()
    {
        $espaciosEstacionamiento = EspacioEstacionamiento::all();
        return response()->json([
            'status' => true,
            'espacios_estacionamiento' => $espaciosEstacionamiento
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/espacios-estacionamiento",
     *     summary="Crear un nuevo espacio de estacionamiento",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre_espacio", "tipo_vehiculo", "ocupado"},
     *             @OA\Property(property="nombre_espacio", type="string"),
     *             @OA\Property(property="tipo_vehiculo", type="string"),
     *             @OA\Property(property="ocupado", type="boolean")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Espacio de estacionamiento creado exitosamente."
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al crear el espacio de estacionamiento."
     *     )
     * )
     */
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

    /**
     * @OA\Get(
     *     path="/api/v1/espacios-estacionamiento/{id}",
     *     summary="Obtener un espacio de estacionamiento por su ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del espacio de estacionamiento",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="El espacio de estacionamiento no existe."
     *     )
     * )
     */
    public function show($id)
    {
        $espacioEstacionamiento = EspacioEstacionamiento::find($id);
        if (!$espacioEstacionamiento) {
            return response()->json(['error' => 'El espacio de estacionamiento no existe.'], 404);
        }
        return response()->json(['espacio_estacionamiento' => $espacioEstacionamiento]);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/espacios-estacionamiento/{id}",
     *     summary="Actualizar un espacio de estacionamiento por su ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del espacio de estacionamiento",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre_espacio", "tipo_vehiculo", "ocupado"},
     *             @OA\Property(property="nombre_espacio", type="string"),
     *             @OA\Property(property="tipo_vehiculo", type="string"),
     *             @OA\Property(property="ocupado", type="boolean")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="El espacio de estacionamiento no existe."
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $espacioEstacionamiento = EspacioEstacionamiento::find($id);
        if (!$espacioEstacionamiento) {
            return response()->json(['error' => 'El espacio de estacionamiento no existe.'], 404);
        }
        $espacioEstacionamiento->update($request->all());
        return response()->json([
            'status' => true,
            'message' => "Espacio de estacionamiento actualizado correctamente.",
            'espacio_estacionamiento' => $espacioEstacionamiento
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/espacios-estacionamiento/{id}",
     *     summary="Eliminar un espacio de estacionamiento por su ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del espacio de estacionamiento",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="El espacio de estacionamiento no existe."
     *     )
     * )
     */
    public function destroy($id)
    {
        $espacioEstacionamiento = EspacioEstacionamiento::find($id);
        if (!$espacioEstacionamiento) {
            return response()->json(['error' => 'El espacio de estacionamiento no existe.'], 404);
        }
        $espacioEstacionamiento->delete();
        return response()->json(['message' => 'El espacio de estacionamiento fue eliminado correctamente.']);
    }
}
