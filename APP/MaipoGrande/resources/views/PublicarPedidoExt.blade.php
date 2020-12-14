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
    <link rel="stylesheet" href="css/pedidoext.css">

    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="iconos/estilos.css">
    <link rel="stylesheet" href="iconos/icon-cerrar/style.css">
    <script src="https://kit.fontawesome.com/5dd90ee603.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- PWA -->
    @laravelPWA

</head>

<body>
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
    <br>
    <div class="container">
        <div class="form-row pt-5">
            <div class="card justify-content-center mx-auto col align-self-center">
                <div class="card-header">
            
                    <div class="float-right">Ticket generado {{\Carbon\Carbon::now('America/Santiago')}}</div>
                    <br>
                    <h3>Publicar solicitud de compra internacional</h3>
                   
                </div>
                <form action="/PublicarPedidoExt" method="POST">
                    <!--Es una buena forma para trabajar con formularios, para validarlos con php o js-->
                    @csrf
                    <fieldset>
                        <br>
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
                    <div class="card-footer">
                        <!-- <a href="/pedidos">
                            <button class="btn btn-outline-info btn-sm">Regresar a pedidos</button>
                        </a> -->
                        <div class="col-12  mx-auto text-center">
                            <button class="btn btn-primary col-sm-12 col-xs-12 col-md-2 btn-form  mx-2 my-1" type="submit" name="add" value="Añadir"><i class="far fa-plus-square"></i> Agregar</button>

                            <button class="btn btn-primary col-sm-12 col-xs-12 col-md-2 btn-form  mx-2 my-1 " type="submit" name="limpiar" value="Limpiar"><i class="fas fa-broom"></i> Limpiar</button>

                            <button class="btn btn-primary col-sm-12 col-xs-12 col-md-2 btn-form  mx-2 my-1" type="submit" name="publicar" value="Publicar"><i class="far fa-check-circle"></i> Publicar</button>

                            <button class="btn btn-danger col-sm-12 col-xs-12 col-md-2 btn-form  mx-2 my-1" type="submit" name="volver" value="Volver"><i class="fas fa-backspace"></i> Volver</button>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="contenedor">
                            <div class="d-flex p-2 justify-content-center" style="text-align: center;">
                                <div class="copyright">
                                    © 2020 Todos los derechos reservados | Diseñado por <a href="/"> Maipo Grande </a>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <!-- <div class="container p-5" style="min-height: 100vh;">
        <div class="contenedor seccion contenido-centrado">
            <h1 class="centrar-texto" style="justify-content: center; display:flex; text-align:center;">Publicar solicitud de compra internacional</h1>

            <form action="/PublicarPedidoExt" method="POST">
                Es una buena forma para trabajar con formularios, para validarlos con php o js-->
    <!-- @csrf
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
            <Registro
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
            Fin Registro
            @endforeach
            @endif
            Registro
            <div class="form-group">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <select name="tipo_fruta" class="form-control">
                            <option selected disabled>Selecciona la fruta que requieres</option>
                            @foreach($frutas as $cursorfruta)
                            <option value="{{ $cursorfruta->TIPO_FRUTA}}">{{ $cursorfruta->TIPO_FRUTA}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <select name="calidad" class="form-control">
                            <option selected disabled>Selecciona la calidad de la fruta requerida</option>
                            @foreach($calidades as $cursorcalidad)
                            <option value="{{ $cursorcalidad->CALIDAD}}">{{ $cursorcalidad->CALIDAD}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <input type="number" min=1 max=9999 class="form-control" name=cantidad placeholder="Cantidad (en KG)">
                    </div>
                    <div class="form-group col-md-4">
                        <select name="refrigerado" class="form-control" id="refrigerado">
                            <option selected disabled>¿Requiere refrigeración?</option>
                            <option value="0">No</option>
                            <option value="1">Si</option>
                        </select>
                    </div>
                </div>
            </div>
            Fin Registro
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
    </div> -->
    <!--Footer-->

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