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
    public function catalogo()
    {
        #SE VERFICA SI SE HA CREADO UNA SESION
        if(!isset($_SESSION)){
            session_start();
        }
        #SE LLENAN ARREGLOS CON CRITERIOS DE FILTRO
        $tipos = DB::select('CALL SP_GET_TIPO_FRUTA()',array());
        $calidades = DB::select('CALL SP_GET_CALIDAD()',array());
        $tipoSelected = null;
        $calidadSelected = null;
        $found=false;
        $limiteSuperado=false;
        unset($_SESSION['status']);
        #SI NO EXISTE CANTIDAD TOTAL DEL CARRO ASIGNADA, SE ASIGNA
        if (!isset($_SESSION['totalCart'])) {
            $_SESSION['totalCart'] = 0;
        }
        #SI SE PRESIONA FILTAR
        if(isset($_POST['calidad'])){
            $calidadSelected = $_POST['calidad'];
        }
        if(isset($_POST['tipo'])){
            $tipoSelected = $_POST['tipo'];
        }
        #SE REALIZA ACCION SEGUN EL SUBMIT PRESIONADO
        if(isset($_POST['Limpiar'])){
            #SI SE PRESIONA LIMPIAR
            $tipoSelected = null;
            $calidadSelected = null;

        }
        #OPCION POR DEFECTO
        $query = 'select CONCAT(PU.NOMBRE,\' \',PU.APELLIDO)  NOMBRE_VENDEDOR,
            TF.NOMBRE   TIPO_FRUTA,
            C.NOMBRE  CALIDAD,
            HS.CANT_KG,
            TF.FOTO  FOTO,
            HS.PRECIO_X_KG  PRECIO,
            HS.ID_STOCK ID
            FROM HISTORICO_STOCK HS
            JOIN PERSONA PU ON PU.ID_USUARIO = HS.ID_PROVEEDOR
            JOIN CALIDAD C ON C.ID_CALIDAD = HS.ID_CALIDAD
            JOIN TIPO_FRUTA TF ON TF.ID_TIPO_FRUTA = HS.ID_TIPO_FRUTA
            WHERE HS.ID_STOCK IN (SELECT MAX(ID_STOCK) FROM HISTORICO_STOCK GROUP BY ID_PROVEEDOR,ID_TIPO_FRUTA)
            ORDER BY HS.ID_PROVEEDOR';
        if($tipoSelected!=null){
            $query = ($query).('AND TF.NOMBRE=\''.($tipoSelected).'\'');
        }
        if($calidadSelected!=null){
            $query = ($query).('AND C.NOMBRE=\''.($calidadSelected).'\'');
        }
        $ofertas = DB::select(DB::raw($query));
        foreach($ofertas as $oferta){
            $idOferta=($oferta->ID);
            if(isset($_POST['Añadir'.($idOferta)])){
                #SI SE PRESIONA AÑADIR
                $x=1;
                $found=false;
                if(isset($_SESSION['producto'])){
                    foreach($_SESSION['producto'] as $item){
                        if($item['id'] == $idOferta ){
                            $found=true;
                            break;
                        }else{
                            $x++;
                        }
                    };
                };

                if($found==true){
                    $cantidad = ($_POST['cantidad'.($idOferta)])+($_SESSION['producto'][$x]['cantidad']);
                    $_SESSION['producto'][$x]['cantidad'] = ($_POST['cantidad'.($idOferta)])+($_SESSION['producto'][$x]['cantidad']);
                }else{
                    $cantidad = $_POST['cantidad'.($idOferta)];
                }
                $_SESSION['producto'][$x]['id'] = $idOferta;
                $_SESSION['producto'][$x]['cantidad'] = $cantidad;
                if($_SESSION['producto'][$x]['cantidad'] > $oferta->CANT_KG){
                    $limiteSuperado=true;
                    unset($_SESSION['producto'][$x]);
                    if(count($_SESSION['producto'])<1){
                        unset($_SESSION['producto']);
                    }
                }
                $_SESSION['totalCart'] = count($_SESSION['producto']);
            }elseif(isset($_POST['Detalle'.($idOferta)])){
                #SI SE PRESIONA DETALLE
            }
        }
        if($limiteSuperado==true){
            $_SESSION['status']="No se puede seleccionar mas cantidad de la disponible, se ha quitado del carro";
        }
        return view('/catalogo', compact('ofertas','tipos','calidades','calidadSelected','tipoSelected','found'));
        
        
    }
    public function deleteCart($id)
    {
        if(!isset($_SESSION)){
            session_start();
        }
        foreach ($_SESSION['producto'] as $key=>$producto){
            if($id==$producto['id']){
                unset($_SESSION['producto'][$key]);
                if(count($_SESSION['producto'])<1){
                    unset($_SESSION['producto']);
                    $_SESSION['totalCart'] = 0;
                }else{
                    $_SESSION['totalCart'] = count($_SESSION['producto']);
                }
            break;
            }
        }
        
        return redirect()->action([pedidoController::class, 'carrito']);
    }
    public function comprar()
    {
        $json=null;
        $nCompra=null;
        if(!isset($_SESSION)){
            session_start();
        }
        if(!isset($_SESSION['usuario'])){
            return redirect()->route('login');
        }else{
            $json=json_encode($_SESSION['producto']);
            //ARMAR JSON CON EL ARREGLO, QUE CONTENGA LOS DATOS NECESARIOS PARA DETALLE PEDIDO
            DB::statement('CALL SP_CREATE_PEDIDO_NACIONAL(?,?,@res);',array($_SESSION['usuario'],$json));
            $_SESSION['nCompra'] = DB::select('SELECT @RES AS RES');
            if(is_array($_SESSION['nCompra']) || is_object($_SESSION['nCompra'])){
                $numero = null;
                foreach($_SESSION['nCompra'] as $n){
                    $numero = $n->RES;
                    break;
                }
                $_SESSION['nCompra']=$numero;
            }
            if($_SESSION['nCompra']!= null){
                unset($_SESSION['producto']);
                unset($_SESSION['totalCart']);
                return redirect()->action([pedidoController::class, 'compraExitosa']);
            }else{
                return redirect()->action([pedidoController::class, 'compraErronea']);
            }
        }
    }
    public function compraExitosa()
    {
        if(!isset($_SESSION)){
            session_start();
        }
        if(isset($_SESSION['nCompra'])){
            $nCompra = $_SESSION['nCompra'];
            unset($_SESSION['nCompra']);
            return view('compraExitosa',compact('nCompra'));
        }    
    }
    public function compraErronea()
    {
        if(!isset($_SESSION)){
            session_start();
        }
        if(isset($_SESSION['nCompra'])){
            unset($_SESSION['nCompra']);
            return view('compraErronea');
        }
    }
    public function carrito()
    {
        $items = null;
        $listadoId = null;
        $subtotal = 0;
        if(!isset($_SESSION)){
            session_start();
        }
        if(isset($_SESSION['producto'])){          
            foreach($_SESSION['producto'] as $row){
                if($listadoId == null){
                    $listadoId = ($row['id']);
                }else{
                    $listadoId = ($listadoId).','.($row['id']);
                }
            }
            $query ='select CONCAT(PU.NOMBRE,\' \',PU.APELLIDO)  NOMBRE,
            TF.NOMBRE   TIPO_FRUTA,
            C.NOMBRE  CALIDAD,
            HS.CANT_KG,
            TF.FOTO  FOTO,
            HS.PRECIO_X_KG  PRECIO,
            HS.ID_STOCK  ID
            FROM HISTORICO_STOCK HS
            JOIN PERSONA PU ON PU.ID_USUARIO = HS.ID_PROVEEDOR
            JOIN CALIDAD C ON C.ID_CALIDAD = HS.ID_CALIDAD
            JOIN TIPO_FRUTA TF ON TF.ID_TIPO_FRUTA = HS.ID_TIPO_FRUTA
            WHERE HS.ID_STOCK IN ('.($listadoId).')';
            $items =  DB::select(DB::raw($query));
            for($i=1;$i<=count($_SESSION['producto']);$i++){
                foreach($items as $item){
                    if($_SESSION['producto'][$i]['id']==$item->ID){
                        $subtotal = ($subtotal)+($_SESSION['producto'][$i]['cantidad'])*($item->PRECIO);
                    }
                }
            }
        }
        return view('/carrito',compact('items','subtotal'));
    }

    public function PublicarVenta(Request $request)
    {


        $id_vendedor = $request->get('id_vendedor');
        $id_tipo_fruta = $request->get('tipo_fruta');
        $calidad = $request->get('calidad');
        $cantidad = $request->get('cantidad');
        $precioxkg = $request->get('precioxkg');


        $PublicarVenta = DB::select(
            'call SP_CREAR_VENTA_INTERNA(?,?,?,?,?)',
            array(
                $id_vendedor, $id_tipo_fruta, $calidad, $cantidad,
                $precioxkg
            )
        );

        return back()->with('status', "Has publicado tu producto correctamente!");
    }


    public function CargarDatos()
    {
        $frutas = DB::select('CALL SP_GET_TIPO_FRUTA()');
        $calidades = DB::select('CALL SP_GET_CALIDAD()');

        return view('PublicarPedido', compact('frutas','calidades'));

    }

}

