<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modificar Contrato | Maipo Grande</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/registro.css">
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="iconos/style.css">
    <link rel="stylesheet" href="iconos/estilos.css">
    <link rel="stylesheet" href="iconos/icon-cerrar/style.css">
    <script src="https://kit.fontawesome.com/5dd90ee603.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- PWA -->
    @laravelPWA

</head>

<body>
    <div id="responsive">
        <header id="cabecera">
            <img src="imagenes/manzana.png" class="img-logo">
            <h1 class="logo"> <a href="index.php"> Maipo Grande </a></h1>
            <img src="img/menu.png" class="icon-menu" id="boton-menu">
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
                <li><a href="login.html">Entrar</a></li>
                <li><a href=""><span class="icon-cart"></span></a></li>
            </ul>
        </nav>
    </div>

    <div class="contenedor seccion contenido-centrado">
        <h2 class="centrar-texto">Modificar contrato</h2>
        <form action="{{ route('ModificarContrato') }}" method="POST" autocomplete="on" action="">
            <!--Es una buena forma para trabajar con formularios, para validarlos con php o js-->
            @csrf
            <fieldset>
                <p class="font-weight-bold">Selecciona los datos para modificar contrato...</p>
                <div class="form-group">
                    <div class="form-group">
                        <div class="form-group">
                            <div class="form">
                                <select name="id_usuario" class="form-control" required>
                                    <option selected disabled value="">Selecciona un usuario</option>
                                    @foreach($usuarios as $usuario)
                                    <option value="{{ $usuario->ID_USUARIO}}">{{ $usuario->CORREO}}</option>
                                    @endforeach
                                </select>
                                <div>
                                    <br>
                                </div>
                                <div>
                                    <p class="font-weight-bold">Carga el archivo de contrato del usuario</p>
                                    <input type="file" name="contrato" id="fileToUpload">
                                </div>
                                <div>
                                    <p class="font-weight-bold">Ingresa nueva fecha de término del contrato</p>
                                    <input name="fecha_termino" type="date">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </fieldset>
            <fieldset>
                <div class="container-boton">
                    <input type="submit" name="" value="Actualizar datos">
                </div>
                <div class="container-boton">
                    <a class="btn-login1" href="ListarUsuario"> Volver</a>
                </div>
            </fieldset>
        </form>

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

    <script src="js/ver_clave.js"></script>
    <script src="js/cerrarVentanita.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>


</html>