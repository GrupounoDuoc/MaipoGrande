

<!--
    include("php/conexion.php");
    session_start();

    if (isset($_SESSION['datos'])) {
        $id_User = $_SESSION['datos']['id'];

        $consulta = "SELECT * FROM carrito_compras WHERE id_usuario = '$id_User'";
        $resultado = mysqli_query($conexion, $consulta);

        $cantidad = mysqli_num_rows($resultado);
    }else {
        $cantidad = 0;
    }
-->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Maipo Grande</title>
    <link rel="stylesheet" href="css/maipogrande.css">
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

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
</head>
<body>
    <header id="cabecera">
        <img src="imagenes/manzana.png" class="img-logo"> 
        <h1 class="logo"><a href="index.html">Maipo Grande</a></h1>
        <img src="imagenes/menu.png" class="icon-menu" id="boton-menu">
        <nav>
            <div class="container-buscador" id="contenido">
                <form action="php/buscar.php?url=<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST">
                    <input type="text" id="campoBuscar" placeholder="Buscar..." name="productoBuscar">
                    <span class="icon-search"></span>
                </form>
            </div>
            <ul id="lista-principal">
                <?php if (empty($_SESSION['datos'])) { ?>

                    <li><a href="/">Inicio</a></li>
                    <li><a href="login.php?url=<?php echo $_SERVER["REQUEST_URI"]?>">Entrar</a></li>
                    <li><a href="registro.php">Registrarse</a></li>
                    
                <?php }else { ?>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="contacto.php">Contacto</a></li>
                <li><span class="icon-search" id="buscador"></span></li>
                <li class="li-perfilUsuario">
                    <img src="imagenes/usuario.png" class="img-usuario" id="img-perfil">
                </li>

                <?php } ?>
            </ul>
            
            <?php if (isset($_SESSION['objetoNoEncontrado'])) { ?>
                <h3 class="errorBusqueda" id="messageError"><?php echo $_SESSION['objetoNoEncontrado'] ?></h3>
            <?php unset($_SESSION['objetoNoEncontrado']); } ?>
            
        </nav>
    </header>
    <div class="menu-lateralResponsive" id="menu-responsive">
        <nav class="nav-responsive">
            <ul>
                <li><a href="login.php?url=index.php">Entrar</a></li>
                <li><a href="registro.php">Registrarse</a></li>
                <li><a href="contacto.php">Contacto</a></li>
                <li><a href="carrito.php"><span class="icon-cart"></span></a></li>
            </ul>
        </nav>  
    </div>
    <div class="container-inicio">
        <div class="slider-wrapper theme-mi-slider">
            <div id="slider" class="nivoSlider">     
                <img src="imagenes/sliderorganic1.jpg">
                <img src="imagenes/sliderorganic2.jpg">
                <img src="imagenes/sliderorganic3.jpg">
            </div> 
        </div>
    </div>
    <div class="sub-menu2" id="sub-menu">
            <ul class="lista-submenu2 col-12">
                <li><a href="#seccion1" class="col-xs-2">Identificar una fruta de calidad</a></li>
                <li><a href="#seccion2" class="col-xs-2">Control de Calidad</a></li>
                <li><a href="#seccion3" class="col-xs-2">Beneficios</a></li>
            </ul>
    </div>
    <section class="parrafo" id="seccion1">

        <div class="contenedorparrafo">
            <article class="parrafo-columna">
                <h1>¿Como se cataloga la calidad de la fruta?</h1>
                <p>Los productos que ofrece Maipo Grande van de calidad A a D de la A es la fruta de mejor calidad, siendo que la D es una peor calidad. Además los productos de calidad tienen un mejor sabor, más vitaminas, minerales, antioxidantes y una mayor durabilidad, esto es debido a que al no usar químicos ni pesticidas el producto conserva íntegramente todas sus propiedades.</p>
            </article>
        </div>

    </section>
    <section class="parrafo2" id="seccion2">

            <div class="contenedorparrafo">
                <article class="parrafo-columna2">
                    <div class="etiqueta">
                        <img src="imagenes/controlcalidad.png">
                        <h4>Control de calidad <br>El proceso que maneja nuestra empresa maipo grande es brindar un buen producto al cliente</h4>
                    </div>
                        <h1>Control de calidad de nuestros productos</h1>
                        <p>Las frutas que ofrecemos al publico, pasan por varios factores de calidad, nos catalogamos por vender un producto en muy buen estado, y los que esten mas tiempo en bodega, se rematan para comerciantes locales y a un menor precio</p>
                </article>
            </div>
            
        </section>
        <section class="parrafo" id="seccion3">

                <div class="contenedorparrafo">
                    <article class="parrafo-columna">
                        <h1>Beneficios</h1>
                        <p>Como mantienen intactos sus nutrientes (sobre todo si se ingieren crudos), ofrecen más vitaminas, minerales y antioxidantes que los productos convencionales. Alimenta sanamente a tu familia. Escoge de nuestra amplia selección de productos, todos orgánicos y naturales, solo dando un clic, ¡sigue nuestros consejos y comentarios para un buen vivir!</p>
                    </article>
                </div>
                
            </section>
<!--Footer-->
<footer>
    

        <button onclick="topFunction()" id="myBtn" title="Go to top">Arriba</button>

        <script>
//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>

        <br><div class="cont-footer">
            <div class="alineacion">
            <div class="copyright">
                © 2020 Todos los derechos reservados | Diseñado por <a href="index.html"> Maipo Grande @</a>
            </div>
            
        </div>
    </div>
</footer>

    <script src="js/buscar.js"></script>
    <script src="js/scrollMenu.js"></script>
    <script src="js/menu.js"></script>
    <script src="js/aparecerIcono.js"></script>
</body>
</html>