<?php


namespace App\Http\Controllers\adminController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class adminviewController extends Controller
{
     public function ViewPanelAdmin()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if(!isset($_SESSION['usuario'])){
            return redirect()->route('/');
        }else{
            if($_SESSION['tipo_usuario'] != 1){
                return redirect()->route('/');
            }
        }
        return view('admin');
    }
}
