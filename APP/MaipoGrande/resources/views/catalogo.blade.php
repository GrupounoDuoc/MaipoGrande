<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Catálogo</title>
    <link rel="stylesheet" href="css/catalogo.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="iconos/style.css">
    <!-- PWA -->
    @laravelPWA
</head>

<body>
    <header id="cabecera">
        <img src="imagenes/manzana.png" class="img-logo">
        <h1 class="logo">Maipo Grande</h1>
        <img src="imagenes/menu.png" class="icon-menu" id="boton-menu">
        <nav>
            <ul id="lista-principal">
                <?php
                if (empty($_SESSION['datos'])) { ?>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="login.php?url=<?php echo $_SERVER["REQUEST_URI"] ?>">Entrar</a></li>
                    <li><a href="registro">Registrarse</a></li>
                    <li><a href="administrador">Administrador</a></li>
                    <li><span class="icon-search" id="buscador"></span></li>

                <?php } else { ?>
                    <li><a href="index.php">Inicio</a></li>
                    <li><span class="icon-search" id="buscador"></span></li>
                    <li class="li-perfilUsuario">
                        <img src="imagenes/usuario.png" class="img-usuario" id="img-perfil">
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </header>
    <div class="sub-menu">
        <ul class="lista-submenu">
            <li><a href="catalogo.php">Catálogo</a></li>
            <li><a href="maipogrande.php">Calidad Fruta</a></li>
            <ul class="subMenu-usuario" id="submenu-perfil">
                <li><a href="php/validarUsuario.php">Perfil</a></li>
                <li><a href="php/cerrar.php">Cerrar sesión</a></li>
            </ul>
            <a href="carrito.php"><span class="icon-cart"></span></a>
            @if(isset($_SESSION['totalCart']))
            <p class="cantidad">{{ $_SESSION['totalCart'] }}</p>
            @else
            <p class="cantidad">0</p>
            @endif
        </ul>
    </div>
    <form action="{{ route('catalogo') }}" method="POST">
        @csrf
        <div class="menu-lateral">
            <nav class="submenu-lateral">
                <ul class="lista-lateral">
                    <li><span><img src="imagenes/icon-fruta.png"></span>Tipo fruta</li>
                    <ul>
                        @foreach ($tipos as $tipo)
                        @if( $tipo->TIPO_FRUTA == $tipoSelected)
                        <li><input type="radio" name="tipo" checked value="{{ $tipo->TIPO_FRUTA}}"><label for="{{ $tipo->TIPO_FRUTA}}">{{ $tipo->TIPO_FRUTA}}</label></li>
                        @else
                        <li><input type="radio" name="tipo" value="{{ $tipo->TIPO_FRUTA}}"><label for="{{ $tipo->TIPO_FRUTA}}">{{ $tipo->TIPO_FRUTA}}</label></li>
                        @endif
                        @endforeach
                    </ul>
                    <li><span><img src=""></span>Calidad</li>
                    <ul>
                        @foreach ($calidades as $calidad)
                        @if( $calidad->CALIDAD == $calidadSelected)
                        <li><input type="radio" name="calidad" checked value="{{ $calidad->CALIDAD}}"><label for="{{ $calidad->CALIDAD}}">{{ $calidad->CALIDAD}}</label></li>
                        @else
                        <li><input type="radio" name="calidad" value="{{ $calidad->CALIDAD}}"><label for="{{ $calidad->CALIDAD}}">{{ $calidad->CALIDAD}}</label></li>
                        @endif
                        @endforeach
                    </ul>
                    <br>
                    <input type="submit" name="send" value="Filtrar">
                    <button><a href="{{ action('App\Http\Controllers\pedidoController@catalogo') }}" class="button">Limpiar filtros </a></button>
                </ul>
            </nav>
        </div>
    </form>
    <div class="contenido-productos">
        @foreach ($ofertas as $oferta)
        <div class='card'>
            <img src="data:image/png;base64,{{ chunk_split(base64_encode($oferta->FOTO)) }}">
            <h2>{{ $oferta->TIPO_FRUTA}}</h2>
            <p><em>{{ $oferta->NOMBRE_VENDEDOR}}</em></p><br>
            <p><em>{{ $oferta->CALIDAD}}</em></p><br>
            <h3 value="">Precio: $ {{ $oferta->PRECIO}} {{ $oferta->MONEDA }}</h3><br>
            <button><a href="">Ver más</a></button>
            <button><a href="addCart/{{ $oferta->ID}}">Añadir al carro</a></button>
        </div>
        @endforeach
    </div>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <script src="js/buscar.js"></script>
    <script src="js/rangoPrecios.js"></script>
    <script src="js/aparecerIcono.js"></script>
    <script src="js/submenu.js"></script>
</body>

</html>