<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\pedido;
use App\detalle_pedido;
use App\historico_stock;
use App\calidad;
use App\tipo_fruta;
use App\tipo_pedido;

class pedidoController extends Controller
{
    public function catalogo(Request $request)
    {
        $tipos = DB::select('CALL SP_GET_TIPO_FRUTA()',array());
        $calidades = DB::select('CALL SP_GET_CALIDAD()',array());
        $calidadSelected = $request->get('calidad');
        $tipoSelected = $request->get('tipo');
        $ofertas = DB::select('CALL SP_GET_CATALOGO()',array());
        if($tipoSelected!=null){
            $filtro = collect($ofertas)->filter(function ($value, $key) use($tipoSelected){
                return data_get($value, 'TIPO_FRUTA') == $tipoSelected;
            });
            $ofertas = $filtro->all();
        }
        if($calidadSelected!=null){
            $filtro = collect($ofertas)->filter(function ($value, $key) use($calidadSelected){
                return data_get($value, 'CALIDAD') == $calidadSelected;
            });
            $ofertas = $filtro->all();
        }
        return view('/catalogo', compact('ofertas','tipos','calidades','calidadSelected','tipoSelected'));
    }
}
