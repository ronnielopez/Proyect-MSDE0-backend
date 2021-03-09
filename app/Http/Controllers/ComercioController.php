<?php

namespace App\Http\Controllers;

use App\Models\comercio;
use App\Models\User;
use Illuminate\Http\Request;

class ComercioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return comercio::all();
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
            'direccion' => 'required',
            'telefono' => 'required',
            'rubro' => 'required',
        ]);

        $comercio = new comercio;
        $comercio->nombre = $request->nombre;
        $comercio->direccion = $request->direccion;
        $comercio->telefono = $request->telefono;
        $comercio->rubro = $request->rubro;

        $comercio->save();

        return response ("Comercio creada" , 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\comercio  $comercio
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return comercio::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\comercio  $comercio
     * @return \Illuminate\Http\Response
     */
    public function edit(comercio $comercio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\comercio  $comercio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request , [
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'rubro' => 'required',
        ]);

        $comercio = comercio::find($id);
        $comercio->nombre = $request->nombre;
        $comercio->direccion = $request->direccion;
        $comercio->telefono = $request->telefono;
        $comercio->rubro = $request->rubro;

        $comercio->save();

        return response ("Comercio actualizado" , 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\comercio  $comercio
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        comercio::find($id)->delete();

        return response("Comercio eliminado correctamente" , 200);
    }
}
