<!--V5 Laravel -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Maipo Grande</title>
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
        <img src="imagenes/menu.png" class="icon-menu" onclick="mostrarMenu()" style="cursor: pointer;">
        <nav>
            <ul id="lista-principal">
                @if (empty($_SESSION['usuario']))
                <li><a href="/">Inicio</a></li>
                <li><a href="login">Entrar</a></li>
                <li><a href="registro">Registrarse</a></li>
                <li><a href="catalogo">Catalogo</a></li>
                @else
                @if($_SESSION['tipo_usuario'] == 1)
                <li><a href="admin">Administrador</a></li>
                @endif
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
            @if (isset($_SESSION['usuario']))
            @if($_SESSION['tipo_usuario'] == 3)
            <li><a href="catalogo">Catálogo</a></li>
            @else
            <li><a href="pedidos">Pedidos</a></li>
            @endif
            @else
            <li><a href="catalogo">Catálogo</a></li>
            @endif
            <ul class="subMenu-usuario" id="submenu-perfil">
                <li><a href="">Perfil</a></li>
                <li><a href="logout">Cerrar sesión</a></li>
                @if (isset($_SESSION['usuario']))
                @if($_SESSION['tipo_usuario'] == 6)
                <li><a href="Reportes">Reportes</a></li>
                @elseif($_SESSION['tipo_usuario'] == 4)
                <li><a href="PublicarPedidoExt">Pedidos Internacionales</a></li>
                @elseif($_SESSION['tipo_usuario'] == 2)
                <li><a href="PublicarPedido">Publicar producto</a></li>
                @endif
                @endif
            </ul>
            <a href="carrito"><span class="icon-cart"></span></a>
            @if(isset($_SESSION['totalCart']))
            <p class="cantidad">{{ $_SESSION['totalCart'] }}</p>
            @else
            <p class="cantidad">0</p>
            @endif
        </ul>
    </div>

    <style>
        .x-wrapper {
            position: relative;
            display: flex;
            align-items: stretch;
            float: right;
        }

        .x-sidebar-container {
            position: absolute;
            z-index: 2;
            height: 100%;
        }

        .x-sidebar {
            width: 300px;
            display: inline-block;
            color: white;
            margin-left: 0px;
            transition: margin 0.5s;
        }

        .x-sidebar.active {
            margin-left: -300px;
        }
    </style>

    <div class="x-wrapper">
        <div class="x-sidebar-container">
            <div class="x-sidebar" id="x-sidebar">
                <ul class="list-group"> 
                    @if (empty($_SESSION['usuario']))
                    <li class="list-group-item"><a class="nav-link"  href="login">Entrar</a></li>
                    <li class="list-group-item"><a class="nav-link" href="registro">Registrarse</a></li>
                    <li class="list-group-item"><a class="nav-link" href="catalogo">Catálogo</a></li>
                    @if (isset($_SESSION['usuario']))
                    @if($_SESSION['tipo_usuario'] == 5)
                    <li class="list-group-item"><a class="nav-link" href="Reportes">Reportes</a></li>
                    @elseif($_SESSION['tipo_usuario'] == 4)
                    <li class="list-group-item"><a class="nav-link" href="PublicarPedidoExt">Pedidos Internacionales</a></li>
                    @elseif($_SESSION['tipo_usuario'] == 2)
                    <li class="list-group-item"><a class="nav-link" href="PublicarPedido">Publicar producto</a></li>
                    @endif
                    @endif
                    <ul class="subMenu-usuario" id="submenu-perfil">
                        <li class="list-group-item"><a class="nav-link" href="">Perfil</a></li>
                        <li class="list-group-item"><a class="nav-link" href="logout">Cerrar sesión</a></li>
                    </ul>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a class="nav-link" href="carrito" class="href-carrito" style="justify-content: center; display:flex;"><span class="icon-cart"></span></a>
                            @if(isset($_SESSION['totalCart']))
                            <p class="cantidad" style="justify-content: center; display:flex;">{{ $_SESSION['totalCart'] }}</p>
                            @else
                            <p class="cantidad" style="justify-content: center; display:flex;">0</p>
                            @endif
                            @else
                        </li>
                    </ul>
                    
                    <!-- <li class="list-group-item" class="li-perfilUsuario">
                        <img src="imagenes/usuario.png" class="img-usuario" id="img-perfil">
                    </li> -->
                    @if (isset($_SESSION['usuario']))
                    @if($_SESSION['tipo_usuario'] == 1)
                    <li class="list-group-item"><a class="nav-link" href="administrador">Administrador</a></li>
                    <li class="list-group-item"><a class="nav-link" href="logout">Cerrar sesión</a></li>
                    @endif
                    @endif
                    @if (isset($_SESSION['usuario']))
                    @if($_SESSION['tipo_usuario'] == 2)
                    <li class="list-group-item"><a class="nav-link" href="PublicarPedido">Publicar Producto</a></li>
                    <li class="list-group-item"><a class="nav-link" href="pedidos">Pedidos</a></li>
                    <li class="list-group-item"><a class="nav-link" href="logout">Cerrar sesión</a></li>
                    @endif
                    @endif
                    @if (isset($_SESSION['usuario']))
                    @if($_SESSION['tipo_usuario'] == 3)
                    <li class="list-group-item"><a class="nav-link" href="catalogo">Catalogo</a></li>
                    <li class="list-group-item"><a class="nav-link" href="logout">Cerrar sesión</a></li>
                    @endif
                    @endif
                    @if (isset($_SESSION['usuario']))
                    @if($_SESSION['tipo_usuario'] == 4)
                    <li class="list-group-item"><a class="nav-link" href="PublicarPedidoExt">Pedidos Internacionales</a></li>
                    <li class="list-group-item"><a class="nav-link" href="pedidos">Pedidos</a></li>
                    <li class="list-group-item"><a class="nav-link" href="logout">Cerrar sesión</a></li>
                    @endif
                    @endif
                    @if (isset($_SESSION['usuario']))
                    @if($_SESSION['tipo_usuario'] == 6)
                    <li class="list-group-item"><a href="admin">Reporte usuarios y producto</a></li>
                    <li class="list-group-item"><a href="logout">Cerrar sesión</a></li>
                    @endif
                    @endif


                    <ul class="subMenu-usuario" id="submenu-perfil">
                        <li class="list-group-item"><a class="nav-link" href="">Perfil</a></li>
                        <li class="list-group-item"><a class="nav-link" href="logout">Cerrar sesión</a></li>
                    </ul>
                    <!-- <ul class="list-group">
                        <li class="list-group-item">
                            <a href="carrito" class="href-carrito"><span class="icon-cart"></span></a>
                            @if(isset($_SESSION['totalCart']))
                            <p class="cantidad">{{ $_SESSION['totalCart'] }}</p>
                            @else
                            <p class="cantidad">0</p>
                            @endif
                            @endif
                        </li>
                    </ul> -->
                </ul>
            </div>
        </div>
    </div>



    <div class="container-inicio">
        <div class="slider-wrapper theme-mi-slider">
            <div id="slider" class="nivoSlider">
                <img src="img-slider/slider2.jpg">
                <img src="img-slider/slider3.jpg">
                <img src="img-slider/slider4.jpg">
            </div>
        </div>
    </div>


    <div class="wrapper">
        <div class="slider-testimonial">
            <div class="testimonial-item">
                <div class="testimonial-client">
                    <img src="testimonios/testimonioalvaromellado.jpg" alt="">
                    <p class="client-name">Alvaro Mellado</p>
                </div>
                <div class="testimonial-text">
                    <p>Me encanta Maipo Grande ya que ofrece productos, con calidad y descuentos muy buenos, y esto no lo hace cualquier empresa dedicada</p>
                </div>
            </div>
            <div class="testimonial-item">
                <div class="testimonial-client">
                    <img src="testimonios/testimonioEB.png" alt="">
                    <p class="client-name">Edgar Barrera</p>
                </div>
                <div class="testimonial-text">
                    <p>Ofrecen una atención inolvidable, realmente recomiendo a Maipo Grande para comprar Frutas.</p>
                </div>
            </div>
            <div class="testimonial-item">
                <div class="testimonial-client">
                    <img src="testimonios/testimonio2.png" alt="">
                    <p class="client-name">Christofer Quiroz</p>
                </div>
                <div class="testimonial-text">
                    <p>Productos como lo que ofrece Maipo Grande no se consiguen en otra parte, tienes mi voto de confianza para que compres</p>
                </div>
            </div>
            <div class="testimonial-item">
                <div class="testimonial-client">
                    <img src="testimonios/testimonio1.png" alt="">
                    <p class="client-name">Millaray Rojas</p>
                </div>
                <div class="testimonial-text">
                    <p>Con los productos que ofrece Maipo Grande mi vida es mucha más saludable, adquiere los productos te los recomiendo para tu salud que es lo más importante</p>
                </div>
            </div>
            <div class="testimonial-item">
                <div class="testimonial-client">
                    <img src="testimonios/testimoniosjason.jpg" alt="">
                    <p class="client-name">Jason Leon</p>
                </div>
                <div class="testimonial-text">
                    <p>La navegabilidad que ofrece la página web es muy buena, recibí mi producto en período de tiempo muy corto</p>
                </div>
            </div>
        </div>
    </div>

    <!--Footer-->
    <footer>
        <div class="contenedor">
            <div class="d-flex p-2 justify-content-center" style="text-align: center;">
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

    <script>
        $(window).on('resize', function() {
            $('#x-sidebar').removeClass('active')
        })

        function mostrarMenu() {

            if (!$('#x-sidebar').hasClass('active')) {
                $('#x-sidebar').addClass('active')

            } else {
                $('#x-sidebar').removeClass('active')
            }
        }
    </script>
</body>

</html>