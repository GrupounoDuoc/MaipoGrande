<?php

namespace App\Http\Controllers;

use DB;

use Illuminate\Http\Request;

use App\pedido;
use App\detalle_pedido;
use App\historico_stock;
use App\calidad;
use App\Http\Gestores\CollectionHelper;
use App\tipo_fruta;
use App\tipo_pedido;
use App\Mail\SendNotification;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Mail;

class pedidoController extends Controller
{
    public function catalogo()
    {
        #SE VERFICA SI SE HA CREADO UNA SESION
        if (!isset($_SESSION)) {
            session_start();
        }
        #SE LLENAN ARREGLOS CON CRITERIOS DE FILTRO
        $tipos = DB::select('CALL SP_GET_TIPO_FRUTA()', array());
        $calidades = DB::select('CALL SP_GET_CALIDAD()', array());
        $tipoSelected = null;
        $calidadSelected = null;
        $found = false;
        $limiteSuperado = false;
        unset($_SESSION['status']);
        #SI NO EXISTE CANTIDAD TOTAL DEL CARRO ASIGNADA, SE ASIGNA
        if (!isset($_SESSION['totalCart'])) {
            $_SESSION['totalCart'] = 0;
        }
        #SI SE PRESIONA FILTAR
        if (isset($_POST['calidad'])) {
            $calidadSelected = $_POST['calidad'];
        }
        if (isset($_POST['tipo'])) {
            $tipoSelected = $_POST['tipo'];
        }
        #SE REALIZA ACCION SEGUN EL SUBMIT PRESIONADO
        if (isset($_POST['Limpiar'])) {
            #SI SE PRESIONA LIMPIAR
            $tipoSelected = null;
            $calidadSelected = null;
        }
        #OPCION POR DEFECTO
        $query = 'SELECT CONCAT(PU.NOMBRE,\' \',PU.APELLIDO)  NOMBRE_VENDEDOR,
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
        if ($tipoSelected != null) {
            $query = ($query) . (' AND TF.NOMBRE=\'' . ($tipoSelected) . '\'');
        }
        if ($calidadSelected != null) {
            $query = ($query) . (' AND C.NOMBRE=\'' . ($calidadSelected) . '\'');
        }
        $ofertas = DB::select(DB::raw($query));
        foreach ($ofertas as $oferta) {
            $idOferta = ($oferta->ID);
            if (isset($_POST['Añadir' . ($idOferta)])) {
                #SI SE PRESIONA AÑADIR
                $x = 1;
                $found = false;
                if (isset($_SESSION['producto'])) {
                    foreach ($_SESSION['producto'] as $item) {
                        if ($item['id'] == $idOferta) {
                            $found = true;
                            break;
                        } else {
                            $x++;
                        }
                    };
                };

                if ($found == true) {
                    $cantidad = ($_POST['cantidad' . ($idOferta)]) + ($_SESSION['producto'][$x]['cantidad']);
                    $_SESSION['producto'][$x]['cantidad'] = ($_POST['cantidad' . ($idOferta)]) + ($_SESSION['producto'][$x]['cantidad']);
                } else {
                    $cantidad = $_POST['cantidad' . ($idOferta)];
                }
                $_SESSION['producto'][$x]['id'] = $idOferta;
                $_SESSION['producto'][$x]['cantidad'] = $cantidad;
                if ($_SESSION['producto'][$x]['cantidad'] > $oferta->CANT_KG) {
                    $limiteSuperado = true;
                    unset($_SESSION['producto'][$x]);
                    if (count($_SESSION['producto']) < 1) {
                        unset($_SESSION['producto']);
                    }
                }
                $_SESSION['totalCart'] = count($_SESSION['producto']);
            }
        }
        $ofertas = collect($ofertas);
        $ofertas = CollectionHelper::paginate($ofertas, 4);

        if ($limiteSuperado == true) {
            $_SESSION['status'] = "No se puede seleccionar mas cantidad de la disponible, se ha quitado del carro";
        }

        return view('/catalogo', compact('ofertas', 'tipos', 'calidades', 'calidadSelected', 'tipoSelected', 'found'));
    }
    public function pedidos()
    {
        #SE VERFICA SI SE HA CREADO UNA SESION
        if (!isset($_SESSION)) {
            session_start();
        }
        if(!isset($_SESSION['usuario'])){
            return redirect()->route('/');
        }else{
            if($_SESSION['tipo_usuario'] != 4 && $_SESSION['tipo_usuario'] !=2){
                return redirect()->route('/');
            }
        }
        #SI SE DESEA CREAR NUEVO PREDIDO SE REDIRIJE A LA PAGINA DE CREACION
        if(isset($_POST['crearPedido'])){
            return redirect()->route('PublicarPedidoExt');
        }
        #SE LLENAN ARREGLOS CON CRITERIOS DE FILTRO
        if($_SESSION['tipo_usuario'] == 4){
            $estados = DB::table('estados')
                            ->whereIn('NOMBRE',['POR APROBAR','PUBLICADO','EN LOGISTICA','DESPACHO','RECHAZADO','PAGADO','ENTREGADO'])
                            ->get(); //Trae un objeto con los datos de la tabla.
        }elseif($_SESSION['tipo_usuario'] == 2){
            $estados = DB::table('estados')
                            ->whereIn('NOMBRE',['PUBLICADO','PAGADO','POSTULADO','RECHAZADO'])
                            ->get(); //Trae un objeto con los datos de la tabla.
        }
        $fechaInicioSelected=null;
        $fechaFinSelected=null;
        $estadoFiltroSelected=null;
        $found=false;
        $limiteSuperado=false;
        $idPedido=null;
        #SI SE PRESIONA FILTAR
        if (isset($_POST['fechaInicio'])) {
            $fechaInicioSelected = $_POST['fechaInicio'];
        }
        if (isset($_POST['fechaFin'])) {
            $fechaFinSelected = $_POST['fechaFin'];
        }
        if (isset($_POST['estado'])) {
            $estadoFiltroSelected = $_POST['estado'];
        }
        #SE REALIZA ACCION SEGUN EL SUBMIT PRESIONADO
        if (isset($_POST['Limpiar'])) {
            #SI SE PRESIONA LIMPIAR
            $fechaInicioSelected = null;
            $fechaFinSelected = null;
            $estadoFiltroSelected = null;
        }
        if (isset($_POST['aceptarPedido']) || isset($_POST['rechazarPedido'])) {
            $idPedido = $_POST['idPedidoPostulacion'];
            $estado = null;
            if (isset($_POST['aceptarPedido'])) {
                $accion = 'PAGADO';
            } elseif (isset($_POST['rechazarPedido'])) {
                $accion = 'RECHAZADO';
            }
            DB::statement(
                'CALL SP_UPDATE_FINALIZAR_PEDIDO(?,?,@RES);',
                array(
                    $idPedido,
                    $accion
                )
            );
            $resultado = DB::select('SELECT @RES AS RES');
            if (is_array($resultado) || is_object($resultado)) {
                foreach ($resultado as $n) {
                    $estado = $n->RES;
                    break;
                }
            }
            #RETORNAR TERMINO DE PEDIDO
            return view('/pedidoFinalizado', compact('idPedido', 'estado'));
        }
        #OPCION POR DEFECTO
        if($_SESSION['tipo_usuario'] == 4){
            $query = 'select  P.ID_PEDIDO ID,
            CONCAT(PC.NOMBRE,\' \',PC.APELLIDO)  NOMBRE_COMPRADOR,
            FECHA_CREACION FECHA,
            E.NOMBRE ESTADO
            FROM PEDIDO P
            JOIN PERSONA PC ON PC.ID_USUARIO = P.ID_COMPRADOR
            JOIN ESTADOS E ON E.ID_ESTADO = P.ID_ESTADO_PEDIDO
            JOIN USUARIO U ON U.ID_USUARIO = P.ID_COMPRADOR
            WHERE ID_TIPO_PEDIDO = 2';
        }elseif($_SESSION['tipo_usuario'] == 2){
            $query = 'SELECT DISTINCT  P.ID_PEDIDO ID,
            CONCAT(PC.NOMBRE,\' \',PC.APELLIDO)  NOMBRE_COMPRADOR,
            FECHA_CREACION FECHA,
            (CASE
				WHEN PS.ESTADO IS NULL THEN
					E.NOMBRE
				ELSE
                    \'POSTULADO\'
			END) ESTADO
            FROM PEDIDO P
            JOIN PERSONA PC ON PC.ID_USUARIO = P.ID_COMPRADOR
            JOIN ESTADOS E ON E.ID_ESTADO = P.ID_ESTADO_PEDIDO
            JOIN USUARIO U ON U.ID_USUARIO = P.ID_COMPRADOR
            LEFT JOIN (SELECT DP.ID_PEDIDO,E.NOMBRE ESTADO,U.CORREO
						FROM POSTULACION P
						JOIN DETALLE_PEDIDO DP ON DP.ID_DETALLE_PEDIDO = P.ID_DETALLE_PEDIDO
						JOIN ESTADOS E ON E.ID_ESTADO = P.ID_ESTADO
						JOIN USUARIO U ON U.ID_USUARIO = P.ID_USUARIO
						WHERE U.CORREO = \''.($_SESSION['usuario']).'\') PS ON PS.ID_PEDIDO = P.ID_PEDIDO
                        WHERE ID_TIPO_PEDIDO = 2 ';
        }
        if($estadoFiltroSelected!=null){
            if($_SESSION['tipo_usuario'] == 2){
                $query = ($query).(' AND (CASE
                                            WHEN PS.ESTADO IS NULL THEN
                                                E.NOMBRE
                                            ELSE
                                                \'POSTULADO\'
                                            END) = \''.($estadoFiltroSelected).'\'');
            }else{
                $query = ($query).(' AND E.NOMBRE = \''.($estadoFiltroSelected).'\'');
            }
        }
        elseif($_SESSION['tipo_usuario'] == 2){
            $query = ($query).('AND E.NOMBRE IN (\'PUBLICADO\',\'RECHAZADO\',\'PAGADO\',\'POSTULADO\',\'APROBADA\',\'RECHAZADA\')');
        }
        if ($fechaInicioSelected != null && $fechaFinSelected != null) {
            $query = ($query) . (' AND P.FECHA_CREACION BETWEEN \'' . ($fechaInicioSelected) . '\' AND \'' . ($fechaFinSelected) . '\'');
        } elseif ($fechaInicioSelected != null) {
            $query = ($query) . (' AND P.FECHA_CREACION=\'' . ($fechaInicioSelected) . '\'');
        } elseif ($fechaFinSelected != null) {
            $query = ($query) . (' AND P.FECHA_CREACION=\'' . ($fechaFinSelected) . '\'');
        }
        //return $query;
        $pedidos = DB::select(DB::raw($query));
        foreach ($pedidos as $pedido) {
            $idPedido = $pedido->ID;
            $comprador = $pedido->NOMBRE_COMPRADOR;
            $fechaCreacion = $pedido->FECHA;
            if (isset($_POST['idPedidoPostulacion'])) {
                $idPedido = $_POST['idPedidoPostulacion'];
            } elseif (isset($_POST['detalle' . ($idPedido)]) || isset($_POST['finalizar' . ($idPedido)])) {
                $estado = $pedido->ESTADO;
                break;
            } elseif (isset($_POST['seguimiento' . ($idPedido)])) {
                return redirect('seguimiento')->with('idPedido', $idPedido);
            }
        }
        if (isset($_POST['detalle' . ($idPedido)]) || isset($_POST['postular']) || isset($_POST['finalizar' . ($idPedido)])) {
            $query = 'SELECT
                    C.NOMBRE CALIDAD,
                    TF.NOMBRE TIPO_FRUTA,
                    DP.CANT_KG CANTIDAD,
                    REPLACE(REPLACE(REPLACE(DP.METODO_VIAJE,\'ear\',\'Terrestre\'),\'sea\',\'Maritimo\'),\'air\',\'Aereo\') METODO_VIAJE,
                    REPLACE(REPLACE(DP.REFRIGERADO,1,\'Si\'),0,\'No\') REFRIGERADO,
                    DP.PRECIO_KG PRECIO,
                    DP.COD_MONEDA MONEDA,
                    DP.ID_DETALLE_PEDIDO
                    FROM DETALLE_PEDIDO DP
                    JOIN CALIDAD C ON C.ID_CALIDAD = DP.ID_CALIDAD
                    JOIN TIPO_FRUTA TF ON TF.ID_TIPO_FRUTA = DP.ID_TIPO_FRUTA
                    WHERE DP.ID_PEDIDO = ' . ($idPedido);
            $detalles = DB::select(DB::raw($query));
        }
        if (isset($_POST['detalle' . ($idPedido)])){
            #SI SE PRESIONA DETALLE
            return view('/detallePedido', compact('detalles', 'idPedido', 'comprador', 'fechaCreacion', 'estado'));
        } elseif (isset($_POST['postular'])) {
            #SI SE PRESIONA POSTULAR
            $postulacion = null;
            $numero = null;
            $idPedidoPostulacion = $_POST['idPedidoPostulacion'];
            foreach ($detalles as $key => $detalle) {
                if (isset($_POST['seleccion' . ($key)])) {
                    DB::statement(
                        'CALL SP_CREATE_POSTULACION_VENDEDOR(?,?,?,?,?,?,@RES);',
                        array(
                            $detalle->ID_DETALLE_PEDIDO,
                            $_SESSION['usuario'],
                            $detalle->TIPO_FRUTA,
                            $detalle->CALIDAD,
                            $_POST['cantidadPostulacion' . ($key)],
                            $_POST['precioPostulacion' . ($key)]
                        )
                    );
                    $postulacion = DB::select('SELECT @RES AS RES');
                    if (is_array($postulacion) || is_object($postulacion)) {
                        foreach ($postulacion as $n) {
                            if ($numero == null) {
                                $numero = $n->RES;
                            } else {
                                $numero = ($numero) . (',') . ($n->RES);
                            }

                            break;
                        }
                    }
                }
            }
            $postulacion = $numero;
            return view('/postulacionCompleta', compact('postulacion', 'idPedidoPostulacion'));
        }
        return view('/pedidos', compact('pedidos', 'estados', 'fechaInicioSelected', 'fechaFinSelected', 'estadoFiltroSelected'));
    }
    public function deleteCart($id)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        foreach ($_SESSION['producto'] as $key => $producto) {
            if ($id == $producto['id']) {
                unset($_SESSION['producto'][$key]);
                if (count($_SESSION['producto']) < 1) {
                    unset($_SESSION['producto']);
                    $_SESSION['totalCart'] = 0;
                } else {
                    $_SESSION['totalCart'] = count($_SESSION['producto']);
                }
                break;
            }
        }

        return redirect()->action([pedidoController::class, 'carrito']);
    }
    public function comprar()
    {
        $json = null;
        $nCompra = null;
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION['usuario'])) {
            return redirect()->route('login');
        } else {
            $json = json_encode($_SESSION['producto']);
            //ARMAR JSON CON EL ARREGLO, QUE CONTENGA LOS DATOS NECESARIOS PARA DETALLE PEDIDO
            DB::statement('CALL SP_CREATE_PEDIDO_NACIONAL(?,?,@res);', array($_SESSION['usuario'], $json));
            $_SESSION['nCompra'] = DB::select('SELECT @RES AS RES');
            if (is_array($_SESSION['nCompra']) || is_object($_SESSION['nCompra'])) {
                $numero = null;
                foreach ($_SESSION['nCompra'] as $n) {
                    $numero = $n->RES;
                    break;
                }
                $_SESSION['nCompra'] = $numero;
            }
            if ($_SESSION['nCompra'] != null) {
                unset($_SESSION['producto']);
                unset($_SESSION['totalCart']);
                return redirect()->action([pedidoController::class, 'compraExitosa']);
            } else {
                return redirect()->action([pedidoController::class, 'compraErronea']);
            }
        }
    }
    public function compraExitosa()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['nCompra'])) {
            $nCompra = $_SESSION['nCompra'];
            unset($_SESSION['nCompra']);
            return view('compraExitosa', compact('nCompra'));
        }
    }
    public function compraErronea()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['nCompra'])) {
            $nCompra = $_SESSION['nCompra'];
            unset($_SESSION['nCompra']);
            return view('compraErronea',compact('nCompra'));
        }
    }
    public function carrito()
    {
        $items = null;
        $listadoId = null;
        $subtotal = 0;
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['producto'])) {
            foreach ($_SESSION['producto'] as $row) {
                if ($listadoId == null) {
                    $listadoId = ($row['id']);
                } else {
                    $listadoId = ($listadoId) . ',' . ($row['id']);
                }
            }
            $query = 'select CONCAT(PU.NOMBRE,\' \',PU.APELLIDO)  NOMBRE,
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
            WHERE HS.ID_STOCK IN (' . ($listadoId) . ')';
            $items =  DB::select(DB::raw($query));
            for ($i = 1; $i <= count($_SESSION['producto']); $i++) {
                foreach ($items as $item) {
                    if ($_SESSION['producto'][$i]['id'] == $item->ID) {
                        $subtotal = ($subtotal) + ($_SESSION['producto'][$i]['cantidad']) * ($item->PRECIO);
                    }
                }
            }
        }
        return view('/carrito', compact('items', 'subtotal'));
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

        return view('PublicarPedido', compact('frutas', 'calidades'));
    }
    public function pedidoExterno()
    {
        if(!isset($_SESSION)){
            session_start();
        }
        if(!isset($_SESSION['usuario'])){
            return redirect()->route('/');
        }else{
            if($_SESSION['tipo_usuario'] != 4){
                return redirect()->route('/');
            }
        }
        if(isset($_POST['volver'])){
            if(isset($_SESSION['pedidoExt'])){
                unset($_SESSION['pedidoExt']);
            }
            return redirect()->route('pedidos');
        }        
        $frutas = DB::select('CALL SP_GET_TIPO_FRUTA()');
        $calidades = DB::select('CALL SP_GET_CALIDAD()');
        $metodoViajeSelected = null;
        if(isset($_POST['metodo_viaje'])){
            $metodoViajeSelected = $_POST['metodo_viaje'];
        }
        if(isset($_POST['add']) || isset($_POST['publicar'])){
            if(isset($_SESSION['pedidoExt'])){
                foreach($_SESSION['pedidoExt'] as $key=>$row){
                    $_SESSION['pedidoExt'][$key]['tipo_fruta'] = $_POST['tipo_fruta'.($key)];
                    $_SESSION['pedidoExt'][$key]['calidad'] = $_POST['calidad'.($key)];
                    $_SESSION['pedidoExt'][$key]['cantidad'] = $_POST['cantidad'.($key)];
                    $_SESSION['pedidoExt'][$key]['refrigerado'] = $_POST['refrigerado'.($key)];
                    $_SESSION['pedidoExt'][$key]['metodo_viaje'] = $metodoViajeSelected;
                }
                $next = count($_SESSION['pedidoExt'])+1;
            }else{
                $next = 1;
            }
            if(isset($_POST['tipo_fruta']) && isset($_POST['calidad']) && isset($_POST['cantidad']) && isset($_POST['refrigerado']) && isset($_POST['metodo_viaje'])){
                if($_POST['tipo_fruta'] != null && $_POST['calidad'] != null && $_POST['cantidad'] != null && $_POST['refrigerado'] != null && isset($_POST['metodo_viaje'])){
                    $_SESSION['pedidoExt'][$next]['tipo_fruta'] = $_POST['tipo_fruta'];
                    $_SESSION['pedidoExt'][$next]['calidad'] = $_POST['calidad'];
                    $_SESSION['pedidoExt'][$next]['cantidad'] = $_POST['cantidad'];
                    $_SESSION['pedidoExt'][$next]['refrigerado'] = $_POST['refrigerado'];
                    $_SESSION['pedidoExt'][$next]['metodo_viaje'] = $metodoViajeSelected;
                }
            }                    
        }elseif(isset($_POST['limpiar'])){
            if(isset($_SESSION['pedidoExt'])){
                unset($_SESSION['pedidoExt']);
            }
        }else{
            if(isset($_SESSION['pedidoExt'])){
                unset($_SESSION['pedidoExt']);
            }
        }
        if(isset($_POST['publicar'])){
            if(!isset($_SESSION['pedidoExt'])){
                return back()->with('error', "No se agregaron productos para el nuevo pedido");
            }
            $json = null;
            $numero = null;
            $json = json_encode($_SESSION['pedidoExt']);
            //ARMAR JSON CON EL ARREGLO, QUE CONTENGA LOS DATOS NECESARIOS PARA DETALLE PEDIDO
            DB::statement('CALL SP_CREATE_PEDIDO_EXTRANJERO(?,?,@res);', array($_SESSION['usuario'], $json));
            $_SESSION['nCompra'] = DB::select('SELECT @RES AS RES');
            if (is_array($_SESSION['nCompra']) || is_object($_SESSION['nCompra'])) {
                
                foreach ($_SESSION['nCompra'] as $n) {
                    $numero = $n->RES;
                    break;
                }
            }
            if ($numero == null) {
                if(isset($_SESSION['pedidoExt'])){
                    unset($_SESSION['pedidoExt']);
                }
                return back()->with('error', "Error al publicar tu pedido");
            } else {
                return back()->with('success', "Se ha enviado la solicitud de publicacion para el pedido N°".($numero));
            }
        }
        return view('PublicarPedidoExt', compact('frutas', 'calidades','metodoViajeSelected'));
    }
    public function CargarVentasExternas()
    {
        $VentasExt = DB::select('CALL SP_GET_VENTA_EXTERNA()');
        $Estados = DB::select('CALL SP_GET_ESTADOS()');
        return view('VentasExternas', compact('VentasExt', 'Estados'));
    }
    public function ActualizarEstado(Request $request)
    {
        $VentasExt = DB::select('CALL SP_GET_VENTA_EXTERNA()');

        foreach ($VentasExt as $ventas) {
            $id_pedido = $ventas->ID_PEDIDO;
            $nuevo_estado = $request->get('nuevo_estado' . ($id_pedido));
            $correo = $request->get('correo' . ($id_pedido));
            if (isset($_POST['Actualizar' . ($id_pedido)])) {
                break;
            }
        }

        $ActualizarEstado = DB::select(
            'call SP_UPDATE_ESTADO_PEDIDO(?,?)',
            array(
                $id_pedido, $nuevo_estado
            )
        );
        if ($nuevo_estado == 2) {
            Mail::to($correo)->send(new SendNotification());
        }
        elseif($nuevo_estado == 3){
            DB::statement('CALL SP_FINALIZACION_POSTULACION_VENDEDOR(?,@res);', array($id_pedido));
        }

        return back()->with('status', "Se ha actualizado el pedido con id {$id_pedido} satisfactoriamente!");
    }
}
