<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Hash;
use Mail;

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
        $pin = '';
        $base = str_split('abcdefghijklmnopqrstuvwxyz'.'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.'0123456789!@#$%&');
        shuffle($base);
        foreach (array_rand($base, 5) as $k) $pin .= $base[$k];
        $usuario = User::where('email', $request->email)->first();
        $usuario->pin = $pin;
        $usuario->save();  
        $details = [
            'title' => 'Recuperando contraseña',
            'body' => 'Este es su ping: ' ,
            'pin' => $pin
        ];
        
        Mail::to($request->email)->send(new SendMail($details));
        return response ($usuario , 201);

    }

    function cambiarContrasena(Request $request){
        $this->validate($request , [
            'id' => 'required',
            'password' => 'required'
        ]);

        $usuario = User::find($request->id);
        $usuario->password = Hash::make($request->password);
        $usuario->save();

        return response ('Contraseña actualizada' , 201);
    }



}
