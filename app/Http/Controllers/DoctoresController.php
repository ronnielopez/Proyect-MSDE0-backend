<?php

namespace App\Http\Controllers;

use App\Models\Doctores;
use Illuminate\Http\Request;

class DoctoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Doctores::all();
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
            'foto' => 'required',
            'descripcion' => 'required',
            'sucursalId' => 'required',
            'categoriaId' => 'required',
            'estado' => 'required'
        ]);
        
        $doctores = new Doctores;
        
        $doctores->nombre = $request->nombre;
        //logo almacenamiento
        $file_name = $request->file('foto')->getClientOriginalName();
        $request->file('foto')->storeAs('PerfilDoc', $file_name, 'public');
        $doctores->foto = $file_name;
        $doctores->descripcion = $request->descripcion;
        $doctores->sucursalID = $request->sucursalId;
        $doctores->categoriaId = $request->categoriaId;
        $doctores->estado = $request->estado;

        $doctores->save();

        return response ("Doctor añadido" , 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clinicas  $clinicas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Doctores::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clinicas  $clinicas
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
     * @param  \App\Models\Clinicas  $clinicas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request , [
            'nombre' => 'required',
            'foto' => 'required',
            'descripcion' => 'required',
            'sucursalId' => 'required',
            'categoriaId' => 'required',
            'estado' => 'required'
        ]);
        
        $doctores = Doctores::find($id);
        
        $doctores->nombre = $request->nombre;
        //logo almacenamiento
        $file_name = $request->file('foto')->getClientOriginalName();
        $request->file('foto')->storeAs('PerfilDoc', $file_name, 'public');
        $doctores->foto = $file_name;
        $doctores->descripcion = $request->descripcion;
        $doctores->sucursalID = $request->sucursalId;
        $doctores->categoriaId = $request->categoriaId;
        $doctores->estado = $request->estado;

        $doctores->save();

        return response ("Doctores actualizados" , 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clinicas  $clinicas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Doctores::find($id)->delete();

        return response("Eliminado correctamente" , 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeApi(Request $request)
    {
        $this->validate($request , [
            'nombre' => 'required',
            'foto' => 'required',
            'descripcion' => 'required',
            'sucursalId' => 'required',
            'categoriaId' => 'required'
        ]);
        
        $doctores = new Doctores;
        
        $doctores->nombre = $request->nombre;
        //logo almacenamiento
        $file_name = $request->file('foto')->getClientOriginalName();
        $request->file('foto')->storeAs('PerfilDoc', $file_name, 'public');
        $doctores->foto = $file_name;
        $doctores->descripcion = $request->descripcion;
        $doctores->sucursalID = $request->sucursalId;
        $doctores->categoriaId = $request->categoriaId;

        $doctores->save();

        return response ("Doctor añadido" , 201);

    }

    public function editApi(Request $request, $id)
    {
        $this->validate($request , [
            'nombre' => 'required',
            'foto' => 'required',
            'descripcion' => 'required',
            'categoriaId' => 'required'
        ]);
        
        $doctores = Doctores::find($id);
        
        $doctores->nombre = $request->nombre;
        //logo almacenamiento
        $file_name = $request->file('foto')->getClientOriginalName();
        $request->file('foto')->storeAs('PerfilDoc', $file_name, 'public');
        $doctores->foto = $file_name;
        $doctores->descripcion = $request->descripcion;
        $doctores->categoriaId = $request->categoriaId;

        $doctores->save();

        return response ("Doctor editado" , 201);

    }

    public function showApi($id)
    {
        return Doctores::where("sucursalId", $id)->get();
    }
}
