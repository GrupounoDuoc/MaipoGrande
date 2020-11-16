@if(!isset($_SESSION))
|   {{ session_start() }}
@endif

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicia sesión | MaipoGrande</title>
    
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Condensed" rel="stylesheet">

    <link rel="stylesheet" href="iconos/ojos-contraseña/style.css">
    <link rel="stylesheet" href="iconos/icon-cerrar/style.css">
    <link rel="stylesheet" href="iconos/style.css">

    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <header id="cabecera">
        <img src="imagenes/manzana.png" class="img-logo"> 
        <h1 class="logo"> <a href="/" > Maipo Grande </a></h1>
        <img src="imagenes/menu.png" class="icon-menu" id="boton-menu">
        <nav>
            <ul>
                <li><a href="/">Inicio</a></li>
                <li><a href="contacto">Contacto</a></li>
                <li><a href=""><span class="icon-search"></span></a></li>
            </ul>
        </nav>
    </header>  
    <div class="menu-lateralResponsive" id="menu-responsive">
        <nav class="nav-responsive">
            <ul>
                <li><a href="/">Inicio</a></li>
                <li><a href="contacto">Contacto</a></li>
                <li><a href=""><span class="icon-search"></span></a></li>
            </ul>
        </nav>  
    </div>
    
    <div class ="contenedor-login">
        <div class="login1">
            <div class="contenido-login">
                <h2>Registrate como cliente nacional</h2>
                
                <a href="registro" class="btn btn-login">Registrate</a>
            </div>
        </div>
        <div class="login1">
            <div class="contenido-login">
                <h2>Registrate como cliente internacional/proveedor</h2>
                <a href="registro" class="btn btn-login">Registrate</a>
            </div>
        </div>
    </div>

    <form action="{{ route('loguearse') }}" method="POST" autocomplete="off" class="form-login">
        @csrf
        <div class="container">
            <h2>Inicia sesión</h2>
            <div class="containe2">
                @if (isset($_SESSION['incorrecto'])) 
                    <label ><p>Datos incorrectos</p></label>
                @endif
    		    <label for="nameUser"><p>Correo Electronico:</p></label>
                <input type="email" name="emailUser" id="nameUser" placeholder="Correo electrónico" required=""> <br>
                <label for="contraseñaUser"> <p>Contraseña:</p></label>
                <div class="container con_password">
                    <img src="imagenes/eye.png" alt="" class="img-contraseña" id="mostrar">
                    <img src="imagenes/hide.png" alt="" class="img-contraseña" id="no-ver">
                    <input type="password" name="clave" id="contraseñaUser" placeholder="Introduce tu contraseña" required="">
                </div>
                <p id="recuperar">¿Olvidaste tu contraseña?</p>
                <div class="container-boton">
                    <input type="submit" name="" value="Iniciar sesión">
                </div>

                
            </div>
            <h4>¿No tienes cuenta?</h4> <a href="registro"> Regístrate aquí</a> 
            
        </div>
    </form>


    <div id="miModal" class="modal">
        <div class="flex" id="flex">
            <div class="contenido-modal">
                <div class="modal-header">
                    <span class="icon-cancel-circle" id="close-alert"></span>
                    <h2>RECUPERAR CONTRASEÑA</h2>
                </div>
                <div class="modal-body">
                    <form action="recuperarContraseña" method="POST" class="form-recuperar">
                        <p>Ingresa el correo con el que te registrarte:</p>
                        <input type="email" name="correoRecuperacion" placeholder="ejemplo@gmail.com">
                        <input type="submit" value="Enviar">
                    </form>
                </div>

            </div>
        </div>
    </div>


    
    <!-- FIN VENTANA EMERGENTE -->

    <script src="js/ver_clave.js"></script>
    <script src="js/menu.js"></script>
    <script src="js/cerrarVentanita.js"></script>
</body>
</html>