<?php
namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;


class AuthController extends Controller
{
    
    //**Función para registrar al usuario**//
    public function register(Request $request)
    {

        $data = $request->only('name', 'email', 'password');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password)
        ]);
        //guarda el usuario y la contraseña para realizar la petición de token a JWTAuth
        $credentials = $request->only('email', 'password');
        //devuelve la respuesta con el token del usuario
        return response()->json([
            'message' => 'Usuario creado',
            'token' => JWTAuth::attempt($credentials),
            'user' => $user
        ], Response::HTTP_OK);
    }

    
    //Funcion para hacer login
    public function authenticate(Request $request)
    {

        $credentials = $request->only('email', 'password');
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 400);
        }
        //entra al login
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                //Credenciales incorrectas.
                return response()->json([
                    'message' => 'Login failed',
                ], 401);
            }
        } catch (JWTException $e) {
            //Error
            return response()->json([
                'message' => 'Error',
            ], 500);
        }
        //devuelve el token
        return response()->json([
            'token' => $token,
            'user' => Auth::user(),
            'message' => 'success',
            'status' => 'ok'
        ], 200);
    }

    
    //Función para eliminar el token y desconectar al usuario
    public function logout(Request $request)
    {
        $validator = Validator::make($request->only('token'), [
            'token' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }

        try {
            //Si el token es valido elimina el token desconectando al usuario.
            JWTAuth::invalidate($request->token);
            return response()->json([
                'success' => true,
                'message' => 'Usuario Desconectado'
            ]);
        } catch (JWTException $exception) {
            //Error 
            return response()->json([
                'success' => false,
                'message' => 'Error'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    //Función que obtiene los datos del usuario y valida si el token a expirado.
    public function getUser(Request $request)
    {
        // dd($request->request);
        $this->validate($request, [
            'token' => 'required'
        ]);

        //Realiza la autentificación
        $user = JWTAuth::authenticate($request->token);
        //Si no hay usuario es que el token no es valido o que ha expirado
        if (!$user)
            return response()->json([
                'message' => 'Invalid token / token expired',
            ], 401);
        //Devuelve los datos del usuario si todo va bien. 
        return response()->json(['user' => $user]);
    }

    
    //Función que actualiza los datos del usuario
    public function updateUser(Request $request)
    {

        $this->validate($request, [
            'token' => 'required'
        ]);
        //Realiza la autentificación
        $user = JWTAuth::authenticate($request->token);
        //Si no hay usuario es que el token no es valido o que ha expirado
        if (!$user)
            return response()->json([
                'message' => 'Invalid token / token expired',
            ], 401);

        try {
            $user->update($request->all());

        } catch (JWTException $e) {
            //Error
            return response()->json([
                'message' => 'Error al momento de actualizar!',
            ], 500);
        }
        //devuelve el token
        return response()->json([

            'user' => Auth::user(),
            'message' => 'Usuario actualizado Correctamente',
            'status' => 'ok'
        ], 200);
        return response()->json(['user' => $user]);
    }
}
