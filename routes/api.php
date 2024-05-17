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
use App\Http\Controllers\Api\V1\IngresoVehiculosController;

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
    Route::get('tipovehiculos/{id_tipovehiculo}', [TipoVehiculoController::class, 'show']);
    Route::post('tipovehiculosagregar', [TipoVehiculoController::class, 'store']);
    Route::delete('tipovehiculosdestroy/{id_tipovehiculo}', [TipoVehiculoController::class, 'destroy']);
    Route::post('tipovehiculosact', [TipoVehiculoController::class, 'update']);
    //IngresoVehiculos --> Full
    Route::get('ingresovehiculosver', [IngresoVehiculosController::class, 'index']);
    Route::get('ingresovehiculosbuscar/{placa_vehiculo}', [IngresoVehiculosController::class, 'show']);
    Route::post('ingresovehiculosagregar', [IngresoVehiculosController::class, 'store']);
    Route::delete('ingresovehiculosdestroy/{placa_vehiculo}', [IngresoVehiculosController::class, 'destroy']);
    Route::post('ingresovehiculosact', [IngresoVehiculosController::class, 'update']);
    //Facturas --> Full
    Route::get('facturaver', [FacturaController::class, 'index']);
    Route::get('facturabuscar/{id_factura}', [FacturaController::class, 'show']);
    Route::post('facturaagregar', [FacturaController::class, 'store']);
    Route::delete('facturadestroy/{id_factura}', [FacturaController::class, 'destroy']);
    Route::post('facturaact', [FacturaController::class, 'update']);
    //Caja --> Full
    Route::get('cajaver', [CajaController::class, 'index']);
    Route::get('cajabuscar/{id_caja}', [CajaController::class, 'show']);
    Route::post('cajaagregar', [CajaController::class, 'store']);
    Route::delete('cajadestroy/{id_caja}', [CajaController::class, 'destroy']);
    Route::post('cajaact', [CajaController::class, 'update']);
    //MovimientosCaja --> Full
    Route::get('movimientoscajaver', [MovimientosCajaController::class, 'index']);
    Route::get('movimientobuscar/{id_caja}', [MovimientosCajaController::class, 'show']);
    Route::post('movimientoscajaagregar', [MovimientosCajaController::class, 'store']);
    Route::delete('movimientoscajadestroy/{id_caja}', [MovimientosCajaController::class, 'destroy']);
    Route::post('movimientoscajaact', [MovimientosCajaController::class, 'update']);
    //Establecimiento --> Full
    Route::get('establecimientover', [EstablecimientoController::class, 'index']);
    Route::get('estacionamientobuscar/{id_establecimiento}', [EstablecimientoController::class, 'show']);
    Route::post('establecimientoagregar', [EstablecimientoController::class, 'store']);
    Route::delete('establecimientodestroy/{id_establecimiento}', [EstablecimientoController::class, 'destroy']);
    Route::post('establecimientoact', [EstablecimientoController::class, 'update']);
    //Espacio_estacionamiento --> Full
    Route::get('espacioestacionamientover', [EspacioEstacionamientoController::class, 'index']);
    Route::get('espacioestacionamientobuscar/{id_espacio}', [EspacioEstacionamientoController::class, 'show']);
    Route::post('espacioestacionamientoagregar', [EspacioEstacionamientoController::class, 'store']);
    Route::delete('espacioestacionamientodestroy/{id_espacio}', [EspacioEstacionamientoController::class, 'destroy']);
    Route::post('espacioestacionamientoact', [EspacioEstacionamientoController::class, 'update']);
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