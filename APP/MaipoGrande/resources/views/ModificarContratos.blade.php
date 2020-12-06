@laravelPWA
@extends('admin.layout')

@section('content')
<div class="Contenedor">
    <form action="{{ route('ModificarContrato') }}" method="POST" autocomplete="on" action="">
        <!--Es una buena forma para trabajar con formularios, para validarlos con php o js-->
        @csrf
        <fieldset>
            <p class="font-weight-bold">Selecciona los datos para modificar contrato...</p>
            <div class="form-group">
                <div class="form-group">
                    <div class="form-group">
                        <div class="col-md-9">
                            <select name="id_usuario" class="form-control" required>
                                <option selected disabled value="">Selecciona un usuario</option>
                                @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->ID_USUARIO}}">{{ $usuario->CORREO}}</option>
                                @endforeach
                            </select>
                            <div>
                                <br>
                            </div>
                            <div>
                                <p class="font-weight-bold">Carga el archivo de contrato del usuario</p>
                                <input type="file" name="contrato" id="fileToUpload">
                            </div>
                            <div>
                                <p class="font-weight-bold">Ingresa nueva fecha de término del contrato</p>
                                <input name="fecha_termino" type="date">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </fieldset>
        <fieldset>
            <div class="container-boton">
                <button type="submit" class="btn btn-success"><i class="fa fa-save fa-1x"></i> Guardar</button>
            </div>
        </fieldset>
    </form>

</div>

@endsection