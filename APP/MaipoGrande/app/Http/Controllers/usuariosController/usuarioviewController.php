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

        //$contrasenia = md5($request->get('contrasenia'));


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

    public function EliminarUser(Request $request)
    {
        $rut = $request->get('rut');

        $EliminarUser = DB::select(
            'call SP_DELETE_USUARIO(?)',
            array($rut)
        );

        return back()->with('status', "Se ha eliminado el usuario con rut {$rut} satisfactoriamente!");
    }

    public function destroyUser($rut)
    {
        DB::select('call SP_DELETE_USUARIO(?)', [$rut]);

        return back()->with('status', "Se ha eliminado el usuario con rut {$rut} satisfactoriamente!");
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

        //$contrasenia = md5($request->get('contrasenia'));


        $ModificarUser = DB::select(
            'call SP_UPDATE_USUARIO(?,?,?,?,?,?,?,?,?,?,?)',
            array(
                $nombre, $apellido, $rut, $tipocomprador,
                $tipopersona, $nombrefantasia, $comuna, $codigopostal,
                $telefono, $correo, $contrasenia
            )
        );

        //return back()->with('status', "Se ha modificado el usuario con rut {$rut} satisfactoriamente!");
    }

    public function getUserByRut(Request $request){


        $Rut = $request->get('rut');

       

        $dataUser = DB::table('persona')
        ->where('RUT', $Rut)
        ->first();

        // $dataUser = DB::table('persona')
        //     ->join('usuario', 'persona.correo', 'persona.contrasenia', '=', 'usuario.')
        //     ->join('perfil', 'persona.nombre', '=', 'orders.user_id')
        //     ->select('users.id', 'contacts.phone', 'orders.price')
        //     ->get();



                    //SELECT ID_USUARIO,RUT, DIGITO_VERIFICADOR, NOMBRE, APELLIDO, NOMBRE_FANTASIA, CODIGO_POSTAL 
        //FROM persona JOIN usuario
           // ON persona.ID_USUARIO = usuario.ID_USUARIO

        return response()->json( $dataUser);


        

    }


}


