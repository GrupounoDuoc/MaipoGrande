<?php session_start(); ?>
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
    <link rel="stylesheet" href="iconos/estilos.css">
    <link rel="stylesheet" href="iconos/icon-cerrar/style.css">
    <script src="https://kit.fontawesome.com/5dd90ee603.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
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
                <li class="nav-item active">
                    <a class="nav-link" href="catalogo"> Catalogo <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="maipogrande">Calidad Fruta</a>
                </li>
            </ul>
        </div>
    </nav>


    <!--
    <div class="contenedor seccion contenido-centrado">
        <h1 class="centrar-texto">Registro de Comprador</h1>

        <form action="{{ route('insertarUser') }}" method="POST" autocomplete="on" action="">

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
                        <div class="form-group col-12" required>
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
-->

        <div id="register">
            <h3 class="text-center text-black pt-4">Bienvenido a Maipo Grande</h3>
            <div class="container">
                <div id="register-row" class="row justify-content-center align-items-center">
                    <div id="register-column" class="col-md-6">
                        <div id="register-box" class="col-md-12">
                            <form id="register-form" class="form" action="{{ route('insertarUser') }}" method="POST" autocomplete="off">
                            @csrf
                                <h3 class="text-center text-info ">Registro de comprador</h3>
                                <div class="form-group">
                                    <label for="nameUser" class="text-info">Nombre:</label><br>
                                    <input type="text" name="nombre" id="nameUser" class="form-control" placeholder="Ingresa tu nombre . . ." required>
                                </div>
                                <div class="form-group">
                                    <label for="contraseñaUser" class="text-info">Apellido:</label><br>
                                    <input type="text" name="apellido" id="contraseñaUser" class="form-control" placeholder="Ingresa tu apellido . . ." required>
                                </div>
                                <div class="form-group">
                                <label for="rutUser" class="text-info">Rut:</label><br>
                                    <div class="row">    
                                        <div class="col-8">
                                            <input type="number" name="rut" type="number" min=1000000 max=99999999 id="rutUser" class="form-control" placeholder="Ingresa tu rut . . ." required>
                                        </div>
                                        <div class="col-1 d-flex justify-content-center align-items-center">
                                            <div>-</div>
                                        </div>
                                        <div class="col-3">
                                            <input type="text" name=dv class="form-control" placeholder="DV" maxlength="1" required>
                                        </div>        
                                     </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">¿Que tipo de compras realizarás?</label>
                                    <select class="form-control" id="FormComprador" name=tipocomprador required>
                                        <option value=3>Compras Nacionales</option>
                                        <option value=4>Compras Internacionales</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Escoge el tipo de persona</label>
                                    <select class="form-control" id="FormPersona" name=tipopersona required>
                                        <option value=1>Persona Natural</option>
                                        <option value=2>Empresa</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="contraseñaUser" class="text-info">Nombre de fantasia:</label><br>
                                    <input type="text" name="clave" id="contraseñaUser" class="form-control" placeholder="Ingresa tu apodo . . ." required>
                                </div>
                                <div class="form-group">
                                    <label for="Nombre">Datos adicionales</label>
                                    <select name="comuna" class="form-control" required>
                                            <option selected disabled value="">Selecciona una comuna</option>
                                            @foreach($comunas as $cursorcomuna)
                                            <option value="{{ $cursorcomuna->ID}}">{{ $cursorcomuna->NOMBRECOMUNA}}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="contraseñaUser" class="text-info">Codigo postal:</label><br>
                                    <input type="number" name=codigopostal maxlength="7" id="contraseñaUser"  class="form-control" placeholder="Digite el codigo . . ." required>
                                </div>
                                <div class="form-group">
                                    <label for="contraseñaUser" class="text-info">Numero de telefono:</label><br>
                                    <input type="number" name="telefono" id="contraseñaUser" class="form-control" placeholder="Nro. de Telefono . . ." required>
                                </div>

                                <label for="Nombre">Ingresa tus datos de inicio de sesión</label>
                                <div class="form-group">
                                    <label for="contraseñaUser" class="text-info">Correo:</label><br>
                                    <input type="text" name="correo" id="contraseñaUser" class="form-control" placeholder="Ingrese su correo . . ." required>
                                </div>
                                <div class="form-group">
                                    <label for="contraseñaUser" class="text-info">Contraseña:</label><br>
                                    <input type="password" name="contrasenia" id="contraseñaUser" class="form-control" placeholder="Ingresa tu contraseña . . ." required>
                                </div>

                                <fieldset class="row d-flex justify-content-center">
                                    <div class="form-group col-12 text-center">
                                        <input type="submit" name="" value="Registrarse" class="btn btn-info btn-md" style="margin-top: 5px;">
                                    </div>
                                    <div class="form-group col-12">
                                        <h4 class="texto-registro" style="text-align: center;">¿Ya estás registrado?</h4><br>
                                    </div>
                                    <div class="form-group col-12 text-center">
                                        <a class="btn btn-primary btn-md" href="login"> Inicia sesión</a>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    <br>
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