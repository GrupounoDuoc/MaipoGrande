
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

    <div id="login">
        <h3 class="text-center text-black pt-4" style="margin-top: 2rem;">Bienvenido a Maipo Grande</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="{{ route('login') }}" method="POST" autocomplete="off">
                            @csrf
                            @if (isset($_SESSION['incorrecto'])) 
                                <label ><p>Datos incorrectos</p></label>
                            @endif
                            <h3 class="text-center text-info ">Iniciar sesion</h3>
                            <br>
                            <div class="form-group">
                                <label for="nameUser" class="text-info">Correo Electronico:</label><br>
                                <input type="text" name="emailUser" id="nameUser" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="contraseñaUser" class="text-info">Contraseña:</label><br>
                                <input type="password" name="clave" id="contraseñaUser" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="text-info"><span>Recuerdame</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Iniciar sesion">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="registro" class="text-info">Registrate aca!</a>
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