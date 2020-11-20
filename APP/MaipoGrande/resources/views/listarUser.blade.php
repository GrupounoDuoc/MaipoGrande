<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listar usuario | Maipo Grande</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/registro.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="iconos/style.css">
    <link rel="stylesheet" href="iconos/estilos.css">
    <link rel="stylesheet" href="iconos/icon-cerrar/style.css">
    <script src="https://kit.fontawesome.com/5dd90ee603.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Container.css') }}">
    <!-- PWA -->
    @laravelPWA

</head>

<body>
    <div id="responsive">
        <header id="cabecera">
            <img src="imagenes/manzana.png" class="img-logo">
            <h1 class="logo"> <a href="index.php"> Maipo Grande </a></h1>
            <img src="imagenes/menu.png" class="icon-menu" id="boton-menu">
            <nav>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="login">Entrar</a></li>
                </ul>
            </nav>
        </header>
    </div>

    @if(session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <!--@if($errors)
    <div class="alert alert-danger" role="alert">
        Se ha producido un error al crear al usuario
    </div> -->
    @endif
    <div class="menu-lateralResponsive" id="menu-responsive">
        <nav class="nav-responsive">
            <ul>
                <li><a href="/">Inicio</a></li>
                <li><a href="login">Entrar</a></li>
                <li><a href="administrador">Administrador</a></li>
            </ul>
        </nav>
    </div>
    <div class="contenedor seccion contenido-centrado">
        <h2 class="centrar-texto">Usuarios</h2>
        <div>
            <table class="table table-dark">
                <thead>

                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Rut</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Perfil</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{$usuario->ID_USUARIO}}</td>
                        <td>{{$usuario->RUT}}</td>
                        <td>{{$usuario->NOMBRE}}</td>
                        <td>{{$usuario->APELLIDO}}</td>
                        <td>{{$usuario->CORREO}}</td>
                        <td>
                            @if( $usuario->ID_PERFIL == 1)
                            <b>
                                Administrador
                            </b>
                            @elseif( $usuario->ID_PERFIL == 2)
                            <b>
                                Vendedor
                            </b>
                            @elseif( $usuario->ID_PERFIL == 3)
                            <b>
                                Comprador interno
                            </b>
                            @elseif( $usuario->ID_PERFIL == 4)
                            <b>
                                Comprador externo
                            </b>
                            @elseif( $usuario->ID_PERFIL == 5)
                            <b>
                                Transportista
                            </b>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <!--Footer-->
    <footer class="footer2">
        <div class="contenedor">
            <div class="d-flex p-2 justify-content-center">
                <div class="copyright">
                    © 2020 Todos los derechos reservados | Diseñado por <a href="/"> Maipo Grande </a>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/buscar.js"></script>
    <script src="js/menu.js"></script>
    <script src="js/aparecerIcono.js"></script>
    <script src="js/ver_clave.js"></script>
    <script src="js/cerrarVentanita.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>


</html>