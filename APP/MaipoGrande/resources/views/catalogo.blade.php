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
    <link rel="stylesheet" href="css/header-footer.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="iconos/style.css">
    <!-- PWA -->
    @laravelPWA
</head>

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
                        <a class="nav-link " href="catalogo"> Catalogo <span class="sr-only">(current)</span></a>
                        
                    </li>
                    <li><a class="nav-link" href="/">Inicio</a></li>
                    <li><a class="nav-link" href="login">Entrar</a></li>
                    <li><a class="nav-link" href="registro">Registrarse</a></li>
                    <li><a class="nav-link" href="administrador">Administrador</a></li>

                    @else
                    <li class="nav-item active"><a href="/">Inicio</a></li>

                    <!--
                    <li class="li-perfilUsuario">
                        <img src="imagenes/usuario.png" class="img-usuario" id="img-perfil">
                    </li>
                        Sirve este y el img de abajo -->

                    <!-- <li class="nav-item">
                        <a class="nav-link" href="maipogrande">Calidad Fruta</a>
                    </li>
                    <li><i class="fas fa-user"></i>
                        <img src="imagenes/usuario.png" class="img-usuario" id="img-perfil">
                    </li> -->

                    @endif
                    
                </ul>
            </div>
        </nav>
<form action="/catalogo" method="POST">
@csrf
<!-- <header id="cabecera">

<img src="imagenes/manzana.png" class="img-logo">
<h2 class="logo">Maipo Grande</h2>
<img src="imagenes/menu.png" class="icon-menu" id="boton-menu">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
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
</nav> -->
<!-- </header>
<div class="sub-menu">
<ul class="lista-submenu">
    <li><a href="catalogo">Catálogo</a></li>
    @if (isset($_SESSION['usuario']))
        @if($_SESSION['tipo_usuario'] != 3)
            <li><a href="ofertas">Ofertas</a></li>
        @endif
    @endif
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
        @if (isset($_SESSION['usuario']))
            @if($_SESSION['tipo_usuario'] != 3)
                <li><a href="catalogo">Catálogo</a></li>
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
</nav>  -->
    </div>
        @if(isset($_SESSION['status']))
            <div class="alert alert-danger" role="alert">
                {{ $_SESSION['status'] }}
            </div>
        @endif
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-light border-right " id="sidebar-wrapper">
            <div class="sidebar-heading">Catalogo </div>
            <div class="list-group list-group-flush"> 
                    <ul>
                        <li><span><img src="imagenes/icon-fruta.png"></span>Tipo fruta</li>
                        <ul>
                            @foreach ($tipos as $tipo)
                                @if( $tipo->TIPO_FRUTA == $tipoSelected)
                                    <li><input onclick="this.form.submit();" type="radio" name="tipo" checked="true" value="{{ $tipo->TIPO_FRUTA}}"><label for="{{ $tipo->TIPO_FRUTA}}">{{ $tipo->TIPO_FRUTA}}</label></li>
                                @else
                                    <li><input onclick="this.form.submit();" type="radio" name="tipo" value="{{ $tipo->TIPO_FRUTA}}"><label for="{{ $tipo->TIPO_FRUTA}}">{{ $tipo->TIPO_FRUTA}}</label></li>
                                @endif
                            @endforeach
                        </ul>
                        <li><span></span>Calidad</li>
                        <ul>
                            @foreach ($calidades as $calidad)
                                @if( $calidad->CALIDAD == $calidadSelected)
                                    <li><input onclick="this.form.submit();" type="radio" name="calidad" checked="true" value="{{ $calidad->CALIDAD}}"><label for="{{ $calidad->CALIDAD}}">{{ $calidad->CALIDAD}}</label></li>
                                @else
                                    <li><input onclick="this.form.submit();" type="radio" name="calidad" value="{{ $calidad->CALIDAD}}"><label for="{{ $calidad->CALIDAD}}">{{ $calidad->CALIDAD}}</label></li>
                                @endif
                            @endforeach
                        </ul>
                        <br>
                        <input type="submit" class="card-link btn btn-secondary" name="Limpiar" value="Limpiar">
                    </ul>
            </div>
        </div>
    <div id="page-content-wrapper">
    <div class="container-fluid">
            <div class="col" style="max-width:25rem;">
                @foreach ($ofertas as $oferta)
                    <div class="card" style="margin-bottom: 1.5rem; margin-top:1rem">
                        <img src="data:image/png;base64,{{ chunk_split(base64_encode($oferta->FOTO)) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $oferta->TIPO_FRUTA}}</h5>
                            <input type="hidden" id="tipo_fruta{{$oferta->ID}}" name="tipo_fruta{{$oferta->ID}}" value="{{ $oferta->TIPO_FRUTA}}">
                            <p class="card-text">Vendedor: {{ $oferta->NOMBRE_VENDEDOR}}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Tipo de calidad: {{ $oferta->CALIDAD}}</li>
                            <input type="hidden" id="calidad_fruta{{$oferta->ID}}" name="calidad_fruta{{$oferta->ID}}" value="{{ $oferta->CALIDAD}}">
                            <li class="list-group-item">Precio: $ {{ $oferta->PRECIO}} </li>
                            <li class="list-group-item">
                            <label for="cantidad">Cant a comprar:</label>
                            <div class="input-group">
                                <input type="number" step="0.1" class="form-control" id="cantidad{{$oferta->ID}}" name="cantidad{{$oferta->ID}}" value="1"  min="1" max="{{ $oferta->CANT_KG}}" style="max-width:30%;">
                                <div class="input-group-append">
                                    <span class="input-group-text">Kg</span>
                                </div>
                            </div>
                            (Cantidad disponible: {{ $oferta->CANT_KG}} Kg)
                            </li>
                            <input type="hidden" id="id" name="id" value="{{$oferta->ID}}">
                        </ul>
                        <div class="card-body">
                            <input type="submit" class="card-link btn btn-primary" name="Añadir{{$oferta->ID}}" value="Añadir al carro"/>
                        </div>
                    </div>    
                @endforeach
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

    <script src="js/rangoPrecios.js"></script>
    <script src="js/aparecerIcono.js"></script>
    <script src="js/submenu.js"></script>
</body>

</html>