<?php

namespace App\Http\Controllers;

use App\Models\Sucursales;
use Illuminate\Http\Request;

class SucursalesController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Sucursales::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request , [
            'nombre' => 'required',
            'ubicacion' => 'required',
            'puntosReferencia' => 'required',
            'horarioI' => 'required',
            'horarioF' => 'required',
            'descripcion' => 'required',
            'telefono' => 'required',
            'municipio' => 'required',
            'departamento' => 'required',
            'clinicaId' => 'required',
            'estado' => 'required',
        ]);

        $sucursal = new Sucursales;
        $sucursal->nombre = $request->nombre;
        $sucursal->ubicacion = $request->ubicacion;
        $sucursal->puntosReferencia = $request->puntosReferencia;
        $sucursal->horarioI = $request->horarioI;
        $sucursal->horarioF = $request->horarioF;
        $sucursal->descripcion = $request->descripcion;
        $sucursal->telefono = $request->telefono;
        $sucursal->municipio = $request->municipio;
        $sucursal->departamento = $request->departamento;
        $sucursal->clinicaId = $request->clinicaId;
        $sucursal->estado = $request->estado;

        $sucursal->save();

        return response ("Sucursal creada" , 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\suscripciones  $suscripciones
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Sucursales::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\suscripciones  $suscripciones
     * @return \Illuminate\Http\Response
     */
    public function edit(suscripciones $suscripciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\suscripciones  $suscripciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request , [
            'nombre' => 'required',
            'ubicacion' => 'required',
            'puntosReferencia' => 'required',
            'horarioI' => 'required',
            'horarioF' => 'required',
            'descripcion' => 'required',
            'telefono' => 'required',
            'municipio' => 'required',
            'departamento' => 'required',
            'clinicaId' => 'required',
            'estado' => 'required',
        ]);

        $sucursal = Sucursales::find($id);
        $sucursal->nombre = $request->nombre;
        $sucursal->ubicacion = $request->ubicacion;
        $sucursal->puntosReferencia = $request->puntosReferencia;
        $sucursal->horarioI = $request->horarioI;
        $sucursal->horarioF = $request->horarioF;
        $sucursal->descripcion = $request->descripcion;
        $sucursal->telefono = $request->telefono;
        $sucursal->municipio = $request->municipio;
        $sucursal->departamento = $request->departamento;
        $sucursal->clinicaId = $request->clinicaId;
        $sucursal->estado = $request->estado;

        $sucursal->save();

        return response ("Suscripcion actualizada" , 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\suscripciones  $suscripciones
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sucursales::find($id)->delete();

        return response("Eliminado correctamente" , 200);
    }

    public function storeApi(Request $request)
    {
        $this->validate($request , [
            'nombre' => 'required',
            'ubicacion' => 'required',
            'puntosReferencia' => 'required',
            'horarioI' => 'required',
            'horarioF' => 'required',
            'descripcion' => 'required',
            'telefono' => 'required',
            'municipio' => 'required',
            'departamento' => 'required',
            'clinicaId' => 'required'
        ]);

        $sucursal = new Sucursales;
        $sucursal->nombre = $request->nombre;
        $sucursal->ubicacion = $request->ubicacion;
        $sucursal->puntosReferencia = $request->puntosReferencia;
        $sucursal->horarioI = $request->horarioI;
        $sucursal->horarioF = $request->horarioF;
        $sucursal->descripcion = $request->descripcion;
        $sucursal->telefono = $request->telefono;
        $sucursal->municipio = $request->municipio;
        $sucursal->departamento = $request->departamento;
        $sucursal->clinicaId = $request->clinicaId;

        $sucursal->save();

        return response ("Sucursal creada" , 201);
    }
    public function editApi(Request $request , $id)
    {
        $this->validate($request , [
            'nombre' => 'required',
            'ubicacion' => 'required',
            'puntosReferencia' => 'required',
            'horarioI' => 'required',
            'horarioF' => 'required',
            'descripcion' => 'required',
            'telefono' => 'required',
            'municipio' => 'required',
            'departamento' => 'required'
        ]);

        $sucursal = Sucursales::find($id);
        $sucursal->nombre = $request->nombre;
        $sucursal->ubicacion = $request->ubicacion;
        $sucursal->puntosReferencia = $request->puntosReferencia;
        $sucursal->horarioI = $request->horarioI;
        $sucursal->horarioF = $request->horarioF;
        $sucursal->descripcion = $request->descripcion;
        $sucursal->telefono = $request->telefono;
        $sucursal->municipio = $request->municipio;
        $sucursal->departamento = $request->departamento;

        $sucursal->save();

        return response ("Sucursal actualizada" , 201);
    }
    public function showApi($id)
    {
        return Sucursales::where("clinicaId", $id)->get();
    }
}
