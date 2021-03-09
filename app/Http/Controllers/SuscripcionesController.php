<?php

namespace App\Http\Controllers;

use App\Models\suscripciones;
use Illuminate\Http\Request;

class SuscripcionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return suscripciones::all();
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
            'subtitulo' => 'required',
            'precio' => 'required',
            'descripcion' => 'required',
        ]);

        $suscripciones = new suscripciones;
        $suscripciones->nombre = $request->nombre;
        $suscripciones->subtitulo = $request->subtitulo;
        $suscripciones->precio = $request->precio;
        $suscripciones->descripcion = $request->descripcion;

        $suscripciones->save();

        return response ("Suscripcion creada" , 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\suscripciones  $suscripciones
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return suscripciones::find($id);
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
        this->validate($request , [
            'nombre' => 'required',
            'subtitulo' => 'required',
            'precio' => 'required',
            'descripcion' => 'required',
        ]);

        $suscripciones = suscripciones::find($id);
        $suscripciones->nombre = $request->nombre;
        $suscripciones->subtitulo = $request->subtitulo;
        $suscripciones->precio = $request->precio;
        $suscripciones->descripcion = $request->descripcion;

        $suscripciones->save();

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
        suscripciones::find($id)->delete();

        return response("Eliminado correctamente" , 200);
    }
}
