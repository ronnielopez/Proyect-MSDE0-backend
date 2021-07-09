<?php

namespace App\Http\Controllers;

use App\Models\Clinicas;
use Illuminate\Http\Request;

class ClinicasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Clinicas::all();
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
            'logo' => 'required',
            'subDescripcion' => 'required',
            'descripcion' => 'required',
            'apr1' => 'required',
            'apr2' => 'required',
            'userId' => 'required',
            'categoriaId' => 'required',
            'estado' => 'required'
        ]);
        
        $clinica = new Clinicas;
        
        $clinica->nombre = $request->nombre;
        //logo almacenamiento
        $file_name = $request->file('logo')->getClientOriginalName();
        $request->file('logo')->storeAs('logos', $file_name, 'public');
        $clinica->logo = $file_name;
        $clinica->subDescripcion = $request->subDescripcion;
        $clinica->descripcion = $request->descripcion;
        $clinica->apr1 = $request->apr1;
        $clinica->apr2 = $request->apr2;
        $clinica->userId = $request->userId;
        $clinica->categoriaId = $request->categoriaId;
        $clinica->estado = $request->estado;

        $clinica->save();

        return response ("Clinica creada" , 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clinicas  $clinicas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Clinicas::find($id);
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
            'logo' => 'required',
            'subDescripcion' => 'required',
            'descripcion' => 'required',
            'apr1' => 'required',
            'apr2' => 'required',
            'userId' => 'required',
            'categoriaId' => 'required',
            'estado' => 'required'
        ]);
        
        $clinica = Clinicas::find($id);
        
        $clinica->nombre = $request->nombre;
        //logo almacenamiento
        $file_name = $request->file('logo')->getClientOriginalName();
        $request->file('logo')->storeAs('logos', $file_name, 'public');
        $clinica->logo = $file_name;
        $clinica->subDescripcion = $request->subDescripcion;
        $clinica->descripcion = $request->descripcion;
        $clinica->apr1 = $request->apr1;
        $clinica->apr2 = $request->apr2;
        $clinica->userId = $request->userId;
        $clinica->categoriaId = $request->categoriaId;
        $clinica->estado = $request->estado;

        $clinica->save();

        return response ("Clinica actualizada" , 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clinicas  $clinicas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Clinicas::find($id)->delete();

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
            'logo' => 'required',
            'subDescripcion' => 'required',
            'descripcion' => 'required',
            'apr1' => 'required',
            'apr2' => 'required',
            'userId' => 'required',
            'categoriaId' => 'required'
        ]);
        
        $clinica = new Clinicas;
        
        $clinica->nombre = $request->nombre;
        //logo almacenamiento
        $file_name = $request->file('logo')->getClientOriginalName();
        $request->file('logo')->storeAs('logos', $file_name, 'public');
        $clinica->logo = $file_name;
        $clinica->subDescripcion = $request->subDescripcion;
        $clinica->descripcion = $request->descripcion;
        $clinica->apr1 = $request->apr1;
        $clinica->apr2 = $request->apr2;
        $clinica->userId = $request->userId;
        $clinica->categoriaId = $request->categoriaId;

        $clinica->save();

        return response ("Clinica creada" , 201);

    }

    public function showApi($id)
    {
        return Clinicas::where("userId", $id)->get();
    }

    public function getPubliclyStorgeFile($filename)
    {    
        $url = asset('storage/logos/'.$filename);
        return $url;

    }	
}
