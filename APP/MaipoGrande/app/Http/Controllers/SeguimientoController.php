<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use DB;

class SeguimientoController extends Controller
{
    //
    public function seguimiento()
    {
        $idPedido =session('idPedido');
        $idDespacho = null;
        $query = 'SELECT
        D.ID_DESPACHO ID,
        CONCAT(P.NOMBRE,\' \',P.APELLIDO) NOMBRE_TRANSPORTISTA,
        TT.NOMBRE TIPO_TRANSPORTE,
        E.NOMBRE ESTADO,
        FECHA_DESPACHO,
        FECHA_RECIBIDO
        FROM DESPACHO D
        JOIN PERSONA P ON P.ID_USUARIO = D.ID_TRANSPORTISTA
        JOIN TIPO_TRANSPORTE TT ON TT.ID_TIPO_TRANSPORTE = D.ID_TIPO_TRANSPORTE
        JOIN ESTADOS E ON E.ID_ESTADO = D.ID_ESTADO_DESPACHO
        WHERE ID_PEDIDO ='.($idPedido);
        $despacho = DB::select(DB::raw($query));
        foreach($despacho as $row){
            $idDespacho = $row->ID;
            break;
        }
        $query = 'SELECT
        FECHA_ACTUALIZACION,
        E.NOMBRE ESTADO,
        DD.DESCRIPCION
        FROM DETALLE_DESPACHO DD
        JOIN ESTADOS E ON E.ID_ESTADO = DD.ID_TIPO_ACTUALIZACION
        WHERE ID_DESPACHO = '.($idDespacho);
        $historial = DB::select(DB::raw($query));
        return view('/seguimiento',compact('despacho','historial','idPedido'));
    }
}
 