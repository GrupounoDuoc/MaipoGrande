<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class UserController extends Controller
{
    //
    public function index()
    {
        return view('/registrarse');
    }
    public function insertarUser(Request $request)
    {
        //$name = $request->get('nombre');
        $nombre = $request->get('nombre');
        $apellido = $request->get('apellido');
        $rut =  $request->get('rut');
        $dv =  $request->get('dv');
        $tipocomprador = $request->get('tipocomprador');
        $tipopersona = $request->get('tipopersona');
        $comuna = $request->get('comuna');
        $codigopostal = $request->get('codigopostal');
        $telefono = $request->get('telefono');
        $nombrefantasia = $request->get('nombrefantasia');
        $correo = $request->get('correo');
        $contrasenia = $request->get('contrasenia');

         //$name = $request->get('nombre');

        $InsertarUser = DB::select('call SP_CREATE_USUARIO(?,?,?,?,?,?,?,?,?,?,?,?)',
                array($nombre,$apellido,$rut,$dv,$comuna,$codigopostal,$correo,$contrasenia,$telefono,$tipopersona,$nombrefantasia,$tipocomprador));
    }
    
}