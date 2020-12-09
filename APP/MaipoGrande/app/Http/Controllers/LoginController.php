<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use DB;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        } 
        $datosLogin = DB::table('usuario')
                    ->where('CORREO',$request->get('emailUser'))
                    ->where('CONTRASENA',md5($request->get('clave')))
                    ->get(); //Trae un objeto con los datos de la tabla.
        if(count($datosLogin) > 0){
            foreach($datosLogin as $record){
                    if (isset($_SESSION['incorrecto'])) {
                        unset($_SESSION['incorrecto']);
                    }
                    $_SESSION['usuario'] = $record -> CORREO;
                    $_SESSION['tipo_usuario'] = $record -> ID_PERFIL;
                    $_SESSION['id_usuario'] = $record -> ID_USUARIO;
                    return view('index');
            }
        }else{
            $_SESSION['incorrecto'] = true;
            return redirect()->back();
        }
    }
    public function logout(){
        if(!isset($_SESSION)) 
        { 
            session_start();
            session_destroy();
        } 
        return redirect()->back();
    }
}
?>