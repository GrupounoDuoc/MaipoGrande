<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\pedido;
use App\detalle_pedido;
use App\historico_stock;
use App\calidad;
use App\tipo_fruta;
use App\tipo_pedido;

class pedidoController extends Controller
{
    public function catalogo()
    {
        $tipos = DB::select('CALL SP_GET_TIPO_FRUTA()',array());
        $ofertas = DB::select('CALL SP_GET_CATALOGO()',array());
        $calidades = DB::select('CALL SP_GET_CALIDAD()',array());
        return view('/catalogo', compact('ofertas','tipos'));
    }
}
