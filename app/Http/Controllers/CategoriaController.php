<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categorias = Categoria::all();
        if ($request->expectsJson()) {
            // Si la solicitud es una API, devolver una respuesta JSON
            return response()->json([
                'status' => true,
                'categorias' => $categorias
            ]);
        } else {
            // dd($request->expectsJson());
            // Si la solicitud es de la web, devolver una vista
            return view('categorias.index', compact('categorias'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $categoria = Categoria::create($request->all());

            if ($request->expectsJson()) {
                // Si la solicitud es una API, devolver una respuesta JSON
                return response()->json([
                    'status' => true,
                    'message' => "Categoria Creada!",
                    'categoria' => $categoria
                ], 200);
            } else {
                // dd($request->expectsJson());
                // Si la solicitud es de la web, devolver una vista
                return redirect()->route('categoria.index');
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Error al crear categoria"
                // 'categoria' => $categoria
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        dd(2);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categoria = Categoria::find($id);

        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $categoria = Categoria::find($id);

            if (!$categoria) {
                return response()->json(['error' => 'La categoría no existe.'], 404);
            }
        
            $categoria->update($request->all());
        

            if ($request->expectsJson()) {

                return response()->json([
                    'status' => true,
                    'message' => "Categoria Creada!",
                    'categoria' => $categoria
                ], 200);
            } else {
                return redirect()->route('categoria.index');
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Error al crear categoria"
                // 'categoria' => $categoria
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $categoria = Categoria::find($id);
       
        if (!$categoria) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'La categoría no existe.'], 404);
            }
        }

        $categoria->delete();
       
        if ($request->expectsJson()) {
            return response()->json(['message' => 'La categoría fue eliminada correctamente.']);
        } else {
           
            return redirect()->route('categoria.index');
        }
        
    }
}
