<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro | Maipo Grande</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/registro.css">
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="iconos/icon-cerrar/style.css">
    <script src="https://kit.fontawesome.com/5dd90ee603.js" crossorigin="anonymous"></script>
    <!-- PWA -->
    @laravelPWA

</head>

<body>

<header id="cabecera">

        <img src="imagenes/manzana.png" class="img-logo" >
        
        <h2 class="logo">Maipo Grande</h2>
        <img src="imagenes/menu.png" class="icon-menu" id="boton-menu">
        <nav>
            <ul id="lista-principal">
                <?php
                if (empty($_SESSION['datos'])) { ?>
                    <li><a href="/">Inicio</a></li>
                    <li><a href="administrador">Administrador</a></li>

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
                    <li><a href="administrador">Administrador</a></li>
                    <li><a href="catalogo">Catálogo</a></li>
                    <li><a href="maipogrande.html">Calidad Fruta</a></li>
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
        <h1 class="centrar-texto">Registro de Comprador</h1>

        <form action="{{ route('insertarUser') }}" method="POST" autocomplete="on" action="">
            <!--Es una buena forma para trabajar con formularios, para validarlos con php o js-->
            @csrf
            <fieldset>
                <p class="font-weight-bold">Para comenzar, ingresa tus datos personales...</p>
                <div class="form-group">
                    <label for="Nombre">Ingresa tu nombre</label>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" name=nombre placeholder="Nombre" required>
                            <div class="valid-feedback">
                                Nombre Correcto!
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <input type="text" name=apellido class="form-control" placeholder="Apellido" required>
                        </div>

                    <div class="form-group">
                        <label for="rut">Ingresa tu rut</label>

                        <div class="form-row">
                            <div class="col-md-10 mb-2">
                                <input type="number" min=1000000 max=99999999 class="form-control" name=rut placeholder="Rut" required>
                            </div>
                            <div class="col-md-2">
                                <input type="text" name=dv class="form-control" placeholder="DV" maxlength="1" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">¿Que tipo de compras realizarás?</label>
                            <select class="form-control" id="FormComprador" name=tipocomprador required>
                                <option value=3>Compras Nacionales</option>
                                <option value=4>Compras Internacionales</option>
                            </select>
                        </div>
                        <div class="form-group" required>
                            <label for="exampleFormControlSelect1">Escoge el tipo de persona</label>
                            <select class="form-control" id="FormPersona" name=tipopersona required>
                                <option value=1>Persona Natural</option>
                                <option value=2>Empresa</option>
                            </select>
                        </div>
                        <label for="NombreFantasia">Ingresa tu nombre de fantasía</label>
                        <div class="col-xs-4">
                            <div>
                                <input type="text" class="form-control" name=nombrefantasia placeholder="Nombre de Fantasía" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Nombre">Datos adicionales</label>
                            <div class="form">
                                <select name="comuna" class="form-control" required>
                                    <option selected disabled value="">Selecciona una comuna</option>
                                    @foreach($comunas as $cursorcomuna)
                                    <option value="{{ $cursorcomuna->ID}}">{{ $cursorcomuna->NOMBRECOMUNA}}</option>
                                    @endforeach
                                </select>
                                <div>
                                    <br>
                                </div>
                                <div class="col-xs-4">
                                    <input type="text" class="form-control" name=codigopostal maxlength="7" placeholder="Código Postal" required>
                                </div>
                                <div class="col-xs-4">
                                    <input type="text" class="form-control" name=telefono placeholder="Nro. de Teléfono" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Nombre">Ingresa tus datos de inicio de sesión</label>

                            <div class="col-xs-4">
                                <div class="col-xs-4">
                                    <input type="mail" class="form-control" name=correo placeholder="Correo" required>
                                </div>
                                <div class="col-xs-4">
                                    <input type="password" name=contrasenia class="form-control" placeholder="Contraseña" required>
                                </div>
                            </div>

            </fieldset>
            <fieldset>
                <div class="container-boton">
                    <input type="submit" name="" value="Registrarse">
                </div>
                <div class="texto-login">
                    <h4 class="texto-registro">¿Ya estás registrado?</h4>
                    <a class="btn-login1" href="login.php"> Inicia sesión</a>
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