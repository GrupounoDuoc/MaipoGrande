<?php

namespace App\Http\Controllers\productosController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\tipo_fruta;

class productoviewController extends Controller
{
    public function ViewPanelProducto(Request $request)
    
    {
        $frutas = DB::select('CALL SP_GET_TIPO_FRUTA()', array());

      
       return view('/producto',compact('frutas'));
    }    

    public function CrearProduct(Request $request)
    {
        try{
            $nombreFruta = $request->get('nombreFruta');
            $descripcion = $request->get('descripcion');
            $imagen = $request->get('imagen');


            $IngresarProducto = DB::select(
                'call SP_CREATE_TIPO_FRUTA(?,?,?)',
                array($nombreFruta, $descripcion, $imagen)
            );

        session()->flash('type', 'success');
        session()->flash('message', 'Producto creado con exito!');

    } catch (\Exception $e){
        session()->flash('type', 'danger');
        session()->flash('message', 'No se creo el producto!');
    }
        return response()->json( $IngresarProducto);
        //return back()->with('status', "Se ha creado la fruta {$nombreFruta} satisfactoriamente!");
    }

    
    public function destroyProducto($id)
    {
        DB::select('call SP_DELETE_TIPO_FRUTA(?)', [$id]);

        session()->flash('type', 'success');
        session()->flash('message', 'Fruta eliminada con exito!');

        return redirect('producto');

        //return back()->with('status', "Se ha eliminado la fruta con ID {$id} satisfactoriamente!");
    }

    public function CargarDatosProducto(Request $request)
    {
        $frutas = DB::select('CALL SP_GET_TIPO_FRUTA()', array());

        return view('/ModificarProducto', compact('frutas'));
    }

    public function ModificarProducto(Request $request)
    {

        $id_tipo_fruta = $request->get('itf');
        $tipo_fruta = $request->get('nombreFruta');
        $descripcion = $request->get('descripcion');
        $imagen = $request->get('imagen');



        $ModificarProducto = DB::select(
            'call SP_UPDATE_TIPO_FRUTA(?,?,?,?)',
            array(
                $id_tipo_fruta, $tipo_fruta, $descripcion, $imagen 
            )
        );

        return back()->with('status', "Se ha modificado la fruta con id {$id_tipo_fruta} y nombre {$tipo_fruta} satisfactoriamente!");
    }

    public function listarProducto(Request $request)
    {
        $frutas = DB::select('CALL SP_GET_TIPO_FRUTA()', array());

        return view('/producto', compact('frutas'));
    }

    
}
