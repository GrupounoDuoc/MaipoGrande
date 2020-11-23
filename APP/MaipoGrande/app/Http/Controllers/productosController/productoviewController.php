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
}
