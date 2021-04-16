<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function index(Request $request)
    {
        $user= User::where('email', $request->email)->first();
        // print_r($data);
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }
        
             $token = $user->createToken('my-app-token')->plainTextToken;
        
            $response = [
                'user' => $user,
                'token' => $token
            ];
        
             return response($response, 201);
    }

    function registrar(Request $request)
    {
        $this->validate($request , [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $usuario = new User;
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);


        $usuario->save();

        return response ("Guardado correctamente" , 201);

    }

    function planes(Request $request, $id)
    {
        $this->validate($request , [
            'estado' => 'required'
        ]);

        $usuario = User::find($id);
        $usuario->estado = $request->estado;
        $usuario->save();

        return response ("Actualizado correctamente" , 201);

    }


    function recuperarContra(Request $request){
        $this->validate($request , [
            'email' => 'required'
        ]);

        $base = str_split('abcdefghijklmnopqrstuvwxyz'.'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.'0123456789!@#$%&');
        //shuffle($base);
        $rand = '';

        $usuario = User::where('email', $request->email);
        $usuario->pin = $rand;
    }
}
