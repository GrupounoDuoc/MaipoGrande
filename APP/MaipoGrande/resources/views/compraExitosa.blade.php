@if (!isset($_SESSION))
        {{ session_start() }}
@endif

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gracias por su compra</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/compraexitosa.css">
    <!-- Foonts -->
    <link rel="stylesheet" href="iconos/style.css">
    <link rel="stylesheet" href="iconos/envio/style.css">
    <link rel="stylesheet" href="iconos/icon-cerrar/style.css">

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
    <link rel="stylesheet" href="css/carrito.css">
    
</head>
<body >


    <div class="container">
        <div class="form-row pt-5">
            <div class="card justify-content-center mx-auto col-md-10   ">
                <div class="card-header">
                    
                    <div class="float-right">Ticket generado {{\Carbon\Carbon::now('America/Santiago')}}</div>
                    <h3>¡Gracias por su compra!</h3>
                </div>
                <div class="card-body">
                    <p class="font-weight-bolder">
                    Muchas gracias por su compra. <br> Se ha generado la solicitud de compra N° {{$nCompra}}, pronto sera contactado con los siguientes pasos a seguir.
                    </p>
                </div>
                <div class="card-footer text-center">
                    <a href="/catalogo" >
                        <button class="btn btn-outline-info btn-sm">Regresar</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
<!--Footer-->
    <footer>
        <div class="contenedor" style="text-align: center;">
            <br><div class="cont-footer">
                <div class="alineacion">
                <div class="copyright">
                    © 2020 Todos los derechos reservados | Diseñado por <a href="/"> Maipo Grande@ </a>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="js/buscar.js"></script>
    <script src="js/ventanaComprar.js"></script>
    <script src="js/aparecerIcono.js"></script>
</body>
</html>