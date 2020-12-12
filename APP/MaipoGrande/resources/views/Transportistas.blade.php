@laravelPWA
@extends('admin.layout')

@section('content')
<div class="panel panel-default">
    @if(Session::has('message'))
    <div class="alert alert-{{ Session::get('type') }} alert-dismissable fade show text-center" role="alert">
        {{ Session::get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="contenedor">
        <div>
            <br>
            <a href="#prueba" data-toggle="modal"><button class="btn btn-success" style="justify-content:center;"><span class="material-icons">person_add</span>Crear Nuevo</button></a>
        </div>
        <br>
        <h2>Lista de detalle transportista</h2>

        <form class="form-inline my-2 my-lg-0 float-right">
            <input name="name" class="form-control mr-sm-2" type="search" placeholder="Buscar por nombre" aria-label="Search" value="">
            <button class="btn btn-success my-2 my-sm-0" type="submit">Buscar</button>
        </form>
        <br><br>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Tipo viaje</th>
                    <th scope="col">Refrigerado</th>
                    <th scope="col">Ton Max</th>
                    <th scope="col">Precio por KM</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <div class="container">
                        @foreach($transportistas as $key => $transportista)
                <tr>
                    <td>{{$transportista->ID_DETALLE_TRANSPORTISTA}}</td>
                    <td>{{$transportista->CORREO}}</td>
                    <td>{{$transportista->METODO_VIAJE}}</td>
                    <td>{{$transportista->REFRIGERADO}}</td>
                    <td>{{$transportista->TON_MAX}}</td>
                    <td>{{$transportista->PRECIO_KM}}</td>
                    <td>{{$transportista->DESCRIPCION}}
                    <td>
                        <!-- <button class="btn btn-warning" data-toggle="modal" data-target="#editarModal"> -->
                        <button class="btn btn-warning" data-toggle="modal" data-target="#editarModal" onclick="ConsultaUserbyRut('{{$transportista->ID_DETALLE_TRANSPORTISTA}}')">
                            Editar Tipo de Transportista
                            <input type="hidden" value="{{$transportista->ID_DETALLE_TRANSPORTISTA}}">
                            <i class="material-icons"></i> &#128397;&#65039;</a>
                        </button>
                        <a href='destroyDetalleTransportista/{{ $transportista->ID_DETALLE_TRANSPORTISTA }}' role="button" class="btn btn-danger">Eliminar detalle transporista<i class="material-icons"></i> &#128465;&#65039;</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="modal" id="prueba" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-body">
                            <h4 class="modal-tittle">Agregar un nuevo detalle transportista</h4>
                            <!-- contenido del form -->
                            <!-- <form action="{{ route('CrearUser') }}" method="POST" autocomplete="on" action="">    -->
                            <form form action="{{ route('Transportistas') }}" method="POST" id="DetalleTransportistaCreatedForm">
                                @csrf

                                <div class="form-group row">
                                    <label class="col-sm-3 form-control-label" for="transportista">Usuario :</label>

                                    <div class="col-md-9">
                                        <select class="form-control" name="id_transportista" id="id_transportista" required>
                                            <option selected disabled value="">Seleccione usuario transportista</option>}

                                            @foreach($usuarios_transportistas as $camionero)
                                            <option value="{{ $camionero->ID_USUARIO}}">{{ $camionero->CORREO}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 form-control-label" for="metodo_viaje">Medio:</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="metodo_viaje" id="metodo_viaje" required>
                                            <option selected disabled value="">Medio de transporte</option>}
                                            <option value="AIR">Aire</option>
                                            <option value="EAR">Tierra</option>
                                            <option value="SEA">Mar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 form-control-label" for="refrigerado">Refrigeración:</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="refrigerado" id="refrigerado" required>
                                            <option selected disabled value="">¿Es refrigerado?</option>}
                                            <option value="0">No</option>
                                            <option value="1">Si</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="ton_max">Tonelaje max:</label>
                                    <div class="col-md-9">
                                        <input type="number" id="ton_max" name="ton_max" class="form-control" placeholder="Tonelaje máximo" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="precio_km">Precio por KM:</label>
                                    <div class="col-md-9">
                                        <input type="number" id="precio_km" name="precio_km" class="form-control" placeholder="Precio por KM" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="nombrefantasia">Descripción del transporte:</label>
                                    <div class="col-md-9">
                                        <textarea name="descripcion" rows="2" cols="37" placeholder="Ingresa aquí la nueva descripción del transporte" maxlength="80"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times fa-1x"></i> Cerrar</button>

                                    <button type="submit" class="btn btn-success"><i class="fa fa-save fa-1x"></i> Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection