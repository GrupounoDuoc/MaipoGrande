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
            WHERE HS.ID_STOCK IN (SELECT MAX(ID_STOCK) FROM HISTORICO_STOCK GROUP BY ID_PROVEEDOR,ID_TIPO_FRUTA)';
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
                        if($item['id'] == $idOferta){
                            $found=true;
                            break;
                        }else{
                            $x++;
                        }
                    };
                };

                if($found==true){
                    $subtotal = $_POST['precio'.($idOferta)];
                    $subtotal = $subtotal * number_format($_POST['cantidad'.($idOferta)]);
                    $_SESSION['producto'][$x]['id'] = $idOferta;
                    $_SESSION['producto'][$x]['cantidad'] = ($_POST['cantidad'.($idOferta)])+($_SESSION['producto'][$x]['cantidad']);
                    $_SESSION['producto'][$x]['calidad'] = $_POST['calidad_fruta'.($idOferta)];
                    $_SESSION['producto'][$x]['producto'] = ($subtotal)+($_SESSION['producto'][$x]['producto']);
                    $_SESSION['producto'][$x]['nombre'] = $_POST['nombre'.($idOferta)];
                    $_SESSION['producto'][$x]['foto'] = $_POST['foto'.($idOferta)];
                    $_SESSION['producto'][$x]['tipo'] = $_POST['tipo_fruta'.($idOferta)];
                }else{
                    $subtotal = $_POST['precio'.($idOferta)];
                    $subtotal = $subtotal * number_format($_POST['cantidad'.($idOferta)]);
                    $_SESSION['producto'][$x]['id'] = $idOferta;//$_POST['id'];
                    $_SESSION['producto'][$x]['cantidad'] = $_POST['cantidad'.($idOferta)];
                    $_SESSION['producto'][$x]['calidad'] = $_POST['calidad_fruta'.($idOferta)];
                    $_SESSION['producto'][$x]['producto'] = $subtotal;
                    $_SESSION['producto'][$x]['nombre'] = $_POST['nombre'.($idOferta)];
                    $_SESSION['producto'][$x]['foto']  = $_POST['foto'.($idOferta)];
                    $_SESSION['producto'][$x]['tipo'] = $_POST['tipo_fruta'.($idOferta)];
                    $_SESSION['totalCart'] = $x;
                }
                if($_SESSION['producto'][$x]['cantidad'] > $oferta->CANT_KG){
                    $limiteSuperado=true;
                    unset($_SESSION['producto'][$x]);
                    if(count($_SESSION['producto'])<1){
                        unset($_SESSION['producto']);
                    }
                    $_SESSION['totalCart'] = $_SESSION['totalCart']-1;
                }
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
        $i = 0;
        foreach ($_SESSION['producto'] as $producto){
            $i++;
            if($id==$producto[1]){
                unset($_SESSION['producto'][$i]);
                if(count($_SESSION['producto'])<1){
                    unset($_SESSION['producto']);
                }
                $i--;
            break;
            }
        }
        $_SESSION['totalCart'] = $i;
        return redirect()->action([pedidoController::class, 'carrito']);
    }
    public function comprar()
    {
        if(!isset($_SESSION)){
            session_start();
        }else{
            $idProductos=json_encode($_SESSION['producto']);
            //ARMAR JSON CON EL ARREGLO, QUE CONTENGA LOS DATOS NECESARIOS PARA DETALLE PEDIDO
            //DB::insert('INSERT INTO maipo_grande.pedido(ID_COMPRADOR,ID_TIPO_PEDIDO,ID_ESTADO_PEDIDO,FECHA_CREACION,FECHA_LIMITE_O_RETIRO,FECHA_PAGO)VALUES(?,?,?,?,?,?)',[$_SESSION['usuario'],1,3,date('Y/m/d H:i:s'),null,null]);
            $_SESSION['compraCorrecta']=true;
        }
        return redirect()->route('compraExitosa');
    }
    public function compraExitosa()
    {
        if(!isset($_SESSION)){
            session_start();
        }else{
            if($_SESSION['compraCorrecta']==true){
                unset($_SESSION['compraCorrecta']);
                return view('compraExitosa');
            }
        }
    }
    public function carrito()
    {
        $subtotal = 0;
        if(!isset($_SESSION)){
            session_start();
        }
        if(isset($_SESSION['producto'])){          
            foreach($_SESSION['producto'] as $item){
                $subtotal = ($subtotal) + ($item['producto']);
            }
        }
        return view('/carrito',compact('subtotal'));
    }
}
