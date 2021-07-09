<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClinicasController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::get('/token', function (Request $request) {
    $token = $request->session()->token();
    $token = csrf_token();
    return $token;
});*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//auth routes
Route::post('login' , 'App\Http\Controllers\AuthController@index');
Route::post('registrar' , 'App\Http\Controllers\AuthController@registrar');
Route::put('planes/{planes}' , 'App\Http\Controllers\AuthController@planes')->middleware('auth:sanctum');
Route::post('recuperar' , 'App\Http\Controllers\AuthController@recuperarContra');
Route::post('cambiarContra' , 'App\Http\Controllers\AuthController@cambiarContrasena');

//frontend routes
Route::get('planes' , 'App\Http\Controllers\SuscripcionesController@index');
Route::get('clinicas' , 'App\Http\Controllers\ClinicasController@index');
Route::get('categorias' , 'App\Http\Controllers\CategoriasController@index');
//clinica
Route::post('storeClinicas' , 'App\Http\Controllers\ClinicasController@storeApi')->middleware('auth:sanctum');
Route::get('showApiClinicas/{id}' , 'App\Http\Controllers\ClinicasController@showApi')->middleware('auth:sanctum');
Route::get('image/{filename}', 'App\Http\Controllers\ClinicasController@getPubliclyStorgeFile');
//sucursal
Route::get('showApiSucursales/{id}' , 'App\Http\Controllers\SucursalesController@showApi')->middleware('auth:sanctum');
Route::post('storeSucursal' , 'App\Http\Controllers\SucursalesController@storeApi')->middleware('auth:sanctum');
Route::put('editSucursal/{editSucursal}' , 'App\Http\Controllers\SucursalesController@editApi')->middleware('auth:sanctum');
//doctores
Route::post('storeDoctores' , 'App\Http\Controllers\DoctoresController@storeApi')->middleware('auth:sanctum');
Route::put('editDoctores' , 'App\Http\Controllers\DoctoresController@editApi')->middleware('auth:sanctum');
Route::get('showApiDoctores/{id}' , 'App\Http\Controllers\DoctoresController@showApi');

/*Route::apiResource('categoria' , 'App\Http\Controllers\CategoriasController')->middleware('auth:sanctum');
Route::apiResource('suscripcion' , 'App\Http\Controllers\SuscripcionesController')->middleware('auth:sanctum');
Route::apiResource('comercio' , 'App\Http\Controllers\ComercioController')->middleware('auth:sanctum');
Route::apiResource('usuarios' , 'App\Http\Controllers\UserController')->middleware('auth:sanctum');
*/