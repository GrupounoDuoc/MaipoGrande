@if (!isset($_SESSION))
{{ session_start() }}
@endif

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gracias por postular</title>
    <link rel="stylesheet" href="css/bootstrap.css">

    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- Foonts -->
    <link rel="stylesheet" href="iconos/style.css">
    <link rel="stylesheet" href="iconos/envio/style.css">
    <link rel="stylesheet" href="iconos/icon-cerrar/style.css">
    <link rel="stylesheet" href="css/postulacion.css">

    <!-- Slider -->
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.nivo.slider.js"></script>
    <link rel="stylesheet" type="text/css" href="css/nivo-slider.css">
    <link rel="stylesheet" type="text/css" href="css/mi-slider.css">
    <script type="text/javascript">
        $(window).on('load', function() {
            $('#slider').nivoSlider();
        });
    </script>

    <!--footer-->
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/bootstrap.css">

    <!-- Foonts -->
    <link href="https://fonts.googleapis.com/css?family=Gugi" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Heebo" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Condensed" rel="stylesheet">

    <!--carrito de compras-->
   

</head>

<body>

    <div class="container">
        <div class="form-row pt-5">
            <div class="card justify-content-center mx-auto col-md-10   ">
                <div class="card-header">
                    <div class="float-right">Ticket generado {{\Carbon\Carbon::now('America/Santiago')}}</div>
                    @if($postulacion != null)
                    <h3>Postulacion realizada</h3>
                    <hr>
                </div>
                <div class="card-body">
                    <p class="font-weight-bolder">
                        Se ha recibido la postulacion! <br> La postulacion para el pedido N°{{$idPedidoPostulacion}}, con el siguiente correlativo: {{$postulacion}}
                    </p>
                </div>
                @else
                <h3>Postulacion Erronea</h3>
                <hr>
                <div class="card-body">
                    <p class="font-weight-bolder">
                        No se recibido la postulacion! <br> No se ha podido realizar la postulacion al pedido N°{{$idPedidoPostulacion}}
                    </p>
                </div>
                @endif
                <div class="card-footer text-center">
                    <a href="/pedidos">
                        <button class="btn btn-outline-info btn-sm">Regresar a pedidos</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- @if($postulacion != null)
    <h1>Postulacion realizada</h1>
    <h3>Se recibio la postulacion para el pedido N°{{$idPedidoPostulacion}}, con el siguiente correlativo: {{$postulacion}}</h3>
    @else
    <h1>Postulacion erronea</h1>
    <h3>No se ha podido realizar la postulacion al pedido N°{{$idPedidoPostulacion}}</h3>
    @endif
    <a href="/pedidos">Volver al inicio</a> -->
    <!--Footer-->
    <footer>
        <div class="contenedor text-center">
            <br>
            <div class="cont-footer">
                <div class="alineacion">
                    <div class="copyright">
                        © 2019 Todos los derechos reservados | Diseñado por <a href="/"> Maipo Grande@ </a>
                    </div>
                </div>
            </div>
    </footer>

    <script src="js/buscar.js"></script>
    <script src="js/ventanaComprar.js"></script>
    <script src="js/aparecerIcono.js"></script>
</body>

</html>