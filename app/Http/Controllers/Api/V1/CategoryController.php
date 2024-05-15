<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @OA\Schema(
 *     schema="Categoria",
 *     title="Categoria",
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
class CategoryController extends Controller
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
        $categorias = Categoria::all();
        // dd(2);
        return response()->json([
            'status' => true,
            'categorias' => $categorias
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/categories",
     *     summary="Crear una nueva categoría",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Categoria")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Categoría creada exitosamente.",
     *         @OA\JsonContent(ref="#/components/schemas/Categoria")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al crear la categoría."
     *     )
     * )
     */
    public function store(Request $request)
    {
        try {
            $categoria = Categoria::create($request->all());

            return response()->json([
                'status' => true,
                'message' => "Categoria creada exitosamente!",
                'categoria' => $categoria
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Error al crear la categoría"
            ], 500);
        }
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
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json(['error' => 'La categoría no existe.'], 404);
        }
        return response()->json(['categoria' => $categoria]);
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
     *         @OA\JsonContent(ref="#/components/schemas/Categoria")
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
            $categoria = Categoria::find($id);

            if (!$categoria) {
                return response()->json(['error' => 'La categoría no existe.'], 404);
            }
            $categoria->update($request->all());
            return response()->json([
                'status' => true,
                'message' => "Categoría actualizada correctamente.",
                'categoria' => $categoria
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
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json(['error' => 'La categoría no existe.'], 404);
        }
        $categoria->delete();
        return response()->json(['message' => 'La categoría fue eliminada correctamente.']);
    }
}
