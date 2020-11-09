
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro | Maipo Grande</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
    <link rel="stylesheet" href="css/registro.css">
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="iconos/style.css">
    <link rel="stylesheet" href="iconos/icon-cerrar/style.css">
    <script src="https://kit.fontawesome.com/5dd90ee603.js" crossorigin="anonymous"></script>
</head>

<body>
    <header id="cabecera">
        <img src="imagenes/manzana.png" class="img-logo"> 
         <h1 class="logo"> <a href="index.php" > Maipo Grande </a></h1>
        <img src="img/menu.png" class="icon-menu" id="boton-menu">
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="login">Entrar</a></li>
            </ul>
        </nav>
    </header>  
    <div class="menu-lateralResponsive" id="menu-responsive">
        <nav class="nav-responsive">
            <ul>
                <li><a href="login.html">Entrar</a></li>
                <li><a href=""><span class="icon-cart"></span></a></li>
            </ul>
        </nav>  
    </div>

    <div class="contenedor seccion contenido-centrado">
        <h2 class="centrar-texto">Registro de Comprador</h2>

        <form action="{{ route('insertarUser') }}" method="POST"  autocomplete="off" action=""> <!--Es una buena forma para trabajar con formularios, para validarlos con php o js-->
        @csrf
            <fieldset>
            <p class="font-weight-bold">Para comenzar, ingresa tus datos personales...</p>
            <div class="form-group">
                <label for="Nombre">Ingresa tu nombre</label>
            
                <div class="col-xs-4">
                    <div class="col-xs-4">
                        <input type="text" class="form-control" name=nombre placeholder="Nombre">
                </div>
                <div class="col-xs-4">
                    <input type="text" name=apellido class="form-control"  placeholder="Apellido">
                </div>
            </div>
            <div class="form-group">
                <label for="Nombre">Ingresa tu rut</label>
            
                <div class="form-row">
                    <div class="col-xs-4">
                        <input type="text" class="form-control" name=rut placeholder="Rut">
                </div>
                <div class="col-xs-2">
                    <input type="text" name=dv class="form-control"  placeholder="DV">
                </div>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">¿Que tipo de compras realizarás?</label>
                    <select class="form-control" id="exampleFormControlSelect1" name=tipocomprador>
                        <option value=3>Compras Nacionales</option>
                        <option value=4>Compras Internacionales</option>
                    </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Escoge el tipo de persona</label>
                    <select class="form-control" id="exampleFormControlSelect1" name=tipopersona>
                        <option value=3>Persona Natural</option>
                        <option value=4>Empresa</option>
                    </select>
            </div>
            <label for="Nombre">Ingresa tu nombre de fantasía</label>
            <div class="col">
                <div >
                    <input type="text" class="form-control" name=nombrefantasia placeholder="Nombre de Fantasía">
                </div>
            <div class="form-group">
                <label for="Nombre">Datos adicionales</label>
                <div class="form-row">
                    <div class="col-xs-4">
                        <input type="text" class="form-control" name=comuna placeholder="Comuna">
                    </div>
                    <div class="col-xs-4">
                        <input type="text" class="form-control" name=codigopostal  placeholder="Código Postal">
                    </div>
                    <div class="col-xs-4">
                        <input type="text" class="form-control" name=telefono  placeholder="Nro. de Teléfono">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="Nombre">Ingresa tus datos de inicio de sesión</label>
            
                <div class="col-xs-4">
                    <div class="col-xs-4">
                        <input type="text" class="form-control" name=correo placeholder="Correo">
                </div>
                <div class="col-xs-4">
                    <input type="text" name=contrasenia class="form-control"  placeholder="Contraseña">
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
                © 2019 Todos los derechos reservados | Diseñado por <a href="/"> Maipo Grande </a>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/ver_clave.js"></script>
    <script src="js/cerrarVentanita.js"></script>
</body>
</html>