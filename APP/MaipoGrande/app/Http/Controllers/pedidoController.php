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
    public function catalogo()//int $rol)
    {
        $rol = 2;
        $ofertas = DB::select('CALL SP_GET_CATALOGO(?)',array($rol));
        return view('catalogo', compact('ofertas'));
    }
}
