<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Publicar pedido | Maipo Grande</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/registro.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="iconos/estilos.css">
    <link rel="stylesheet" href="iconos/icon-cerrar/style.css">
    <script src="https://kit.fontawesome.com/5dd90ee603.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
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
                <?php
                if (empty($_SESSION['datos'])) { ?>
                    <li><a href="/">Inicio</a></li>

                <?php } else { ?>
                    <li><a href="/">Inicio</a></li>
                    <li class="li-perfilUsuario">
                        <img src="imagenes/usuario.png" class="img-usuario" id="img-perfil">
                    </li>

                <?php } ?>
            </ul>
            <?php if (isset($_SESSION['objetoNoEncontrado'])) { ?>
                <h3 class="errorBusqueda" id="messageError"><?php echo $_SESSION['objetoNoEncontrado'] ?></h3>
            <?php unset($_SESSION['objetoNoEncontrado']);
            } ?>
        </nav>
    </header>
    <div class="menu-lateralResponsive" id="menu-responsive">
        <nav class="nav-responsive">
            <ul>
                <?php
                if (empty($_SESSION['datos'])) { ?>

                    <!--<li><a href="login.php?url=<?php echo $_SERVER["REQUEST_URI"] ?>">Entrar</a></li> 
                    <li><a href="registro">Registrarse</a></li> -->
                    <li><a href="/">Inicio</a></li>
                    <li><a href="login">Entrar</a></li>
                    <li><a href="catalogo">Catálogo</a></li>
                    <ul class="subMenu-usuario" id="submenu-perfil">
                        <li><a href="php/validarUsuario.php">Perfil</a></li>
                        <li><a href="php/cerrar.php">Cerrar sesión</a></li>
                    </ul>
                <?php } else { ?>
                    <li><a href=""><span class="icon-search"></span></a></li>
                    <li class="li-perfilUsuario">
                        <img src="imagenes/usuario.png" class="img-usuario" id="img-perfil">
                    </li>
                    <li><a href="catalogo">Catálogo</a></li>
                    <li><a href="maipogrande.html">Calidad Fruta</a></li>
                    <ul class="subMenu-usuario" id="submenu-perfil">
                        <li><a href="php/validarUsuario.php">Perfil</a></li>
                        <li><a href="php/cerrar.php">Cerrar sesión</a></li>
                    </ul>
                <?php } ?>
            </ul>
        </nav>
    </div>
    @if(session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <div class="contenedor seccion contenido-centrado">
        <h1 class="centrar-texto">Publicar pedido</h1>

        <form action="{{ route('PublicarVenta') }}" method="POST" autocomplete="on" action="">
            <!--Es una buena forma para trabajar con formularios, para validarlos con php o js-->
            @csrf
            <fieldset>
                <p class="font-weight-bold">Ingresa los datos de tu publicación...</p>
                <div class="form-group">

                    @if (isset($_SESSION['id_usuario']))
                    <input id="prodId" name="id_vendedor" type="hidden" value="{{$_SESSION['id_usuario']}}">
                    @endif

                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <select name="tipo_fruta" class="form-control" required>
                                    <option selected disabled value="">Selecciona la fruta que venderás</option>
                                    @foreach($frutas as $cursorfruta)
                                    <option value="{{ $cursorfruta->ID_TIPO_FRUTA}}">{{ $cursorfruta->TIPO_FRUTA}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <select name="calidad" class="form-control" required>
                                    <option selected disabled value="">Selecciona la calidad de la fruta</option>
                                    @foreach($calidades as $cursorcalidad)
                                    <option value="{{ $cursorcalidad->ID_CALIDAD}}">{{ $cursorcalidad->CALIDAD}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <input type="number" min=1 max=9999 class="form-control" name=cantidad placeholder="Cantidad (en KG)" required>
                            </div>
                            <div class="form-group col-md-4">
                                <input type="number" min=1 max=9999 class="form-control" name=precioxkg placeholder="Precio por KG" required>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>



    <fieldset>
        <div class="container-boton">
            <input type="submit" name="" value="Publicar">
        </div>
    </fieldset>
    </form>
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