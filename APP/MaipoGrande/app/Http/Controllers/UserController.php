<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function index()
    {
        return view('/registrarse');
    }
    public function insertarUser(Request $request)
    {


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
        $contrasenia = md5($request->get('contrasenia'));

        $InsertarUser = DB::select(
            'call SP_CREATE_USUARIO(?,?,?,?,?,?,?,?,?,?,?,?)',
            array($nombre, $apellido, $rut, $dv, $comuna, $codigopostal, $correo, $contrasenia, $telefono, $tipopersona, $nombrefantasia, $tipocomprador)
        );

        return back()->with('status', "Se ha creado el usuario {$correo} satisfactoriamente!");
    }

    public function CargarComuna() //int $rol)
    {
        $comunas = DB::select('CALL SP_GET_COMUNAS()');
        return view('registro', compact('comunas'));

        /* $comunas= comuna::select('NombreComuna','nombre')->get();
        return view('id_comuna',compact('comunas')); */
    }
}
