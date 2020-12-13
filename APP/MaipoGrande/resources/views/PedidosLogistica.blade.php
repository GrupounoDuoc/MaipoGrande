
@laravelPWA

<?php
    if(!isset($_SESSION)) 
    { 
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
                    <li class="nav-item active">
                        <a class="nav-link" href="catalogo"> TRANSPORTISTA:  {{$_SESSION['usuario']}}<span class="sr-only">(current)</span></a>
                    </li>

                </ul>
            </div>
</nav>






<div class="contenedor">
    <br>
    <h2>Pedidos en Logística</h2>
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
                    <th scope="col">Fecha límite</th>
                    <th scope="col">Estado actual</th>

                    <th scope="col">Refrigeración</th>
                    <th scope="col">Peso Máx.</th>     

                    <th scope="col">Acción</th>
                </tr>
            </thead>



            <tbody>
                <tr>
                    <div class="container">

                        @foreach($VentasExt as $key => $venta)
                        @if($venta->NOMBRE == 'EN LOGISTICA' & $venta->ID_PEDIDO !=session('pedidoPost'))
                                <tr>
                                    <td>{{$venta->ID_PEDIDO}}</td>
                                    <input type="hidden" name="id_pedido{{$venta->ID_PEDIDO}}" value="{{$venta->ID_PEDIDO}}">
                                    <td>{{$venta->CORREO}}</td>

                                    <td>{{$venta->FECHA_LIMITE_O_RETIRO}}</td>

                                    <td>{{$venta->NOMBRE}}</td>

                                    <?php
                                        $countrefri = 0;
                                        $refri = '';
                                    ?>
                                    @foreach($VentasExt3 as $key => $venta3)
                                    @if($venta->ID_PEDIDO == $venta3->ID_PEDIDO & $venta3->REFRIGERADO == 1)
                                        <?php
                                            $countrefri = $countrefri + 1;
                                        ?>
                                    @endif
                                    @endforeach
                                    @if($countrefri > 0)
                                        <?php
                                            $refri = 'SÍ';
                                        ?>
                                        @elseif($countrefri == 0 || $countrefri == NULL)
                                            <?php
                                                $refri = 'NO';
                                            ?>
                                    @endif
                                    <td>{{$refri}}</td>


                                    <?php
                                        $count = 0
                                    ?>
                                        @foreach($VentasExt3 as $key => $venta3)
                                            @if($venta->ID_PEDIDO == $venta3->ID_PEDIDO)
                                                <?php
                                                    $count = $count + $venta3->CANT_KG
                                                ?>
                                            @endif
                                        @endforeach


                                        <td>{{$count}}</td>

                                    <td>
                                    <input class="btn btn-success my-2 my-sm-0" type="submit" name="Postular{{$venta->ID_PEDIDO}}" value="Postular">
                                    </td>



                                </tr>
                        @endif
                        @endforeach
            </tbody>
        </table>
    </form>
</div>






<div class="contenedor">
    <br>
    <h2>Pedidos adjudicados para transporte</h2>
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
                    <th scope="col">Fecha límite</th>
                    <th scope="col">Refrigeración</th>
                    <th scope="col">Peso Máx.</th>   
                    <th scope="col">Estado actual</th>

                      <th scope="col">Nuevo estado</th>

                    <th scope="col">Acción</th>
                </tr>
            </thead>



            <tbody>
            @foreach($datosdespacho as $key => $despacho)
                @if($despacho->ID_TRANSPORTISTA == $_SESSION['id_usuario'])

                <tr>
                    <div class="container">
                                <tr>
                                    <td>{{$despacho->ID_PEDIDO}}</td>
                                    <input type="hidden" name="id_pedido{{$venta->ID_PEDIDO}}" value="{{$venta->ID_PEDIDO}}">

                                    @foreach($VentasExt as $key => $venta)
                                        @if($despacho->ID_PEDIDO == $venta->ID_PEDIDO)

                                            <td>{{$venta->CORREO}}</td>
                                            <td>{{$venta->FECHA_LIMITE_O_RETIRO}}</td>

                                        @endif
                                    @endforeach

                                    <?php
                                        $countrefri = 0;
                                        $refri = '';
                                    ?>
                                    @foreach($VentasExt3 as $key => $venta3)
                                    @if($venta3->ID_PEDIDO == $despacho->ID_PEDIDO & $venta3->REFRIGERADO == 1)
                                        <?php
                                            $countrefri = $countrefri + 1;
                                        ?>
                                    @endif
                                    @endforeach
                                    @if($countrefri > 0)
                                        <?php
                                            $refri = 'SÍ';
                                        ?>
                                        @elseif($countrefri == 0 || $countrefri == NULL)
                                            <?php
                                                $refri = 'NO';
                                            ?>
                                    @endif
                                    <td>{{$refri}}</td>


                                    <?php
                                        $count = 0
                                    ?>
                                    @foreach($VentasExt3 as $key => $venta3)
                                        @if($venta3->ID_PEDIDO == $despacho->ID_PEDIDO)
                                            <?php
                                                $count = $count + $venta3->CANT_KG
                                            ?>
                                        @endif
                                    @endforeach
                                    <td>{{$count}}</td>

                                    <td>{{$venta->NOMBRE}}</td>


                                    @foreach($VentasExt as $key => $venta)
                                        @if($despacho->ID_PEDIDO == $venta->ID_PEDIDO)


                                    <td>
                                        <select class="form-control" name="nuevo_estado{{$venta->ID_PEDIDO}}" id="nuevo_estado" required>
                                        
                                            <option value="">--Cambiar estado--</option>
 
                                            <option value="">ENTREGADO</option>

                                        </select>
                                    </td>

                                        @endif
                                    @endforeach
                                    <td>
                                    <input class="btn btn-success my-2 my-sm-0" type="submit" name="Actualizar{{$venta->ID_PEDIDO}}" value="Actualizar">
                                    </td>
 
                                </tr>
                @endif
            @endforeach

            </tbody>
        </table>
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





