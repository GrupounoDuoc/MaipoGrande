<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;


class transportistaController extends Controller
{

    public function enLogistica() //int $rol)
    {
        $VentasExt = DB::select('CALL SP_GET_VENTA_EXTERNA()', array());

        $VentasExt3 = DB::select('CALL SP_GET_VENTA_EXTERNA3()', array());

        $Estados = DB::select('CALL SP_GET_ESTADOS()', array());

        $datosdespacho = DB::select('CALL SP_GET_DESPACHOS()', array());
        
        if(!isset($_SESSION)){
            session_start();
        }

        if(!isset($_SESSION['usuario'])){
            return redirect()->route('/');
        }else{

            if($_SESSION['tipo_usuario'] != 5){
            return redirect()->route('/');
            }
        }

        return view('PedidosLogistica', compact('VentasExt', 'VentasExt3','Estados','datosdespacho'));
    }
    



    public function postularTransporte(Request $request){
        
        $VentasExt = DB::select('CALL SP_GET_VENTA_EXTERNA()');

        foreach($VentasExt as $venta){

            $id_pedido = $venta->ID_PEDIDO;

            if (isset($_POST['Postular'.($id_pedido)])){
               
                $detallePedido = DB::table('detalle_pedido')
                                    ->where('id_pedido', $id_pedido)
                                    ->get();

                if(!isset($_SESSION)){
                    session_start();
                }
        
                if(!isset($_SESSION['usuario'])){
                    return redirect()->route('/');
                }else{
        
                    $idTransportista = $_SESSION['id_usuario'];
                    }
                
                foreach($detallePedido as $detalle)
                {
                    echo $detalle->ID_DETALLE_PEDIDO;

                    $insertarPostulacion = DB::select(
                        'call SP_UPDATE_POSTULACIONES(?,?,?,?)',
                        array(
                            $detalle->ID_DETALLE_PEDIDO,
                            2,
                            $idTransportista,
                            8,
                       )
                     );
                }

                $Postulados = DB::select('CALL SP_GET_POSTULADO_TR()', array());

                foreach($Postulados as $Postulado){

                    $pedidoPost = $Postulado->ID_PEDIDO;
                }

            }

        }
        return back()->with('pedidoPost', $pedidoPost);

    }


}
