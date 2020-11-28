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
        <img src="imagenes/menu.png" class="icon-menu" id="boton-menu">
        <nav>
            <ul id="lista-principal">
                @if (empty($_SESSION['usuario']))
                <li><a href="/">Inicio</a></li>
                <li><a href="login">Entrar</a></li>
                <li><a href="registro">Registrarse</a></li>
                <li><a href="administrador">Administrador</a></li>
                <li><span class="icon-search" id="buscador"></span></li>

                @else
                <li><a href="/">Inicio</a></li>
                <li><span class="icon-search" id="buscador"></span></li>
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
            <li><a href="maipogrande">Calidad Fruta</a></li>
            <ul class="subMenu-usuario" id="submenu-perfil">
                <li><a href="">Perfil</a></li>
                <li><a href="logout">Cerrar sesión</a></li>
                <li><a href="PublicarProducto">Publicar producto</a></li>
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
                <li><a href="maipogrande.html">Calidad Fruta</a></li>
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
                <li><a href=""><span class="icon-search"></span></a></li>
                <li class="li-perfilUsuario">
                    <img src="imagenes/usuario.png" class="img-usuario" id="img-perfil">
                </li>
                <li><a href="catalogo">Catálogo</a></li>
                <li><a href="maipogrande.html">Calidad Fruta</a></li>
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
                    <p>Ofrecen una atención inolvidable, realmente recomiendo a Maipo Grande para comprar Frutas o verduras.</p>
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