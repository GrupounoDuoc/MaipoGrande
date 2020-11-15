<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use DB;


class LoginController extends Controller
{
    

    public function loguear(Request $request)
    {
        $logmail = $request->get('emailUser');
        $logclave = $request->get('clave');

        $datosLogin = DB::table('usuario')->get(); //Trae un objeto con los datos de la tabla.
 
        $arrayes = json_decode(json_encode($datosLogin), true); //Convierte a array los datos de la tabla de la BD

        $mailes = array_column($arrayes, 'CORREO'); //Trae arreglo de todos los mails
        
        $contras = array_column($arrayes, 'CONTRASENA'); //Trae arreglo de todas las contraseñas
        $perfiles = array_column($arrayes, 'ID_PERFIL'); //Trae arreglo de todos los id de perfiles

        $j = 0;
        for($i=0; $i<count($mailes); $i++){

            if ($mailes[$i] == $logmail){

                if($contras[$i] == $logclave){

                    session_start();
                    $_SESSION['usuario'] = $logmail;
                    $varSesion = $_SESSION['usuario'];

                    return view('vistaprueba', compact('varSesion'));

                    //echo 'ERES USUARIO';
                }else{
                    echo 'TU CONTRASEÑA NO ES CORRECTA';
                }
            }else{
                $j = ++$j;
            }
        }

        $cuenta = count($mailes);
        if($j == $cuenta){
            //echo 'NO ESTÁS REGISTRADO';
            return view('login');
        }

    }



    public function logout(Request $request){
        session_start();
        session_destroy();
        return view('index');

    }










}
