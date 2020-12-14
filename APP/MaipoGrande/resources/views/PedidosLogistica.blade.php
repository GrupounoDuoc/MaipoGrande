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


<link rel="stylesheet" href="css/logistica.css">
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

@if(Session::has('message'))
<div class="alert alert-{{ Session::get('type') }} alert-dismissable fade show text-center" role="alert">
    {{ Session::get('message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="container">
    <div class="container my-5">
        <br>
        <h2>Pedidos en logística</h2>
        <hr>
        <form action="postulartr" id="postulartransporteform" method="POST">
            @csrf
            <div class="table-responsive">
                <table class="table table-hover table-dark">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Id Pedido</th>
                            <th scope="col">Correo Solicitante</th>
                            <th scope="col">Medio de transporte</th>
                            <th scope="col">Refrigeración</th>
                            <th scope="col">Peso de carga</th>
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
                                <td>
                                    @if($VentasDisponibles->REFRIGERADO == 0)
                                    No
                                    @elseif($VentasDisponibles->REFRIGERADO == 1)
                                    Si
                                    @endif
                                </td>
                                <td>{{$VentasDisponibles->CANT_KG_TOTAL}}</td>
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






    <div class="container my-5">
        <br>
        <h2>Postulaciones</h2>
        <hr>

        @if(Session::has('message'))
        <div class="alert alert-{{ Session::get('type') }} alert-dismissable fade show text-center" role="alert">
            {{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif


        <div class="table-responsive">
            <table class="table table-hover table-dark">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id Pedido</th>
                        <th scope="col">Correo Solicitante</th>
                        <th scope="col">Medio de transporte</th>
                        <th scope="col">Refrigeración</th>
                        <th scope="col">Peso de carga</th>
                        <th scope="col">Estado del pedido</th>
                    </tr>
                </thead>
                <tbody>
                    <div class="container">
                        @foreach($Postulaciones as $key => $Postulados)
                        <tr>
                            <td>{{$Postulados->ID_PEDIDO}}</td>
                            <td>{{$Postulados->CORREO_COMPRADOR}}</td>
                            <td>{{$Postulados->METODO_VIAJE}}</td>
                            <td>
                                @if($Postulados->REFRIGERADO == 0)
                                No
                                @elseif($Postulados->REFRIGERADO == 1)
                                Si
                                @endif
                            </td>
                            <td>{{$Postulados->CANT_KG_TOTAL}}</td>
                            <td>{{$Postulados->ESTADO}}</td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>








    <div class="container my-5">
        <br>
        <h2>Pedidos históricos</h2>
        <hr>

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
            <div class="table-responsive">
                <table class="table table-hover table-dark">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Id Pedido</th>
                            <th scope="col">Correo Solicitante</th>
                            <th scope="col">Medio de transporte</th>
                            <th scope="col">Refrigeración</th>
                            <th scope="col">Peso de carga</th>
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
                                <td>
                                    @if($vHistorico->REFRIGERADO == 0)
                                    No
                                    @elseif($vHistorico->REFRIGERADO == 1)
                                    Si
                                    @endif
                                </td>
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

    <div class="container my-5">
        <br>
        <h2>Pedidos históricos</h2>
        <hr>

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
            <div class="table-responsive">
                <table class="table table-hover table-dark">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Id Pedido</th>
                            <th scope="col">Correo Solicitante</th>
                            <th scope="col">Medio de transporte</th>
                            <th scope="col">Refrigeración</th>
                            <th scope="col">Peso de carga</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <div class="container">
                          
                            <tr>
                                <td>fghfghfgh</td>
                                <td>fghfgh</td>
                                <td>fghfgh</td>
                                <td>
                                    fghfghfgh
                                </td>
                                <td>fghfghfh</td>
                                <td>fghfghfgh</td>
                                <td>
                                    Actualizar Estado
                                </td>
                            </tr>
                           
                    </tbody>
                </table>
            </div>
        </form>

    </div>

    <a href="pedidos" class="btn btn-danger col-sm-12 col-xs-12 col-md-2 btn-form my-2"><i class="fas fa-backspace"></i> Volver</a>
</div>




<!--Footer-->