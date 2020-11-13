<?php
    /*
    session_start();
    include("php/conexion.php");

    if (isset($_SESSION['datos'])) {
        $id_User = $_SESSION['datos']['id'];
        $consulta = "SELECT * FROM carrito_compras WHERE id_usuario = '$id_User'";
        $resultado = mysqli_query($conexion, $consulta);
        $cantidad = mysqli_num_rows($resultado);
        
    }else {
        $cantidad = 0;
    }

    if (isset($conexion)) {
        echo "";
    }else {
        echo "Error";
    }

    if (isset($_GET['id'])) {
        $tipo = $_GET['id'];

    }else {
        $tipo = 'fruta';
    }

    if (isset($_GET['rango'])) {
        echo $_GET['rango'];
    }

    $query = "SELECT * FROM productos WHERE tipo = '$tipo'";
    //$resultado = $conexion->query($query);
*/
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Catálogo</title>
    <link rel="stylesheet" href="css/catalogo.css">
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Condensed" rel="stylesheet">
    <!-- PWA -->
    @laravelPWA
    <link rel="stylesheet" href="iconos/style.css">
</head>
<body>
    <header id="cabecera">
        <img src="imagenes/manzana.png" class="img-logo">
        <h1 class="logo">Maipo Grande</h1>
        <img src="imagenes/menu.png" class="icon-menu" id="boton-menu">
        <nav>
            <div class="container-buscador" id="contenido">
                <form action="php/buscar.php?url=<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST">
                    <input type="text" id="campoBuscar" placeholder="Buscar..." name="productoBuscar">
                    <span class="icon-search"></span>
                </form>
            </div>
            <ul id="lista-principal">
                <?php 
                    if (empty($_SESSION['datos'])) { ?>
                    <li><a href="index.php">Incio</a></li>
                    <li><a href="login.php?url=<?php echo $_SERVER["REQUEST_URI"]?>">Entrar</a></li>
                    <li><a href="registro.php">Registrarse</a></li>
                    <li><a href="contacto.php">Contacto</a></li>
                    <li><span class="icon-search" id="buscador"></span></li>
                    
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

    
    <div class="sub-menu">
        <ul class="lista-submenu">
            <li><a href="catalogo">Catálogo</a></li>
            <li><a href="maipogrande.php">Calidad Fruta</a></li>
            <ul class="subMenu-usuario" id="submenu-perfil">
                <li><a href="php/validarUsuario.php">Perfil</a></li>
                <li><a href="php/cerrar.php">Cerrar sesión</a></li>
            </ul>
            <a href="carrito.php"><span class="icon-cart"></span></a>
            <p class="cantidad"><?php echo 'cantidad' ?></p>
        </ul>
    </div>  
    <div class="menu-lateralResponsive" id="menu-responsive">
        <nav class="nav-responsive">
            <ul>
                <li><a href="login.php?url=index.html">Entrar</a></li>
                <li><a href="registro.php">Registrarse</a></li>
                <li><a href="contacto.php">Contacto</a></li>
                <li><a href=""><span class="icon-cart"></span></a></li>
                <p class="cantidad"><?php echo 'cantidad' ?></p>
            </ul>
        </nav>  
    </div>
    <div class="menu-lateral">
        <nav class="submenu-lateral">
            <ul class="lista-lateral">
                <li><span><img src="imagenes/icon-fruta.png"></span><a href="catalogo.php?id=fruta">Tipo fruta</a></li>
                <ul>
                    @foreach ($tipos as $tipo)
                    <li><input type="radio" name="tipo" checked="" value="{{ $tipo->TIPO_FRUTA}}"><label for="{{ $tipo->TIPO_FRUTA}}">{{ $tipo->TIPO_FRUTA}}</label></li>
                    @endforeach
                </ul>
                <li><span><img src="imagenes/icon-verdura.png"></span><a href="catalogo.php?id=verdura">Verduras</a></li>
                
            </ul>
        </nav>
    </div>
    <div class="contenido-productos">
        @foreach ($ofertas as $oferta)
            <div class='card'>
                <img src="data:image/png;base64,{{ chunk_split(base64_encode($oferta->FOTO)) }}">
                <h2>{{ $oferta->TIPO_FRUTA}}</h2>
                <p><em>{{ $oferta->NOMBRE_VENDEDOR}}</em></p><br>
                <p><em>{{ $oferta->CALIDAD}}</em></p><br>
                <h3 value="">Precio: $ {{ $oferta->PRECIO}} {{ $oferta->MONEDA }}</h3><br>
                <button><a href="">Ver más</a></button>
            </div>
        @endforeach
    </div>

    <script src="js/buscar.js"></script>
    <script src="js/rangoPrecios.js"></script>
    <script src="js/aparecerIcono.js"></script>
    <script src="js/submenu.js"></script>
</body>
</html>