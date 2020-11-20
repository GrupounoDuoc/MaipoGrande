<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class AdminController extends Controller
{
    //
    public function index()
    {
        return view('/index');
    }
    public function CrearUser(Request $request)
    {


        $nombre = $request->get('nombre');
        $apellido = $request->get('apellido');
        $rut = $request->get('rut');
        $dv = $request->get('dv');
        $tipocomprador = $request->get('tipocomprador');
        $tipopersona = $request->get('tipopersona');
        $comuna = $request->get('comuna');
        $codigopostal = $request->get('codigopostal');
        $telefono = $request->get('telefono');
        $nombrefantasia = $request->get('nombrefantasia');
        $correo = $request->get('correo');
        $contrasenia = $request->get('contrasenia');


        $CrearUser = DB::select(
            'call SP_CREATE_USUARIO(?,?,?,?,?,?,?,?,?,?,?,?)',
            array($nombre, $apellido, $rut, $dv, $comuna, $codigopostal, $correo, 
            $contrasenia, $telefono, $tipopersona, $nombrefantasia, $tipocomprador)
        );

        return back()->with('status', "Se ha creado el usuario {$correo} satisfactoriamente!");
    } 

    public function CargarComuna() //int $rol)
    {
        $comunas = DB::select('CALL SP_GET_COMUNAS()');
        return view('CrearUser', compact('comunas'));

        /* $comunas= comuna::select('NombreComuna','nombre')->get();
        return view('id_comuna',compact('comunas')); */
    }

    public function EliminarUser(Request $request)
    {
        $rut = $request->get('rut');

        $EliminarUser = DB::select(
            'call SP_DELETE_USUARIO(?)',
            array($rut)
        );

        return back()->with('status', "Se ha eliminado el usuario con rut {$rut} satisfactoriamente!");
    }

    public function CargarComunaB() //int $rol)
    {
        $comunas = DB::select('CALL SP_GET_COMUNAS()');
        return view('ModificarUser', compact('comunas'));

        /* $comunas= comuna::select('NombreComuna','nombre')->get();
        return view('id_comuna',compact('comunas')); */
    }

    public function ModificarUser(Request $request)
    {


        $nombre = $request->get('nombre');
        $apellido = $request->get('apellido');
        $rut = $request->get('rut');
        $tipocomprador = $request->get('tipocomprador');
        $tipopersona = $request->get('tipopersona');
        $comuna = $request->get('comuna');
        $codigopostal = $request->get('codigopostal');
        $telefono = $request->get('telefono');
        $nombrefantasia = $request->get('nombrefantasia');
        $correo = $request->get('correo');
        $contrasenia = $request->get('contrasenia');


        $ModificarUser = DB::select(
            'call SP_UPDATE_USUARIO(?,?,?,?,?,?,?,?,?,?,?)',
            array($nombre, $apellido, $rut, $tipocomprador,
            $tipopersona, $nombrefantasia, $comuna, $codigopostal,
            $telefono, $correo, $contrasenia)
        );

        return back()->with('status', "Se ha modificado el usuario con rut {$rut} satisfactoriamente!");
    } 
    public function listarUser(Request $request)
    {
        $usuarios = DB::select('CALL SP_GET_USUARIO()',array());

        return view('/ListarUser', compact('usuarios'));
    }

    public function IngresarProducto(Request $request)
    {


        $nombreFruta = $request->get('nombreFruta');
        $descripcion = $request->get('descripcion');
        $imagen = $request->get('imagen');


        $IngresarProducto = DB::select(
            'call SP_CREATE_TIPO_FRUTA(?,?,?)',
            array($nombreFruta, $descripcion, $imagen)
        );

        return back()->with('status', "Se ha creado la fruta {$nombreFruta} satisfactoriamente!");
    } 
}
