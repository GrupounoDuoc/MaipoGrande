<?php

namespace App\Http\Controllers\productosController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class productoviewController extends Controller
{
    public function ViewPanelProducto()
    
    {
       return view('producto');
    }    

    public function IngresarProduct(Request $request)
    {
        $nombreFruta = $request->get('nombre');
        $descripcion = $request->get('descripcion');
        $imagen = $request->get('imagen');


        $IngresarProducto = DB::select(
            'call SP_CREATE_TIPO_FRUTA(?,?,?)',
            array($nombreFruta, $descripcion, $imagen)
        );
        //return response()->json();
        return back()->with('status', "Se ha creado la fruta {$nombreFruta} satisfactoriamente!");
    }
    
}
