<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;

class ReportesController extends Controller
{
    //

    public function CargarReporte() //int $rol)
    {
        $reportes = DB::select('CALL SP_GET_REPORTES()');
        return view('reportes', compact('reportes'));

        /* $comunas= comuna::select('NombreComuna','nombre')->get();
        return view('id_comuna',compact('comunas')); */
    }

    public function imprimir(Request $request)
    {
        $reportes = DB::select('CALL SP_GET_REPORTES()');
        view()->share('reportes',$reportes);
        if ($request->has('download')) {
            $pdf = \PDF::loadView('Reportes')->setPaper('a4', 'landscape');
            return $pdf->download('reporte.pdf');
        }
        return view('reportes', compact('reportes'));
    }
    

    
    
}


