<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Factura;


/**
 * @OA\Schema(
 *     schema="Factura",
 *     title="Factura",
 *     @OA\Property(
 *         property="nombre",
 *         type="string",
 *         description="Nombre de la factura"
 *     ),
 *     @OA\Property(
 *         property="descripcion",
 *         type="string",
 *         description="Descripción de la factura"
 *     )
 * )
 */
class FacturaController extends Controller
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
        $factura = Factura::all();
        // dd(2);
        return response()->json([
            'status' => true,
            'factura' => $factura
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/categories",
     *     summary="Crear una nueva factura",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Factura")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Categoría creada exitosamente.",
     *         @OA\JsonContent(ref="#/components/schemas/Factura")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al crear la factura."
     *     )
     * )
     */
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

    /**
     * @OA\Get(
     *     path="/api/v1/categories/{id}",
     *     summary="Obtener una factura por su ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la factura",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="La factura no existe."
     *     )
     * )
     */
    public function show($id)
    {
        $factura = Factura::find($id);

        if (!$factura) {
            return response()->json(['error' => 'La factura no existe.'], 404);
        }
        return response()->json(['factura' => $factura]);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/categories/{id}",
     *     summary="Actualizar una factura por su ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la factura",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Factura")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="La factura no existe."
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        try {
            $factura = Factura::find($id);

            if (!$factura) {
                return response()->json(['error' => 'La factura no existe.'], 404);
            }
            $factura->update($request->all());
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

    /**
     * @OA\Delete(
     *     path="/api/v1/categories/{id}",
     *     summary="Eliminar una factura por su ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la factura",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="La factura no existe."
     *     )
     * )
     */
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
