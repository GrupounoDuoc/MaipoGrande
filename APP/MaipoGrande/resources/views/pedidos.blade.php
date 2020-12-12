@if(!isset($_SESSION))
| {{ session_start() }}
@endif

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pedidos de subastas</title>
    <link href="../public/css/simple-sidebar.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/header-footer.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="iconos/style.css">
    <link rel="stylesheet" href="css/catalogo.css">
    <!-- PWA -->
    @laravelPWA
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
            <li><a href="pedidos">Pedidos</a></li>
            <ul class="subMenu-usuario" id="submenu-perfil">
                <li><a href="">Perfil</a></li>
                <li><a href="logout">Cerrar sesión</a></li>
                <li><a href="PublicarProducto">Publicar producto</a></li>
            </ul>

        </ul>
    </div>
    <div class="menu-lateralResponsive" id="menu-responsive">
        <nav class="nav-responsive">
            <ul>
                @if (empty($_SESSION['usuario']))

                <li><a href="login">Entrar</a></li>
                <li><a href="registro">Registrarse</a></li>
                <li><a href="administrador">Administrador</a></li>
                <li><a href="maipogrande.html">Calidad Fruta</a></li>
                <ul class="subMenu-usuario" id="submenu-perfil">
                    <li><a href="">Perfil</a></li>
                    <li><a href="logout">Cerrar sesión</a></li>
                </ul>
                <li class="li-perfilUsuario">
                    <img src="imagenes/usuario.png" class="img-usuario" id="img-perfil">
                </li>
                <li><a href="maipogrande.html">Pedidos</a></li>
                <ul class="subMenu-usuario" id="submenu-perfil">
                    <li><a href="">Perfil</a></li>
                    <li><a href="logout">Cerrar sesión</a></li>
                </ul>
                @endif
            </ul>
        </nav>
    </div>
    @if(isset($_SESSION['status']))
    <div class="alert alert-danger" role="alert">
        {{ $_SESSION['status'] }}
    </div>
    @endif

    <form action="/pedidos" method="POST">
        @csrf
        <div class="container-fluid" style="min-height: 100vh;">
            <div class="row">
                <div class="col-lg-3 p-5">
                        <h3>Filtros pedidos</h3>
                        <hr>
                        <h4>Estado de pedidos</h4>
                        @foreach ($estados as $estado)
                            <div class="form-check">
                                <input class="form-check-input" onclick="this.form.submit();" type="radio" name="estado" value="{{ $estado->NOMBRE}}" @if( $estado->NOMBRE == $estadoFiltroSelected)checked @endif>
                                <label class="form-check-label" for="{{ $estado->NOMBRE}}">{{ ucfirst(strtolower($estado->NOMBRE))}}
                                </label>
                            </div>
                        @endforeach
                        <hr>

                        <h4>Rango de fecha</h4>
                        <div class="form-group">
                            <label for="fechaInicio">Fecha desde</label>
                            <input onchange="this.form.submit();" type="date" id="fechaInicio" name="fechaInicio" value="{{$fechaInicioSelected}}" min="2000/01/01" max="{{date('d/m/Y h:i:s')}}" class="form-control">

                        </div>

                        <div class="form-group">
                            <label for="fechaFin">Fecha hasta</label>
                            <input onchange="this.form.submit();" type="date" id="fechaFin" name="fechaFin" value="{{$fechaFinSelected}}" min="2000/01/01" max="{{date('d/m/Y h:i:s')}}" class="form-control">

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="submit" class="btn btn-secondary btn-block" name="Limpiar" value="Limpiar">
                            </div>
                            <div class="col-md-6">
                                @if($_SESSION['tipo_usuario'] == 4)
                                <button onclick="this.form.submit();" name="crearPedido" class="btn btn-success btn-block">Crear pedido</button>
                                <!-- <input type="submit" name="crearPedido" value="Crear nuevo pedido"> -->
                                @endif
                            </div>
                        </div>

                    
                </div>
                <div class="col-md-9 p-5">
                    @foreach ($pedidos as $pedido)
                    <div class="card" style="margin-bottom: 1.5rem; margin-top:1rem">
                        <div class="card-body">
                            <h5 class="card-title">Comprador: {{ $pedido->NOMBRE_COMPRADOR}}</h5>
                            <p class="card-text">Fecha publicacion: {{ $pedido->FECHA}}</p>
                            <p class="card-text">Estado: {{ ucfirst(strtolower($pedido->ESTADO))}}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <input type="hidden" id="id" name="id" value="{{$pedido->ID}}">
                        </ul>
                        <div class="card-body">
                            <input type="submit" class="card-link btn btn-secondary" name="detalle{{$pedido->ID}}" value="Ver detalles" />
                            @if($_SESSION['tipo_usuario'] == 4 && ($pedido->ESTADO == 'DESPACHO' || $pedido->ESTADO == 'ENTREGADO'))
                            <input type="submit" class="card-link btn btn-secondary" name="seguimiento{{$pedido->ID}}" value="Seguimiento" />
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </form>
    <footer class="page-footer font-small" style="width: 100%; height: 140px;">

        <br>
        <div class="cont-footer" style="text-align: center; display:flex;">
            <div class="alineacion">
                <br>
                <div class="copyright">
                    © 2020 Todos los derechos reservados | Diseñado por <a href="/"> Maipo Grande </a>
                </div>
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