<?php

namespace App\Http\Controllers\usuariosController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class usuarioviewController extends Controller
{
    public function ViewPanelUsuario()
    
    {
            $usuarios = DB::select('CALL SP_GET_USUARIO()', array());
            $comunas = DB::select('CALL SP_GET_COMUNAS()');

            $data = [

                'usuarios' => $usuarios,
                'comunas' => $comunas
            ];

           //return dd($usuarios);
    
           return view('/usuarioadmin', $data);
   
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
            array(
                $nombre, $apellido, $rut, $dv, $comuna, $codigopostal, $correo,
                $contrasenia, $telefono, $tipopersona, $nombrefantasia, $tipocomprador
            )
        );

        //if($CrearUser){
          //  $status = 404;
           
        //}else{
          //  $status = 202;
        //}

       // return($status);


    return response()->json( $CrearUser);
       // return back()->with('status', "Se ha creado el usuario {$correo} satisfactoriamente!");


    }


    

}
