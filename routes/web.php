<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\SuscripcionesController;
use App\Http\Controllers\ComercioController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClinicasController;
use App\Http\Controllers\SucursalesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Auth/Login');
});

Route::middleware(['auth:sanctum', 'verified'] )->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'] )->get('/categorias', function () {
    return Inertia::render('Categories/CategoriesView');
})->name('categorias');

Route::resource('categoria', CategoriasController::class)
    ->middleware(['auth:sanctum', 'verified']);

Route::middleware(['auth:sanctum', 'verified'] )->get('/suscripciones', function () {
    return Inertia::render('Suscripciones/SuscripcionesView');
})->name('suscripciones');
    
Route::resource('suscripcion', SuscripcionesController::class)
    ->middleware(['auth:sanctum', 'verified']);

Route::middleware(['auth:sanctum', 'verified'] )->get('/comercio', function () {
    return Inertia::render('Comercios/ComercioView');
})->name('comercio');
        
Route::resource('comercios', ComercioController::class)
    ->middleware(['auth:sanctum', 'verified']);

Route::middleware(['auth:sanctum', 'verified'] )->get('/usuarios', function () {
    return Inertia::render('Usuarios/UsuariosView');
})->name('usuarios');

Route::resource('usuario', UserController::class)
    ->middleware(['auth:sanctum', 'verified']);

    
Route::middleware(['auth:sanctum', 'verified'] )->get('/clinicas', function () {
        return Inertia::render('Clinicas/ClinicaView');
})->name('clinicas');
    
Route::resource('clinica', ClinicasController::class)
    ->middleware(['auth:sanctum', 'verified']);


Route::resource('sucursal', SucursalesController::class)
    ->middleware(['auth:sanctum', 'verified']);
