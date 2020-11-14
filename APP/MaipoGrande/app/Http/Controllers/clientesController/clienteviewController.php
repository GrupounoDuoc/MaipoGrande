<?php

namespace App\Http\Controllers\clientesController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class clienteviewController extends Controller
{
    public function ViewPanelCliente()
    
    {

        //$queryclientes = DB::select('persona');


        return view('cliente');
    }
}
