<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


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
        return $request->get('nombre');
        return $request->get('apellido');
        return $request->get('rut');
        return $request->get('dv');
        return $request->get('tipocomprador');
        return $request->get('tipopersona');
        return $request->get('comuna');
        return $request->get('codigopostal');
        return $request->get('telefono');
        return $request->get('nombrefantasia');
        return $request->get('correo');
        return $request->get('contrasenia');

        $InsertarUser = DB::select('call SP_CREATE_USUARIO(?,?,?,?,?,?,?,?,?,?,?)',
                array('nombre','apellido','rut','dv','comuna','codigopostal','correo','contrasenia','telefono','tipopersona','nombrefantasia','tipocomprador'));
    }
    
}