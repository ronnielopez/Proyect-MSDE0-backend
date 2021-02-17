<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;

class Categoriascontroller extends Controller
{
    
    public function categorias(Request $request){
        return Categoria::all();
    }


    public function store(Request $request)
    {
        $categoria = new Categoria([
            'nombre' => $request->input('nombre')
        ]);
        $categoria->save();

        return response()->json('Categoria creada!');
    }

    public function show($id)
    {
        $categoria = Categoria::find($id);
        return response()->json($categoria);
    }

    public function update($id, Request $request)
    {
        $categoria = Categoria::find($id);
        $categoria->update($request->all());

        return response()->json('Categoria modificada!');
    }

    public function destroy($id)
    {
        $categoria = Categoria::find($id);
        $categoria->delete();

        return response()->json('Categoria eliminada!');
    }
}
