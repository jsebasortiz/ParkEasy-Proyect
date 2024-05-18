<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Index
    public function index(Request $request)
    {
        $users = User::all();
        return response()->json([
            'status' => true,
            'users' => $users
        ]);
    }

    // Crear
    public function store(Request $request)
    {
        try {
            // Validar los datos de entrada
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
            ]);
    
            // Crear el usuario
            $user = User::create($validatedData);
    
            // Devolver respuesta exitosa
            return response()->json([
                'status' => true,
                'message' => "Usuario creado exitosamente!",
                'user' => $user
            ], 201); // Cambiado a 201 Created para indicar que se creó un recurso
    
        } catch (\Throwable $th) {
            // Devolver respuesta de error
            return response()->json([
                'status' => false,
                'message' => "Error al crear el usuario",
                'error' => $th->getMessage() // Agregado para mostrar el mensaje de error específico
            ], 500);
        }
    }
    

    // Show
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'El usuario no existe.'], 404);
        }

        return response()->json(['user' => $user]);
    }


    //update
    public function update(Request $request, $id)
{
    try {
        // Encontrar el usuario a actualizar
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'El usuario no existe.'], 404);
        }

        // Actualizar los datos del usuario con los campos proporcionados en la solicitud
        $user->update($request->all());

        // Devolver respuesta exitosa
        return response()->json([
            'status' => true,
            'message' => "Usuario actualizado exitosamente!",
            'user' => $user
        ], 200);

    } catch (\Throwable $th) {
        // Devolver respuesta de error
        return response()->json([
            'status' => false,
            'message' => "Error al actualizar el usuario",
            'error' => $th->getMessage() // Agregado para mostrar el mensaje de error específico
        ], 500);
    }
}



    // Delete
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'El usuario no existe.'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'El usuario fue eliminado correctamente.']);
    }
}
