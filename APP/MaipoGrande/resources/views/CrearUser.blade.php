<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear usuario | Maipo Grande</title>
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
                <li><a href="login">Entrar</a></li>
                <li><a href="administrador">Administrador</a></li>
                <li><a href="catálogo">Catálogo</a></li>
            </ul>
        </nav>
    </div>

    <div class="contenedor seccion contenido-centrado">
        <h2 class="centrar-texto">Crear Usuario</h2>
        <!--<form action="{{ route('CrearUser') }}" method="POST" autocomplete="on" action="">-->
            
            @csrf
            <fieldset>
                <p class="font-weight-bold">Ingresa los datos del nuevo usuario...</p>
                <div class="form-group">
                    <p class="font-weight-bold">Nombres</p>

                    <div class="col-xs-4">
                        <div class="col-xs-4">
                            <input type="text" class="form-control" name=nombre placeholder="Nombre" required>
                        </div>
                        <div class="col-xs-4">
                            <input type="text" name=apellido class="form-control" placeholder="Apellido" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <p class="font-weight-bold">Rut</p>

                        <div class="form-row">
                            <div class="col-xs-4">
                                <input type="number" min=1000000 max=99999999 class="form-control" name=rut placeholder="Rut" required>
                            </div>
                            <div class="col-xs-2">
                                <input type="text" name=dv class="form-control" placeholder="DV" maxlength="1" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <p class="font-weight-bold">Tipo de usuario</p>
                            <select class="form-control" id="FormComprador" name=tipocomprador required>
                                <option selected disabled value="">Seleccione perfil</option>
                                <option value=1>Administrador</option>
                                <option value=2>Vendedor</option>
                                <option value=3>Compras Nacionales</option>
                                <option value=4>Compras Internacionales</option>
                                <option value=4>Transportista</option>
                            </select>
                        </div>
                        <div class="form-group" required>
                            <p class="font-weight-bold">Seleccione el tipo de persona</p>
                            <select class="form-control" id="FormPersona" name=tipopersona required>
                                <option selected disabled value="">Seleccione tipo de persona</option>
                                <option value=1>Persona Natural</option>
                                <option value=2>Empresa</option>
                            </select>
                        </div>
                        <p class="font-weight-bold">Ingrese el nombre comercial (El mismo nombre en caso de ser persona natural) </p>
                        <div class="col-xs-2">
                            <div>
                                <input type="text" class="form-control" name=nombrefantasia placeholder="Nombre de Fantasía" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <p class="font-weight-bold">Datos adicionales</p>
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
                            <p class="font-weight-bold">Ingrese las credenciales del usuario</p>
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
                <div class="container-boton">
                    <a class="btn-login1" href="administrador"> Volver</a>
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