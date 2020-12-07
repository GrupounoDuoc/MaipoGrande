<!--V5 Laravel -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Seguimiento pedido N°{{$idPedido}}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/testimonios.css">
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Condensed" rel="stylesheet">
    <script src="https://kit.fontawesome.com/5dd90ee603.js" crossorigin="anonymous"></script>
    <!-- Testimonios -->

    <link rel="stylesheet" href="testimonios/sss/sss.css">
    <link rel="stylesheet" href="testimonios/estilos.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="testimonios/sss/sss.js"></script>
    <script>
        //mostrar testimonios rapidos y en cuadros chicos y rapidos 
        jQuery(function($) {
            $('.slider-testimonial').sss({
                slideShow: true,
                speed: 5500
            });
        });
    </script>



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

    <!-- PWA -->
    @laravelPWA

    @if(!isset($_SESSION))
    {{ session_start() }}
    @endif
</head>

<body>
    <header id="cabecera">

        <img src="imagenes/manzana.png" class="img-logo">
        <h2 class="logo">Maipo Grande</h2>
        <img src="imagenes/menu.png" class="icon-menu" id="boton-menu">
        <nav>
            <ul id="lista-principal">
                @if (empty($_SESSION['usuario']))
                <li><a href="/">Inicio</a></li>
                <li><a href="login">Entrar</a></li>
                <li><a href="registro">Registrarse</a></li>
                <li><a href="administrador">Administrador</a></li>
                @else
                <li><a href="/">Inicio</a></li>
                <li class="li-perfilUsuario">
                    <img src="imagenes/usuario.png" class="img-usuario" id="img-perfil">
                </li>

                @endif
            </ul>
        </nav>
    </header>
    <div class="sub-menu">
        <ul class="lista-submenu">
            <li><a href="catalogo">Catálogo</a></li>
            @if (isset($_SESSION['usuario']))
            @if($_SESSION['tipo_usuario'] != 3)
            <li><a href="Pedidos">Pedidos</a></li>
            @endif
            @endif
            <ul class="subMenu-usuario" id="submenu-perfil">
                <li><a href="">Perfil</a></li>
                <li><a href="logout">Cerrar sesión</a></li>
                <li><a href="PublicarProducto">Publicar producto</a></li>
                <li><a href="Reportes">Reportes</a></li>
            </ul>
            <a href="carrito"><span class="icon-cart"></span></a>
            @if(isset($_SESSION['totalCart']))
            <p class="cantidad">{{ $_SESSION['totalCart'] }}</p>
            @else
            <p class="cantidad">0</p>
            @endif
        </ul>
    </div>
    <div class="menu-lateralResponsive" id="menu-responsive">
        <nav class="nav-responsive">
            <ul>
                @if (empty($_SESSION['usuario']))
                <li><a href="login">Entrar</a></li>
                <li><a href="registro">Registrarse</a></li>
                <li><a href="administrador">Administrador</a></li>
                <li><a href="catalogo">Catálogo</a></li>
                @if (isset($_SESSION['usuario']))
                @if($_SESSION['tipo_usuario'] != 3)
                <li><a href="pedidos">Pedidos</a></li>
                @endif
                @endif
                <ul class="subMenu-usuario" id="submenu-perfil">
                    <li><a href="">Perfil</a></li>
                    <li><a href="logout">Cerrar sesión</a></li>
                </ul>
                <a href="carrito" class="href-carrito"><span class="icon-cart"></span></a>
                @if(isset($_SESSION['totalCart']))
                <p class="cantidad">{{ $_SESSION['totalCart'] }}</p>
                @else
                <p class="cantidad">0</p>
                @endif
                @else
                <li class="li-perfilUsuario">
                    <img src="imagenes/usuario.png" class="img-usuario" id="img-perfil">
                </li>
                <li><a href="catalogo">Catálogo</a></li>
                @if (isset($_SESSION['usuario']))
                @if($_SESSION['tipo_usuario'] != 3)
                <li><a href="pedidos">Pedidos</a></li>
                @endif
                @endif
                <ul class="subMenu-usuario" id="submenu-perfil">
                    <li><a href="">Perfil</a></li>
                    <li><a href="logout">Cerrar sesión</a></li>
                </ul>
                <a href="carrito" class="href-carrito"><span class="icon-cart"></span></a>
                @if(isset($_SESSION['totalCart']))
                <p class="cantidad">{{ $_SESSION['totalCart'] }}</p>
                @else
                <p class="cantidad">0</p>
                @endif
                @endif
            </ul>
        </nav>
    </div>
    <div style="padding-left: 35%;width:90%">
        <table class="table" style="alligment: center;width:40%;">
            <thead>
                <tr>
                    <th scope="col" colspan="2">
                        <h2 style="text-align:center">Detalles despacho</h2>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($despacho as $row)
                    <tr>
                        <th scope="col" style="text-align:center" >
                            Transportista
                        </th>
                        <td>
                            {{$row->NOMBRE_TRANSPORTISTA}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" style="text-align:center">
                            Estado despacho
                        </th>
                        <td>
                            {{$row->ESTADO}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" style="text-align:center">
                            Fecha del despacho
                        </th>
                        <td>
                            {{$row->FECHA_DESPACHO}}
                        </td>
                    </tr>
                    @if($row->FECHA_RECIBIDO != NULL)
                        <tr>
                            <th scope="col" style="text-align:center">
                                Fecha recibido
                            </th>
                            <td>
                                {{$row->FECHA_RECIBIDO}}
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <h2 style="text-align:center">Historial de actualizacion</h2>
    <div style="padding-left: 20%;">
        
        <table class="table" style="width:20%">
            <tbody>
                @if(count($historial)>0)
                    @foreach($historial as $key=>$item)
                    <tr>
                        <th scope="col">
                            #
                        </th>
                        <td>
                            {{$key+1}}
                        </td>
                        <th scope="col">
                            Tipo actualización
                        </th>
                        <td>
                            {{$item->ESTADO}}
                        </td>
                        <th scope="col">
                            Fecha de la actualización
                        </th>
                        <td>
                            {{$item->FECHA_ACTUALIZACION}}
                        </td>
                        <th scope="col">
                            Detalle actualización
                        </th>
                        <td>
                            {{$item->DESCRIPCION}}
                        </td>
                    </tr>
                    <tr>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <th scope="col">
                            <h2>No hay actualizaciones del despacho</h2>
                        </th>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div style="padding: 7px;height: 50%;margin: 20px 25% 80px 25%;width: 50%;background-color: #ff9a00;border-radius: 25px;font-size: 27px;box-shadow: 0px 0px 5px;font-family: 'Encode Sans Condensed', sans-serif;">
                <a href="pedidos" style="text-align: center;text-decoration: none;color: #ffffff;"><h5>Volver</h5></a>
        </div> 
    <!--Footer-->
    <footer>
        <div class="contenedor">
            <div class="d-flex p-2 justify-content-center">
                <div class="copyright">
                    © 2020 Todos los derechos reservados | Diseñado por <a href="/"> Maipo Grande </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <script src="js/buscar.js"></script>
    <script src="js/menu.js"></script>
    <script src="js/aparecerIcono.js"></script>
</body>

</html>