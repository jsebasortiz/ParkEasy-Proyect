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

/**
 * @OA\Info(title="API Auth", version="1.0")
 *
 * @OA\Server(url="http://api.marketfitcolombia.com")
 */
class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/v1/register",
     *     summary="Registrar usuarios",
     *     @OA\Response(
     *         response=200,
     *         description="Registra usuario y retorna info y token."
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Ha ocurrido un error."
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","email","password"},
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="password", type="string", format="password")
     *      *         
     *         ),
     *     ),
     * )
     */
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

    /**
     * @OA\Post(
     *     path="/api/v1/login",
     *     summary="Iniciar sesión",
     *     @OA\Response(
     *         response=200,
     *         description="Inicia sesión y retorna token."
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Credenciales inválidas."
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="password", type="string", format="password")
     *         ),
     *     ),
     * )
     */
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

    /**
     * @OA\Post(
     *     path="/api/v1/logout",
     *     summary="Cerrar sesión",
     *     @OA\Response(
     *         response=200,
     *         description="Cerrar sesión exitosamente."
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error al cerrar sesión."
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"token"},
     *             @OA\Property(property="token", type="string")
     *         ),
     *     ),
     * )
     */
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

    /**
     * @OA\Post(
     *     path="/api/v1/user",
     *     summary="Obtener información del usuario",
     *     @OA\Response(
     *         response=200,
     *         description="Información del usuario obtenida."
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Token inválido o expirado."
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"token"},
     *             @OA\Property(property="token", type="string")
     *         ),
     *     ),
     * )
     */
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

    /**
     * @OA\Post(
     *     path="/api/v1/user/update",
     *     summary="Actualizar información del usuario",
     *     @OA\Response(
     *         response=200,
     *         description="Usuario actualizado correctamente."
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Token inválido o expirado."
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"token"},
     *             @OA\Property(property="token", type="string"),
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="password", type="string", format="password")
     *         ),
     *     ),
     * )
     */
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
