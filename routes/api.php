<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\TipoVehiculoController;
use App\Http\Controllers\Api\V1\FacturaController;
use App\Http\Controllers\Api\V1\EstablecimientoController;
use App\Http\Controllers\Api\V1\EspacioEstacionamientoController;
use App\Http\Controllers\Api\V1\CajaController;
use App\Http\Controllers\Api\V1\MovimientosCajaController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    //Prefijo V1, todo lo que este dentro de este grupo se accedera escribiendo v1 en el navegador,
    // es decir /api/v1/*

    //Login
    Route::post('login', [AuthController::class, 'authenticate']);
    Route::post('register', [AuthController::class, 'register']);

    //Tipovehiculos --> Full
    Route::get('tipovehiculosver', [TipoVehiculoController::class, 'index']);
    Route::post('tipovehiculosagregar', [TipoVehiculoController::class, 'store']);
    Route::delete('tipovehiculosdestroy/{id_tipovehiculo}', [TipoVehiculoController::class, 'destroy']);
    Route::post('tipovehiculosact', [TipoVehiculoController::class, 'update']);
    //Facturas --> Full
    Route::get('facturaver', [FacturaController::class, 'index']);
    Route::post('facturaagregar', [FacturaController::class, 'store']);
    Route::delete('facturadestroy/{id_factura}', [FacturaController::class, 'destroy']);
    Route::post('facturaact', [FacturaController::class, 'update']);
    //Caja --> Full
    Route::get('cajaver', [CajaController::class, 'index']);
    Route::post('cajaagregar', [CajaController::class, 'store']);
    Route::delete('cajadestroy/{id_caja}', [CajaController::class, 'destroy']);
    Route::post('cajaact', [CajaController::class, 'update']);
    //MovimientosCaja --> Full
    Route::get('movimientoscajaver', [MovimientosCajaController::class, 'index']);
    Route::post('movimientoscajaagregar', [MovimientosCajaController::class, 'store']);
    Route::delete('movimientoscajadestroy/{id_caja}', [MovimientosCajaController::class, 'destroy']);
    Route::post('movimientoscajaact', [MovimientosCajaController::class, 'update']);
    //Establecimiento --> Full
    Route::get('establecimientover', [EstablecimientoController::class, 'index']);
    Route::post('establecimientoagregar', [EstablecimientoController::class, 'store']);
    Route::delete('establecimientodestroy/{id_establecimiento}', [EstablecimientoController::class, 'destroy']);
    Route::post('establecimientoact', [EstablecimientoController::class, 'update']);
    //Espacio_estacionamiento
    Route::get('espacioestacionamientover', [EstablecimientoController::class, 'index']);
    Route::post('espacioestacionamientoagregar', [EstablecimientoController::class, 'store']);
    Route::delete('espacioestacionamientodestroy/{id_espacio}', [EstablecimientoController::class, 'destroy']);
    Route::post('espacioestacionamientoact', [EstablecimientoController::class, 'update']);
    //

    Route::get('categorias', [CategoryController::class, 'index']);

    //Route::post('tipovehiculosstore', [TipoVehiculoController::class, 'store']);
    // Route::delete('tipovehiculosdestroy/{id_vehiculo}', [TipoVehiculoController::class, 'destroy']);
    // Route::get('favorites', [FavoriteController::class, 'index']);
    // Route::get('favorites/{id}', [FavoriteController::class, 'show']);
    // Route::apiResource('categoria', CategoriaController::class);
    //Todo lo que este dentro de este grupo requiere verificación de usuario.
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('get-user', [AuthController::class, 'getUser']);
        Route::post('update-user', [AuthController::class, 'updateUser']);
        
        
    });
});