<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('categoria' , 'App\Http\Controllers\CategoriasController')->middleware('auth:sanctum');

Route::apiResource('suscripcion' , 'App\Http\Controllers\SuscripcionesController')->middleware('auth:sanctum');

Route::apiResource('comercio' , 'App\Http\Controllers\ComercioController')->middleware('auth:sanctum');

Route::apiResource('usuarios' , 'App\Http\Controllers\UserController')->middleware('auth:sanctum');
