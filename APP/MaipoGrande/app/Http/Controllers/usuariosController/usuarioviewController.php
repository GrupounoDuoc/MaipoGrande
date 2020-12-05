<?php

namespace App\Http\Controllers\usuariosController;

use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\persona;
use App\Models\usuario;
use App\Models\tipo_persona_legal;
use App\Models\perfil;


class usuarioviewController extends Controller
{

    //const PAGINACION=10;
    public function ViewPanelUsuario(Request $request)
    
    {


            $usuarios = DB::select('CALL SP_GET_USUARIO()', array());
            $comunas = DB::select('CALL SP_GET_COMUNAS()');
            $tipo_persona_legal = tipo_persona_legal::all();
            $perfil = perfil::all();

            $personas = persona::paginate(5);

            if(isset($_GET['name'])){
                $personas =  persona::where('NOMBRE','like','%'.$_GET['name'].'%')->paginate(5);
            }

            $data = [

                'perfil' => $perfil,
                'tipo_persona_legal' => $tipo_persona_legal,
                'usuarios' => $usuarios,
                'comunas' => $comunas,
                'personas' => $personas
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
    

        //$contrasenia = md5($request->get('contrasenia'));

        $contrasenia = md5($request->get('contrasenia'));

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
        session()->flash('message', 'No se creo el usuario');
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

        
        
    }

    
    

    public function destroyUser($rut)
    {
        DB::select('call SP_DELETE_USUARIO(?)', [$rut]);

        session()->flash('type', 'success');
        session()->flash('message', 'Usuario eliminado con exito!');

        return redirect('usuario');

        //return redirect('usuario')->with('status', "Se ha eliminado el usuario con rut {$rut} satisfactoriamente!");
    }




    public function ModificarUser(Request $request)
    {
        $res = persona::where('RUT',$request->rut)->update([
            "NOMBRE" => $request->nombre,
            "APELLIDO" => $request->apellido,
            "NOMBRE_FANTASIA" => $request->nombrefantasia,
            "ID_COMUNA" => $request->comuna,
            "CODIGO_POSTAL" => $request->codigopostal,
            "TELEFONO" => $request->telefono,
        ]);
    //$request->all() --- sirve para llamar todos los input dependiendo del nombre del form 
         
        $res = persona::find($request->rut)->usuario; // si no especifica se busca por "id"
        $res->ID_PERFIL = $request->tipocomprador;
        $res->save();

        try {
           
            // $nombre = $request->get('nombre_edit');
            // $apellido = $request->get('apellido_edit');
            // $rut = $request->get('rut_edit');
            // $tipocomprador = $request->get('tipocomprador_edit');
            // $tipopersona = $request->get('tipopersona_edit');
            // $nombrefantasia = $request->get('nombrefantasia_edit');
            // $comuna = $request->get('comuna_edit');
            // $codigopostal = $request->get('codigopostal_edit');
            // $telefono = $request->get('telefono_edit');
            
            // //$correo = $request->get('correo');
            // //$contrasenia = $request->get('contrasenia');

            // //$contrasenia = md5($request->get('contrasenia'));


            $ModificarUser = DB::select(
                'call SP_UPDATE_USUARIO(?,?,?,?,?,?,?,?,?)',
                array(
                    $request->nombre, $request->apellido, $request->rut, $request->tipocomprador,
                    $request->tipopersona, $request->nombrefantasia, $request->comuna, $request->codigopostal,
                    $request->telefono,   //$correo, $contrasenia
               )
             );
            
            //Log::info($ModificarUser[0]);
            
            session()->flash('type', 'success');
            session()->flash('message', 'Usuario modificado');
        } catch (\Exception $e){
            session()->flash('type', 'danger');
            //session()->flash('message', $e->getMessage());
            session()->flash('message', 'No se modifico el usuario');
            
        }
        //return redirect('index');
        return response()->json( $ModificarUser); 
        
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


