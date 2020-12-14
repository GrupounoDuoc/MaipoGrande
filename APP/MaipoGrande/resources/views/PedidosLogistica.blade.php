@laravelPWA

<?php
if (!isset($_SESSION)) {
    session_start();
}
?>


<title> Panel Transportista | Maipo Grande</title>
<!-- Font family-->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&display=swap" rel="stylesheet">



<!-- Font Awesome Icons -->
<link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../dist/css/adminlte.min.css">
<!-- Google Font: Source Sans Pro -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=Montserrat:ital,wght@0,400;0,500;0,900;1,500;1,700;1,800&display=swap" rel="stylesheet">

<!-- Sweet alert--->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js">

<!-- material icons google -->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">



<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <img src="imagenes/manzana.png" style="height:1.25rem; margin-right:0.8rem">
    <a class="navbar-brand" href="/">Maipo Grande</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        </ul>
    </div>
</nav>

<div class="contenedor">
    <br>
    <h2>Pedidos en logística</h2>
    <br>

    @if(Session::has('message'))
    <div class="alert alert-{{ Session::get('type') }} alert-dismissable fade show text-center" role="alert">
        {{ Session::get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif


    <form action="postulartr" id="postulartransporteform" method="POST">
        @csrf
        <div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id Pedido</th>
                        <th scope="col">Correo Solicitante</th>
                        <th scope="col">Medio de transporte</th>
                        <th scope="col">Refrigeración</th>
                        <th scope="col">Peso Máx.</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <div class="container">
                        @foreach($Disponibles as $key => $VentasDisponibles)
                        <tr>
                            <td>{{$VentasDisponibles->ID_PEDIDO}}</td>
                            <td>{{$VentasDisponibles->CORREO_COMPRADOR}}</td>
                            <td>{{$VentasDisponibles->METODO_VIAJE}}</td>
                            <td>{{$VentasDisponibles->REFRIGERADO}}</td>
                            <td>{{$VentasDisponibles->CANT_KG_TOTAL}}</td>
                            <td>{{$VentasDisponibles->ESTADO}}</td>
                            <td>
                                <input class="btn btn-success my-2 my-sm-0" type="submit" name="Postular{{$VentasDisponibles->ID_PEDIDO}}" value="Postular">
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </form>
</div>






<div class="contenedor">
    <br>
    <h2>Pedidos históricos</h2>
    <br>

    @if(Session::has('message'))
    <div class="alert alert-{{ Session::get('type') }} alert-dismissable fade show text-center" role="alert">
        {{ Session::get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif



    <form action="{{ route('ActualizarEstado') }}" id="actualizarForm" method="POST">
        @csrf
        <div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id Pedido</th>
                        <th scope="col">Correo Solicitante</th>
                        <th scope="col">Medio de transporte</th>
                        <th scope="col">Refrigeración</th>
                        <th scope="col">Peso Máx.</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <div class="container">
                        @foreach($Historicos as $key => $vHistorico)
                        <tr>
                            <td>{{$vHistorico->ID_PEDIDO}}</td>
                            <td>{{$vHistorico->CORREO_COMPRADOR}}</td>
                            <td>{{$vHistorico->METODO_VIAJE}}</td>
                            <td>{{$vHistorico->REFRIGERADO}}</td>
                            <td>{{$vHistorico->CANT_KG_TOTAL}}</td>
                            <td>{{$vHistorico->ESTADO}}</td>
                            <td>
                                Actualizar Estado
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
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