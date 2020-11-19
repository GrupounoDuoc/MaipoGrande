
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicia sesión | MaipoGrande</title>
    
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Condensed" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="iconos/estilos.css">
    <link rel="stylesheet" href="iconos/icon-cerrar/style.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Condensed" rel="stylesheet">

    <link rel="stylesheet" href="iconos/ojos-contraseña/style.css">
    <link rel="stylesheet" href="iconos/icon-cerrar/style.css">
    <link rel="stylesheet" href="iconos/style.css">

    <link rel="stylesheet" href="css/login.css">
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


    <form action="{{ route('login') }}" method="POST" autocomplete="off" class="form-login">
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


<!--
    <body class="my-login-page">
        <section class="h-100">   
            <div class="container h-100">
                @if (isset($_SESSION['incorrecto'])) 
                    <label ><p>Datos incorrectos</p></label>
                @endif
                <div class="row justify-content-md-center h-100">
                    <div class="card-wrapper">
                        <div class="brand">
                            <img src="images/icon-192x192.png" alt="logo">
                        </div>
                        <div class="card fat">
                            <div class="card-body">
                                <h4 class="card-title">Inicio de sesion</h4>
                                <form action="{{ route('login') }}" method="POST" autocomplete="off" class="form-login" novalidate=""> < my-login-validation 
                                    <div class="form-group">
                                        <label for="email">E-Mail Address</label>
                                        <input id="email" type="email" class="form-control" name="emailUser" value="" required autofocus>
                                        <div class="invalid-feedback">
                                            Email incorrecto
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Contraseña
                                            <a href="forgot.html" class="float-right">
                                                Olvido contraseña
                                            </a>
                                        </label>
                                        <input id="password" type="password" class="form-control" name="clave" required data-eye>
                                        <div class="invalid-feedback">
                                            Contraseña requerida
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" name="remember" id="remember" class="custom-control-input">
                                            <label for="remember" class="custom-control-label">Recuerdame</label>
                                        </div>
                                    </div>

                                    <div class="form-group m-0">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            Iniciar Sesion
                                        </button>
                                    </div>
                                    <div class="mt-4 text-center">
                                        No tienes cuenta? <a href="register.html">Registrate aca!</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="footer">
                            Copyright &copy; 2020 &mdash; Maipo Grande
                        </div>
                    </div>
                </div>
            </div>
            </form>  
        </section>

-->


    
    <!-- FIN VENTANA EMERGENTE -->

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>


    <script src="js/ver_clave.js"></script>
    <script src="js/menu.js"></script>
    <script src="js/cerrarVentanita.js"></script>
</body>
</html>