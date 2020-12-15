<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;


class transportistaController extends Controller
{

    public function enLogistica()
    {  
        #SE VERFICA SI SE HA CREADO UNA SESION
        if (!isset($_SESSION)) {
            session_start();
        }
        if(!isset($_SESSION['usuario'])){
            return redirect()->route('/');
        }else{
            if($_SESSION['tipo_usuario'] != 5){
                return redirect()->route('/');
            }
        }
        $Disponibles = DB::select('CALL SP_GET_VENTAS_EXTERNAS_TRANSPORTE(?)', array($_SESSION['usuario']));
        $Historicos = DB::select('CALL SP_GET_VENTAS_EXTERNAS_HISTORICO(?)', array($_SESSION['usuario']));        
        $Postulaciones = DB::select('CALL SP_GET_VENTAS_EXT_POSTULADAS_TR(?)', array($_SESSION['usuario']));
        return view('PedidosLogistica', compact('Disponibles','Historicos','Postulaciones'));
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
                    $insertarPostulacion = DB::select(
                        'CALL SP_CREATE_POSTULACION_TRANSPORTISTA(?,?,@res)',
                        array(
                            $detalle->ID_DETALLE_PEDIDO,
                            $idTransportista
                       )
                     );
                     break;
                }

                $Postulados = DB::select(DB::raw('SELECT @res res'));

                foreach($Postulados as $Postulado){

                    $pedidoPost = $Postulado->res;
                }
            }

        }
        return back()->with('pedidoPost', $pedidoPost);

    }


}
