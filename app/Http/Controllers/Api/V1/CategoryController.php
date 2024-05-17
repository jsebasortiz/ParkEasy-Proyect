<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $categorias = Categoria::all();
        // dd(2);
        return response()->json([
            'status' => true,
            'categorias' => $categorias
        ]);
    }

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

    public function show($id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json(['error' => 'La categoría no existe.'], 404);
        }
        return response()->json(['categoria' => $categoria]);
    }

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
