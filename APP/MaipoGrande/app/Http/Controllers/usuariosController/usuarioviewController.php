<?php

namespace App\Http\Controllers\usuariosController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\persona;
use App\Models\usuario;
use App\Models\tipo_persona_legal;
use App\Models\perfil;

class usuarioviewController extends Controller
{

    const PAGINACION=10;
    public function ViewPanelUsuario(Request $request)
    
    {


            $usuarios = DB::select('CALL SP_GET_USUARIO()', array());
            $comunas = DB::select('CALL SP_GET_COMUNAS()');
            $tipo_persona_legal = tipo_persona_legal::all();
            $perfil = perfil::all();


            $data = [

                'perfil' => $perfil,
                'tipo_persona_legal' => $tipo_persona_legal,
                'usuarios' => $usuarios,
                'comunas' => $comunas
            ];

           //return dd($usuarios);
    
           return view('/usuarioadmin', $data);
   
    }

   
    public function CrearUser(Request $request)
    {
    
    try {    
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

        session()->flash('type', 'success');
        session()->flash('message', 'Usuario Creado');

    } catch (\Exception $e){
        session()->flash('type', 'danger');
        session()->flash('message', 'No se creo el usuario','{$nombre}');
    }

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
        try {
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

            session()->flash('type', 'success');
            session()->flash('message', 'Usuario modificado');
        } catch (\Exception $e){
            session()->flash('type', 'danger');
            session()->flash('message', 'No se modifico el usuario');
        }

        return redirect()->back();
    }

    public function getUserByRut(Request $request){
        try {
            //obtener datos
            $Rut = $request->get('rut');
            

            //obtener persona por rut
            $Persona = persona::find($Rut);

            //obtener usuario por persona
            $Usuario = usuario::find($Persona->ID_USUARIO);

            //obtener perfil por usuario
            $Perfil = perfil::find($Usuario->ID_PERFIL);

            //obtener tipo persona legal
            $TipoPersonaLegal = tipo_persona_legal::find($Persona->ID_TIPO_PERSONA_LEGAL);

            $data = [
                'persona' => $Persona,
                'usuario' => $Usuario,
                'perfil' => $Perfil,
                'tipoPersonaLegal' => $TipoPersonaLegal,
                'status' => 'success'
            ];
        } catch (\Exception $e) {
            $data = [
                'exception' => $e,
                'status' => 'error'
            ];
        }

        // $dataUser = DB::table('persona')
        //     ->join('usuario', 'persona.correo', 'persona.contrasenia', '=', 'usuario.')
        //     ->join('perfil', 'persona.nombre', '=', 'orders.user_id')
        //     ->select('users.id', 'contacts.phone', 'orders.price')
        //     ->get();

        
                    //SELECT ID_USUARIO,RUT, DIGITO_VERIFICADOR, NOMBRE, APELLIDO, NOMBRE_FANTASIA, CODIGO_POSTAL 
        //FROM persona JOIN usuario
           // ON persona.ID_USUARIO = usuario.ID_USUARIO

        return response()->json($data);

    }
}


