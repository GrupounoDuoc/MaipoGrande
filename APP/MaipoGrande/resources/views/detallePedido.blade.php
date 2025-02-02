@if (!isset($_SESSION))
        {{ session_start() }}
@endif

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalle pedido N°{{$idPedido}}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Condensed" rel="stylesheet">

    <!-- Foonts -->
    <link rel="stylesheet" href="iconos/style.css">

    <!-- Slider -->
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.nivo.slider.js"></script>
    <link rel="stylesheet" type="text/css" href="css/nivo-slider.css">
    <link rel="stylesheet" type="text/css" href="css/mi-slider.css">
    <script type="text/javascript"> 
        $(window).on('load', function() {
            $('#slider').nivoSlider(); 
        }); 
    </script>

    <!--footer-->
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/bootstrap.css">

    <!-- Foonts -->
    <link href="https://fonts.googleapis.com/css?family=Gugi" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Heebo" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Condensed" rel="stylesheet">

    <!--carrito de compras-->
    <link rel="stylesheet" href="css/carrito.css">
    
</head>
<body>
    <header id="cabecera">
        <img src="imagenes/manzana.png" class="img-logo"> 
        <h1 class="logo">Maipo Grande</h1>
        <img src="imagenes/menu.png" class="icon-menu" id="boton-menu">
    
    <div class="container-fluid">
        <div class="list-group col col-md-4 pt-5 justify-content-center mx-auto">
            <h3 class="list-group-item list-group-item-action list-group-item-dark">
                Detalles Generales
            </h3>
            <h3 class="list-group-item list-group-item-action">Detalle pedido N°{{$idPedido}}</h3>
            <h3 class="list-group-item list-group-item-action">Comprador: {{ $comprador}}</h3>
            <h3 class="list-group-item list-group-item-action">Fecha de creacion: {{ $fechaCreacion}}</h3>
            <h3 class="list-group-item list-group-item-action" disabled>Estado: {{ucfirst(strtolower($estado))}}</h3>
        </div>
    </div>
    <hr class="pt-5">
    <!--Inicio del detalle de compra-->
    <form id="pedidoForm" action="/pedidos" method="POST">
    @CSRF
        <input type="hidden" value="{{$idPedido}}" name="idPedidoPostulacion" id="idPedidoPostulacion">
        @if ((is_array($detalles) || is_object($detalles)))
        <div class="table-responsive col col-md-8 justify-content-center mx-auto">

        
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        @if($_SESSION['tipo_usuario'] == 2 && $estado=='PUBLICADO')
                            <th>Seleccionar</th>
                        @endif
                        <th>Tipo fruta</th>
                        <th>Calidad requerida</th>
                        <th>Metodo de transporte requerido</th>
                        <th>Requiere refrigeracion</th>
                        <th>Cantidad requerida</th>
                        @if($_SESSION['tipo_usuario'] == 2 && ($estado=='PUBLICADO' || $estado=='POSTULADO'))
                            <th>Precio x kilo de aporte </th>
                            <th>Cantidad de aporte</th>
                        @endif
                    </tr>
                </thead>
                @foreach($detalles as $key=>$item)        
                    <tr>
                        @if($_SESSION['tipo_usuario'] == 2 && $estado=='PUBLICADO')
                            <td><input type="checkbox" name="seleccion{{$key}}" value="true"></td>
                        @endif
                        <td><p>{{ $item->TIPO_FRUTA }}</p></td>
                        <td><p> {{ $item->CALIDAD}}</p></td>
                        <td><p> {{ $item->METODO_VIAJE}}</p></td>
                        <td><p> {{ $item->REFRIGERADO}}</p></td>
                        <td><p> {{ $item->CANTIDAD}} Kg</p></td>
                        @if($_SESSION['tipo_usuario'] == 2 && $estado=='PUBLICADO')
                            <td>$<input type="number" step="1" class="form-control" id="precioPostulacion{{$key}}" name="precioPostulacion{{$key}}" value="1"  min="1"> CLP</td>
                            <td>
                                <input type="number" step="0.1" class="form-control" id="cantidadPostulacion{{$key}}" name="cantidadPostulacion{{$key}}" value="1"  min="1" max="{{ $item->CANTIDAD}}"> Kg
                                </td>
                        @elseif($_SESSION['tipo_usuario'] == 2 && $estado=='POSTULADO')
                            <td>${{$item->PRECIO_APORTADO}} CLP</td>
                            <td>{{ $item->KG_APORTADOS}} Kg</td>
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>
        @endif
        @if($_SESSION['tipo_usuario'] == 2 && $estado=='PUBLICADO')
            <div class="comya13">
                    <input type="hidden" name="postular" id="postular" value="true">
                    <a href="#" onclick="document.getElementById('pedidoForm').submit()" id="postular" name="postular"><h5>Postular a pedido</h5></a>
            </div>
        @endif
        @if($_SESSION['tipo_usuario'] == 4 && $estado=='ENTREGADO')
            <!-- Boton finalizar pedido para Modal de confirmacion -->
            <div class="comya13">
                <input type="hidden" name="finalizar{{$idPedido}}" id="finalizar{{$idPedido}}" value="true">
                <a data-toggle="modal" data-target="#confirmacionModal" href="#confirmacionModal" id="correcto"><h5>Finalizar pedido</h5></a>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="confirmacionModal" tabindex="-1" role="dialog" aria-labelledby="confirmacionModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmacionModalLabel">Confirmar recibo de despacho</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            En caso de aceptar el recibo del pedido, se renuncia a la posibilidad de devolucion. 
                            En caso de rechazo se coordinara con el transportista el retiro de los productos.
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" name="aceptarPedido" value="Aceptar pedido">
                            <input type="submit" class="btn btn-primary" name="rechazarPedido" value="Rechazar pedido">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="continuarlin">
                <a href="pedidos"><h5>Volver</h5></a>
        </div>   
        
        
    </form>         
    <!--fin del carrito de compras-->

    <!-- VENTANA EMERGENTE COMPRAR YA -->
        
    <div id="miModal" class="modal">
        <div class="flex" id="flex">
            <div class="contenido-modal">
                <div class="modal-header">
                    <span class="icon-cancel-circle" id="close-alert"></span>
                    <h2>INFORMACIÓN DE COMPRA</h2>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <h3>Información de envío  <p class="precioTotal">Total a pagar: $ </p></h3>
                        <br>
                        <label for="">Ciudad: </label>
                        <input type="text" name="ciudad-envio" placeholder="Destino del producto" class="campo" value="" required="">
                        <label for="" class="cod-postal">Código Postal:</label>
                        <input type="text" name="postal-envio" placeholder="Su código postal" class="campo" value="" required=""><br>
                        <label for="">Dirección de residencia: </label>
                        <input type="text" name="direccion-envio" placeholder="Ingrese su dirección" class="campo-addres" value="" required=""><br>
                        <br><br>
                        <p><span class="icon-airplane"></span><span class="tiempo">El envío llegará:</span><input type="text" name="fechaEntrega" readonly="readonly" value="" class="inputFecha"></p>

                        <div class="linea-separadora"></div>
                        <h3>Método de pago</h3>
                        <ul>
                            <li><input type="radio" name="metodo-pago" value="mastercard" checked=""><img src="imagenes/mastercard.png"></li>
                            <li><input type="radio" name="metodo-pago" value="paypal"><img src="imagenes/paypal.png"></li>
                            <li><input type="radio" name="metodo-pago" value="visa"><img src="imagenes/visa.png"></li>
                            <li><input type="radio" name="metodo-pago" value="bitcoin"><img src="imagenes/bitcoin.png"></li>
                            <li><input type="radio" name="metodo-pago" value="payment"><img src="imagenes/payment.png"></li>
                        </ul>
                        <input type="submit" value="COMPRAR">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN VENTANA EMERGENTE -->

<!--Footer-->
<footer>
        <div class="contenedor" >
            <br><div class="cont-footer" >
                <div class="alineacion">
                <div class="copyright" style="text-align: center;">
                    © 2020 Todos los derechos reservados | Diseñado por <a href="/"> Maipo Grande </a>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>