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
        if (!isset($_SESSION)) {
            session_start();
        }
        if(!isset($_SESSION['usuario'])){
            return redirect()->route('/');
        }else{
            if($_SESSION['tipo_usuario'] != 4 || session('idPedido')== null){
                return redirect()->route('pedidos');
            }
        }
        $idPedido =session('idPedido');
        $idDespacho = null;
        $query = 'SELECT
        D.ID_DESPACHO ID,
        CONCAT(P.NOMBRE,\' \',P.APELLIDO) NOMBRE_TRANSPORTISTA,
        E.NOMBRE ESTADO,
        FECHA_DESPACHO,
        FECHA_RECIBIDO
        FROM DESPACHO D
        JOIN PERSONA P ON P.ID_USUARIO = D.ID_TRANSPORTISTA
        JOIN ESTADOS E ON E.ID_ESTADO = D.ID_ESTADO_DESPACHO
        WHERE ID_PEDIDO ='.($idPedido);
        $despacho = DB::select(DB::raw($query));
        $historial = null;
        foreach($despacho as $row){
            $idDespacho = $row->ID;
            break;
        }
        if($idDespacho != null){
            $query = 'SELECT
            FECHA_ACTUALIZACION,
            E.NOMBRE ESTADO,
            DD.DESCRIPCION
            FROM DETALLE_DESPACHO DD
            JOIN ESTADOS E ON E.ID_ESTADO = DD.ID_TIPO_ACTUALIZACION
            WHERE ID_DESPACHO = '.($idDespacho);
            $historial = DB::select(DB::raw($query));
        }
        return view('/seguimiento',compact('despacho','historial','idPedido'));
    }
}
 