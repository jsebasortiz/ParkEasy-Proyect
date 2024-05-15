<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipoVehiculo;


/**
 * @OA\Schema(
 *     schema="TipoVehiculo",
 *     title="TipoVehiculo",
 *     @OA\Property(
 *         property="nombre",
 *         type="string",
 *         description="Nombre de la categoría"
 *     ),
 *     @OA\Property(
 *         property="descripcion",
 *         type="string",
 *         description="Descripción de la categoría"
 *     )
 * )
 */
class TipoVehiculoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/categories",
     *     summary="Obtener todas las categorías",
     *     @OA\Response(
     *         response=200,
     *         description="Retorna todas las categorías.",
     *        
     *     )
     * )
     */
    public function index(Request $request)
    {
        $tipovehiculos = TipoVehiculo::all();
        // dd(2);
        return response()->json([
            'status' => true,
            'tipovehiculos' => $tipovehiculos
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/categories",
     *     summary="Crear una nueva categoría",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/TipoVehiculo")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Categoría creada exitosamente.",
     *         @OA\JsonContent(ref="#/components/schemas/TipoVehiculo")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al crear la categoría."
     *     )
     * )
     */
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

    /**
     * @OA\Get(
     *     path="/api/v1/categories/{id}",
     *     summary="Obtener una categoría por su ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la categoría",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="La categoría no existe."
     *     )
     * )
     */
    public function show($id)
    {
        $tipovehiculo = TipoVehiculo::find($id);

        if (!$tipovehiculo) {
            return response()->json(['error' => 'La categoría no existe.'], 404);
        }
        return response()->json(['tipovehiculo' => $tipovehiculo]);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/categories/{id}",
     *     summary="Actualizar una categoría por su ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la categoría",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/TipoVehiculo")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="La categoría no existe."
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        try {
            $tipovehiculo = TipoVehiculo::find($id);

            if (!$tipovehiculo) {
                return response()->json(['error' => 'La categoría no existe.'], 404);
            }
            $tipovehiculo->update($request->all());
            return response()->json([
                'status' => true,
                'message' => "Categoría actualizada correctamente.",
                'tipovehiculo' => $tipovehiculo
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Error al actualizar la categoría"
            ], 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/categories/{id}",
     *     summary="Eliminar una categoría por su ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la categoría",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="La categoría no existe."
     *     )
     * )
     */
    public function destroy($id)
    {
        $tipovehiculo = TipoVehiculo::find($id);

        if (!$tipovehiculo) {
            return response()->json(['error' => 'La categoría no existe.'], 404);
        }
        $tipovehiculo->delete();
        return response()->json(['message' => 'La categoría fue eliminada correctamente.']);
    }
}
