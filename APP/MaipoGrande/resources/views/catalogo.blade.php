@if(!isset($_SESSION))
| {{ session_start() }}
@endif
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Catálogo</title>
    <link rel="stylesheet" href="css/catalogo.css">
    <link rel="stylesheet" href="css/registro.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
                @if (empty($_SESSION['usuario']))
                <li><a href="/">Inicio</a></li>
                <li><a href="login">Entrar</a></li>
                <li><a href="registro">Registrarse</a></li>
                <li><a href="contacto">Contacto</a></li>
                <li><span class="icon-search" id="buscador"></span></li>

                @else
                <li><a href="/">Inicio</a></li>
                <li><a href="contacto">Contacto</a></li>
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
            <li><a href=">Calidad Fruta">Calidad Fruta</a></li>
            <ul class="subMenu-usuario" id="submenu-perfil">
                <li><a href="">Perfil</a></li>
                <li><a href="logout">Cerrar sesión</a></li>
            </ul>
            <a href="carrito"><span class="icon-cart"></span></a>
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
        <div class="card" style="width: 18rem;">
            <img src="data:image/png;base64,{{ chunk_split(base64_encode($oferta->FOTO)) }}">
            <div class="card-body">
                <h5 class="card-title">{{ $oferta->TIPO_FRUTA}}</h5>
                <p class="card-text">Vendedor: {{ $oferta->NOMBRE_VENDEDOR}}</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Tipo de calidad: {{ $oferta->CALIDAD}}</li>
                <li class="list-group-item">Precio: $ {{ $oferta->PRECIO}} {{ $oferta->MONEDA }}</li>
            </ul>
            <div class="centrar-texto">
                <a href="#" class="btn btn-outline-success">Ver más</button>
                    <a class="btn btn-outline-success" href="addCart/{{ $oferta->ID}}" role="button">Añadir al carro</a>
            </div>
        </div>
        @endforeach
    </div>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/buscar.js"></script>
    <script src="js/rangoPrecios.js"></script>
    <script src="js/aparecerIcono.js"></script>
    <script src="js/submenu.js"></script>
</body>

</html>