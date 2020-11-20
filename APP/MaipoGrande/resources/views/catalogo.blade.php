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
    <link href="../public/css/simple-sidebar.css" rel="stylesheet" type="text/css">

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
                    <div class="centrar-texto">
                        <a href="#" class="btn btn-info">Ver más</button>
                            <a class="btn btn-danger" href="addCart/{{ $oferta->ID}}" role="button">Añadir al carro</a>
                    </div>
            
                </div>
                @endforeach
            </div>
        </div>
    </div>

-->
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <img src="imagenes/manzana.png" style="height:1.25rem; margin-right:0.8rem">
            <a class="navbar-brand" href="/">Maipo Grande</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                @if (empty($_SESSION['usuario']))
                    <li class="nav-item active">
                        <a class="nav-link" href="catalogo"> Catalogo <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login">Entrar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="registro">Registrarse</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="maipogrande">Calidad Fruta</a>
                    </li>

                    @else
                    <li class="nav-item active">
                        <a href="/">Inicio</a>
                    </li>
                    <li><i class="fas fa-user"></i>
                        <img src="imagenes/usuario.png" class="img-usuario" id="img-perfil">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="maipogrande">Calidad Fruta</a>
                    </li>
                    @endif

                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Buscar producto ..." aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                </form>
            </div>
        </nav>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-light border-right " id="sidebar-wrapper">
            <div class="sidebar-heading">Catalogo </div>
            <div class="list-group list-group-flush"> 
                <form action="{{ route('catalogo') }}" method="POST">
                    @csrf
                    <ul>
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
                        <li><span></span>Calidad</li>
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
                        <input type="submit" class="btn btn-success" name="send" value="Filtrar">
                        <button><a href="{{ action('App\Http\Controllers\pedidoController@catalogo') }}" class="btn btn-primary">Limpiar filtros </a></button>
                    </ul>
                </form>
            </div>
        </div>


    
    <div id="page-content-wrapper">

        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <button class="btn btn-primary" id="menu-toggle">Desplegar Menu</button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                <!--<a class="nav-link" href="#">Carrito <span class="sr-only">(current)</span></a>-->
                </li>
                <a href="carrito"><span class="icon-cart"></span></a>
                    @if(isset($_SESSION['totalCart']))
                    <p class="cantidad">{{ $_SESSION['totalCart'] }}</p>
                    @else
                    <p class="cantidad">0</p>
                    @endif
            </ul>
        </div>
        </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-4 " style="max-width:25rem;">
            @foreach ($ofertas as $oferta)
                <div class="card" style="margin-bottom: 1.5rem; margin-top:1rem">
                    <img src="data:image/png;base64,{{ chunk_split(base64_encode($oferta->FOTO)) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $oferta->TIPO_FRUTA}}</h5>
                        <p class="card-text">Vendedor: {{ $oferta->NOMBRE_VENDEDOR}}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Tipo de calidad: {{ $oferta->CALIDAD}}</li>
                        <li class="list-group-item">Precio: $ {{ $oferta->PRECIO}} {{ $oferta->MONEDA }}</li>
                    </ul>
                    <div class="card-body">
                        <a href="addCart/{{ $oferta->ID}}" class="card-link btn btn-primary">Añadir al carro</a>
                        <a href="#" class="card-link btn btn-success">Ver mas</a>
                    </div>
                </div>    
            @endforeach
            </div>

            <div class="col-12 col-md-4" style="max-width:25rem; margin-top:1rem">
            @foreach ($ofertas as $oferta)
                <div class="card">
                    <img src="data:image/png;base64,{{ chunk_split(base64_encode($oferta->FOTO)) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $oferta->TIPO_FRUTA}}</h5>
                        <p class="card-text">Vendedor: {{ $oferta->NOMBRE_VENDEDOR}}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Tipo de calidad: {{ $oferta->CALIDAD}}</li>
                        <li class="list-group-item">Precio: $ {{ $oferta->PRECIO}} {{ $oferta->MONEDA }}</li>
                    </ul>
                    <div class="card-body">
                        <a href="addCart/{{ $oferta->ID}}" class="card-link btn btn-primary">Añadir al carro</a>
                        <a href="#" class="card-link btn btn-success">Ver mas</a>
                    </div>
                </div>    
            @endforeach
            </div>

            <div class="col-12 col-md-4" style="max-width:25rem; margin-top:1rem">
            @foreach ($ofertas as $oferta)
                <div class="card" style="margin-bottom: 1.5rem;">
                    <img src="data:image/png;base64,{{ chunk_split(base64_encode($oferta->FOTO)) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $oferta->TIPO_FRUTA}}</h5>
                        <p class="card-text">Vendedor: {{ $oferta->NOMBRE_VENDEDOR}}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Tipo de calidad: {{ $oferta->CALIDAD}}</li>
                        <li class="list-group-item">Precio: $ {{ $oferta->PRECIO}} {{ $oferta->MONEDA }}</li>
                    </ul>
                    <div class="card-body">
                        <a href="addCart/{{ $oferta->ID}}" class="card-link btn btn-primary">Añadir al carro</a>
                        <a href="#" class="card-link btn btn-success">Ver mas</a>
                    </div>
                </div>    
            @endforeach
            </div>

            <div class="col-12 col-md-4" style="max-width:25rem;">
                @foreach ($ofertas as $oferta)
                    <div class="card">
                        <img src="data:image/png;base64,{{ chunk_split(base64_encode($oferta->FOTO)) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $oferta->TIPO_FRUTA}}</h5>
                            <p class="card-text">Vendedor: {{ $oferta->NOMBRE_VENDEDOR}}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Tipo de calidad: {{ $oferta->CALIDAD}}</li>
                            <li class="list-group-item">Precio: $ {{ $oferta->PRECIO}} {{ $oferta->MONEDA }}</li>
                        </ul>
                        <div class="card-body">
                            <a href="addCart/{{ $oferta->ID}}" class="card-link btn btn-primary">Añadir al carro</a>
                            <a href="#" class="card-link btn btn-success">Ver mas</a>
                        </div>
                    </div>    
                @endforeach
            </div>
        </div>

    </div>
   
    
