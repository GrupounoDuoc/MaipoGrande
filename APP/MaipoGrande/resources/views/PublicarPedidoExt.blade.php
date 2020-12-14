@if(!isset($_SESSION))
| {{ session_start() }}
@endif
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Publicar pedido Externo | Maipo Grande</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/registro.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="iconos/estilos.css">
    <link rel="stylesheet" href="iconos/icon-cerrar/style.css">
    <script src="https://kit.fontawesome.com/5dd90ee603.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
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
    @if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
    @endif
    <div class="container" style="min-height: 100vh;">
        <div class="contenedor seccion contenido-centrado">
            <h1 class="centrar-texto" style="justify-content: center; display:flex; text-align:center;">Publicar solicitud de compra internacional</h1>

            <form action="/PublicarPedidoExt" method="POST">
                <!--Es una buena forma para trabajar con formularios, para validarlos con php o js-->
                @csrf
                <fieldset>
                    <p class="font-weight-bold" style="justify-content: center; display:flex;">Ingresa los datos de tu solicitud...</p>
                    <br>
                    <select name="metodo_viaje" class="form-control">
                        @if($metodoViajeSelected == null)
                        <option selected disabled value="">Metodo de viaje a utilizar</option>
                        <option value="air">Aereo</option>
                        <option value="sea">Maritimo</option>
                        <option value="ear">Terrestre</option>
                        @else
                        @if($metodoViajeSelected == 'air')
                        <option selected value="air">Aereo</option>
                        @else
                        <option value="air">Aereo</option>
                        @endif
                        @if($metodoViajeSelected == 'sea')
                        <option selected value="sea">Maritimo</option>
                        @else
                        <option value="sea">Maritimo</option>
                        @endif
                        @if($metodoViajeSelected == 'ear')
                        <option selected value="ear">Terrestre</option>
                        @else
                        <option value="ear">Terrestre</option>
                        @endif
                        @endif
                    </select>
                    <hr>
                    <div class="form-group">
                        @if(isset($_SESSION['pedidoExt']))
                        @foreach($_SESSION['pedidoExt'] as $key=>$row)
                        <!--Registro-->
                        <div class="form-group">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <select name="tipo_fruta{{$key}}" class="form-control">
                                        @if(isset($row['tipo_fruta']))
                                        @foreach($frutas as $cursorfruta)
                                        @if($row['tipo_fruta'] == $cursorfruta->TIPO_FRUTA)
                                        <option selected value="{{ $cursorfruta->TIPO_FRUTA}}">{{ $cursorfruta->TIPO_FRUTA}}</option>
                                        @else
                                        <option value="{{ $cursorfruta->TIPO_FRUTA}}">{{ $cursorfruta->TIPO_FRUTA}}</option>
                                        @endif
                                        @endforeach
                                        @else
                                        <option selected disabled value="">Selecciona la fruta que requieres</option>
                                        @foreach($frutas as $cursorfruta)
                                        <option value="{{ $cursorfruta->TIPO_FRUTA}}">{{ $cursorfruta->TIPO_FRUTA}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <select name="calidad{{$key}}" class="form-control">
                                        @if(isset($row['calidad']))
                                        @foreach($calidades as $cursorcalidad)
                                        @if($row['calidad'] == $cursorcalidad->CALIDAD)
                                        <option selected value="{{ $cursorcalidad->CALIDAD}}">{{ $cursorcalidad->CALIDAD}}</option>
                                        @else
                                        <option value="{{ $cursorcalidad->CALIDAD}}">{{ $cursorcalidad->CALIDAD}}</option>
                                        @endif
                                        @endforeach
                                        @else
                                        <option selected disabled value="">Selecciona la calidad de la fruta requerida</option>
                                        @foreach($calidades as $cursorcalidad)
                                        <option value="{{ $cursorcalidad->CALIDAD}}">{{ $cursorcalidad->CALIDAD}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    @if(isset($row['cantidad']))
                                    <input type="number" min=1 max=9999 class="form-control" value="{{$row['cantidad']}}" name="cantidad{{$key}}" placeholder="Cantidad (en KG)">
                                    @else
                                    <input type="number" min=1 max=9999 class="form-control" name="cantidad{{$key}}" placeholder="Cantidad (en KG)">
                                    @endif
                                </div>
                                <div class="form-group col-md-3">
                                    <select name="refrigerado{{$key}}" class="form-control">
                                        @if(!isset($row['refrigerado']))
                                        <option selected disabled value="">¿Requiere refrigeración?</option>
                                        <option value="0">No</option>
                                        <option value="1">Si</option>
                                        @else
                                        @if($row['refrigerado'] == 0)
                                        <option selected value="0">No</option>
                                        @else
                                        <option value="0">No</option>
                                        @endif
                                        @if($row['refrigerado'] == 1)
                                        <option selected value="0">No</option>
                                        @else
                                        <option value="1">Si</option>
                                        @endif
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!--Fin Registro-->
                        @endforeach
                        @endif
                        <!--Registro-->
                        <div class="form-group">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <select name="tipo_fruta" class="form-control">
                                        <option selected disabled>Selecciona la fruta que requieres</option>
                                        @foreach($frutas as $cursorfruta)
                                        <option value="{{ $cursorfruta->TIPO_FRUTA}}">{{ $cursorfruta->TIPO_FRUTA}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <select name="calidad" class="form-control">
                                        <option selected disabled>Selecciona la calidad de la fruta requerida</option>
                                        @foreach($calidades as $cursorcalidad)
                                        <option value="{{ $cursorcalidad->CALIDAD}}">{{ $cursorcalidad->CALIDAD}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="number" min=1 max=9999 class="form-control" name=cantidad placeholder="Cantidad (en KG)">
                                </div>
                                <div class="form-group col-md-3">
                                    <select name="refrigerado" class="form-control" id="refrigerado">
                                        <option selected disabled>¿Requiere refrigeración?</option>
                                        <option value="0">No</option>
                                        <option value="1">Si</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--Fin Registro-->
                    </div>
                </fieldset>
                <fieldset>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <input class="btn btn-primary btn-block" type="submit" name="add" value="Actualizar / Añadir nuevo producto">
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <input class="btn btn-secondary btn-block" type="submit" name="limpiar" value="Limpiar formulario">
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <input class="btn btn-success btn-block" type="submit" name="publicar" value="Publicar">
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <input class="btn btn-danger btn-block" type="submit" name="volver" value="Volver">
                        </div>
                    </div>
                </fieldset>
            </form>

            <fieldset>
                <div class="container-boton" style="justify-content: center; display:flex;">

                </div>
            </fieldset>
        </div>
        <!--Footer-->
        <footer>
            <div class="contenedor">
                <div class="d-flex p-2 justify-content-center" style="text-align: center;">
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