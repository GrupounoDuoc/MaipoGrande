@laravelPWA
@extends('admin.layout')

@section('content')
<div class="contenedor">
    <br>
    <h2>Listar pedidos externos</h2>

    <form class="form-inline my-2 my-lg-0 float-right">
        <input name="name" class="form-control mr-sm-2" type="search" placeholder="Buscar por nombre" aria-label="Search" value="">
        <button class="btn btn-success my-2 my-sm-0" type="submit">Buscar</button>
    </form>
    <br><br>

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


        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Id Pedido</th>
                    <th scope="col">Correo Solicitante</th>
                    <th scope="col">Fecha límite</th>
                    <th scope="col">Estado actual</th>
                    <th scope="col">Nuevo estado</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <div class="container">
                        @foreach($VentasExt as $key => $venta)
                <tr>
                    <td>{{$venta->ID_PEDIDO}}</td>
                    <input type="hidden" name="id_pedido{{$venta->ID_PEDIDO}}" value="{{$venta->ID_PEDIDO}}">
                    <td>{{$venta->CORREO}}</td>
                    <input type="hidden" name="correo{{$venta->ID_PEDIDO}}" value="{{$venta->CORREO}}">
                    <td>{{$venta->FECHA_LIMITE_O_RETIRO}}</td>
                    <td>{{$venta->NOMBRE}}</td>
                    <td>
                        <select class="form-control" name="nuevo_estado{{$venta->ID_PEDIDO}}" id="nuevo_estado" required>
                            @foreach($Estados as $estado)
                            <option value="{{ $estado->ID_ESTADO}}">{{ $estado->NOMBRE}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    <input class="btn btn-success my-2 my-sm-0" type="submit" name="Actualizar{{$venta->ID_PEDIDO}}" value="Actualizar">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</div>
@endsection