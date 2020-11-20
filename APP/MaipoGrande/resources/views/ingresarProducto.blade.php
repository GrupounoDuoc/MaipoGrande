<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ingresar Producto | Maipo Grande</title>
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
        <h2 class="centrar-texto">Ingresar producto</h2>
        <form action="{{ route('IngresarProducto') }}" method="POST" autocomplete="on" action="">
            <!--Es una buena forma para trabajar con formularios, para validarlos con php o js-->
            @csrf
            <fieldset>
                <p class="font-weight-bold">Ingresa los datos del nuevo Producto...</p>
                <div class="form-group">
                    <div class="col-xs-4">
                        <div class="col-xs-4">
                            <input type="text" class="form-control" name=nombreFruta placeholder="Nombre" required>
                        </div>
                        <div class="col-xs-4">
                            <textarea name="descripcion" rows="5" cols="10" placeholder="Ingresa aquí la descripción del nuevo producto" maxlength="150"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <p class="font-weight-bold">Carga la imagen del producto</p>
                    </div>
                    <div class="ml-2 col-sm-6">
                        <div id="msg"></div>
                            <input type="file" name="imagen" class="file" accept="image/*">
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="container-boton">
                    <input type="submit" name="" value="Ingresar">
                </div>
                <div class="container-boton">
                    <a class="btn-login1" href="administrador"> Volver</a>
                </div>
            </fieldset>
        </form>

    </div>

    <!--Footer-->
    <footer class="footer">
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