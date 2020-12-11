@if (!isset($_SESSION))
{{ session_start() }}
@endif

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carrito de compras</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Condensed" rel="stylesheet">

    <!-- Foonts -->
    <link rel="stylesheet" href="iconos/style.css">
    <link rel="stylesheet" href="iconos/envio/style.css">
    <link rel="stylesheet" href="iconos/icon-cerrar/style.css">

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
        <nav>
            <ul id="lista-principal">
                @if (empty($_SESSION['usuario']))
                <li><a href="/">Inicio</a></li>
                <li><a href="login">Entrar</a></li>
                <li><a href="registro">Registrarse</a></li>
                <li><a href="contacto">Contacto</a></li>
                @else
                <li><a href="/">Inicio</a></li>
                <li><a href="contacto">Contacto</a></li>
                <li class="li-perfilUsuario">
                    <img src="imagenes/usuario.png" class="img-usuario" id="img-perfil">
                </li>

                @endif
            </ul>
            @if (isset($_SESSION['objetoNoEncontrado']))
            <h3 class="errorBusqueda" id="messageError"></h3>
            @endif
        </nav>
    </header>
    <div class="menu-lateralResponsive" id="menu-responsive">
        <nav class="nav-responsive">
            <ul>
                <li><a href="login.html">Entrar</a></li>
                <li><a href="registrarse.html">Registrarse</a></li>
                <li><a href="contacto.html">Contacto</a></li>
                <li><a href=""></a></li>
            </ul>
        </nav>
    </div>
    <!--Inicio del carrito de compras-->
    @if (isset($_SESSION['producto']) && (is_array($items) || is_object($items)))
    <table>
        <tr>
            <th>Vendedor</th>
            <th>Producto</th>
            <th>Imagen</th>
            <th>Precio</th>
            <th>Calidad</th>
            <th>Cantidad</th>
            <th>Eliminar</th>
        </tr>
        @foreach($items as $key=>$item)
        <tr>
            <td>
                <p>{{ $item->NOMBRE }}</p>
            </td>
            <td>
                <p>{{ $item->TIPO_FRUTA }}</p>
            </td>
            <td><img src="data:image/png;base64,{{ chunk_split(base64_encode($item->FOTO)) }}"></td>
            <td>
                <p> {{ $item->CALIDAD}}</p>
            </td>
            @for($i=1;$i<=count($_SESSION['producto']);$i++) @if($_SESSION['producto'][$i]['id']==$item->ID)
                <td>
                    <p>$ {{ ($item->PRECIO)*($_SESSION['producto'][$i]['cantidad']) }} CLP</p>
                </td>
                <td>
                    <p> {{ $_SESSION['producto'][$i]['cantidad']}} Kg</p>
                </td>
                @endif
                @endfor
                <td><button class="btn-delete"><a href="deleteCart/{{$item->ID}}"><img src="imagenes/basura.png"></a></button></td>
        </tr>
        @endforeach
        <tr>
            <td colspan="7">
                Subtotal : ${{$subtotal}}
            </td>
        </tr>
    </table>
    <div class="comya13">
        @if (empty($_SESSION['usuario']))
        <a href="comprar" id="btn-comprar">
            <h5>Logueate para finalizar la compra</h5>
        </a>
        @else
        <a href="login" id="btn-comprar">
            <h5>¡Compra ahora!</h5>
        </a>
        @endif
    </div>
    @else
    <h2>Sin productos en el carrito</h2>
    @endif
    <div class="continuarlin">
        <a href="catalogo">
            <h5>Continuar comprando</h5>
        </a>
    </div>
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
                        <h3>Información de envío <p class="precioTotal">Total a pagar: $ </p>
                        </h3>
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
    <footer style="position: absolute; width: 100%; bottom:0px; height: 130px;">

        <br>
        <div class="cont-footer" style="text-align: center; display:flex;">
            <div class="alineacion">
                <div class="copyright">
                    © 2020 Todos los derechos reservados | Diseñado por <a href="/"> Maipo Grande </a>
                </div>
            </div>

    </footer>

    <script src="js/buscar.js"></script>
    <script src="js/ventanaComprar.js"></script>
    <script src="js/aparecerIcono.js"></script>
</body>

</html>