<!-- /#sidebar-wrapper -->

<!-- Page Content -->

<!-- /#page-content-wrapper -->
    </div>

    </div>
        <footer class="page-footer font-small blue black">
            <div class="footer-copyright text-center py-3">
                © 2020 Todos los derechos reservados | Diseñado por <a href="/"> Maipo Grande</a>
            </div>
        </footer>


<!--   
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <img src="imagenes/manzana.png" style="height:1.25rem; margin-right:0.8rem">
            <a class="navbar-brand" href="/">Maipo Grande</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="catalogo"> Catalogo <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login">Entrar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="registro">Registrarse</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="maipogrande">Calidad Fruta</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>

        <div class="row">
            <div class="d-flex" id="wrapper">

           
            <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading">Catalogo </div>
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action bg-light">Dashboard</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Shortcuts</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Overview</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Events</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Profile</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Status</a>
            </div>
            </div>
           
            </div>
            <div class="mt-4">
                <div class="row" style="padding:20px">
                    <div class="col-sm-12 col-md-4 col-lg-3 col-xl-2 ">
                        @foreach ($ofertas as $oferta)
                            <div class="card" style="width: 100%">
                                <img src="data:image/png;base64,{{ chunk_split(base64_encode($oferta->FOTO)) }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $oferta->TIPO_FRUTA}}</h5>
                                    <p class="card-text">Vendedor: {{ $oferta->NOMBRE_VENDEDOR}}</p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Tipo de calidad: {{ $oferta->CALIDAD}}</li>
                                    <li class="list-group-item">Precio: $ {{ $oferta->PRECIO}} {{ $oferta->MONEDA }}</li>
                                </ul>
                                <div class="card-body">
                                    <a href="addCart/{{ $oferta->ID}}" class="card-link">Añadir al carro</a>
                                    <a href="#" class="card-link">Ver mas</a>
                                </div>
                            </div>    
                        @endforeach
                    </div>    
                </div>    
            </div>
        </div>
-->

        <!-- <div class="col-sm-12 col-md-8 col-lg-9 col-xl-10"> Esto es el contenedor del catalogo producto -->
   
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

    <script>
    $("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
    });
    </script>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <script src="js/buscar.js"></script>
    <script src="js/rangoPrecios.js"></script>
    <script src="js/aparecerIcono.js"></script>
    <script src="js/submenu.js"></script>
</body>

</html>