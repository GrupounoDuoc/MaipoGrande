@laravelPWA
@extends('admin.layout')

@section('content')
<div class="contenedor">
    <div>
        <br>
        <a href="#prueba" data-toggle="modal"><button class="btn btn-success" style="justify-content:center;"><span class="material-icons">person_add</span>Usuario</button></a>
        <a href="verpdf"><button class="btn btn-outline-info" style="justify-content:center;"><span class="material-icons">person_add</span>Generar PDF</button></a>
    </div>
    <br>
    <h2>Lista de usuarios registrados</h2>

    <form class="form-inline my-2 my-lg-0 float-right" >
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

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Rut</th>
                <th scope="col">Dv</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Correo</th>
                <th scope="col">Perfil</th>
                <th scope="col">Acción</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <div class="container">
            @foreach($personas as $key => $persona)
            <tr>
                <td>{{$persona->ID_USUARIO}}</td>
                <td>{{$persona->RUT}}</td>
                <td>{{$persona->DIGITO_VERIFICADOR}}</td>
                <td>{{$persona->NOMBRE}}</td>
                <td>{{$persona->APELLIDO}}</td>
                <td>{{$persona->usuario->CORREO}}</td>


                <td>
                    
                    <b>
                        {{$persona->usuario->profile->NOMBRE}}
                    </b>
                   
                <td>
                    <!-- <button class="btn btn-warning" data-toggle="modal" data-target="#editarModal"> -->
                    <button class="btn btn-warning" data-toggle="modal" data-target="#editarModal" onclick="ConsultaUserbyRut('{{$persona->RUT}}')">
                        Editar persona
                        <input type="hidden" value="{{$persona->RUT}}">
                        <i class="material-icons"></i> &#128397;&#65039;</a>
                    </button>

                    <a href='deleteUser/{{ $persona->RUT }}' role="button" class="btn btn-danger">Eliminar persona<i class="material-icons"></i> &#128465;&#65039;</a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{$personas->links()}}
{{$personas->total()}}


<div class="modal" id="prueba" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-body">
                    <h4 class="modal-tittle">Agregar un nuevo usuario</h4>
                    <!-- contenido del form -->
                    <!-- <form action="{{ route('CrearUser') }}" method="POST" autocomplete="on" action="">    -->
                    <form id="UserCreatedForm">
                        @csrf

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="nombre">Nombre:</label>
                            <div class="col-md-9">
                                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese el Nombre" required pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="apellido">Apellido:</label>
                            <div class="col-md-9">
                                <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Ingrese su apellido" required pattern="^[a-zA-Z0-9_áéíóúñ°\s]{0,200}$">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="rutUser">Rut:</label>
                            <div class="col-md-6">
                                <input type="text" id="rut" name="rut" class="form-control" placeholder="Ingrese su rut" required>
                            </div>
                            <div class="col-md-3">
                                <input type="text" id="dv" name="dv" class="form-control" placeholder="dv" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="documento">Tipo de usuario:</label>
                            <div class="col-md-9">
                            <select class="form-control" name="tipocomprador" id="tipocomprador" required>
                                    <option selected disabled value="">Seleccione perfil</option>
                                    @foreach ($perfil as $perfil1)
                                    <option value="{{$perfil1->ID_PERFIL}}">{{$perfil1->NOMBRE}}</option>
                                    @endforeach
                                </select>

                            </div>

                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="documento">Tipo de persona:</label>

                            <div class="col-md-9">

                                <select class="form-control" name="tipopersona" id="tipopersona" required>
                                    <option selected disabled value="">Seleccione tipo</option>
                                    <option value=1>Persona natural</option>
                                    <option value=2>Empresa</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="nombrefantasia">Nombre comercial:</label>
                            <div class="col-md-9">
                                <input type="text" id="nombrefantasia" name="nombrefantasia" class="form-control" required placeholder="Ingrese nombre de fantasia . . . ">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="documento">Comuna:</label>

                            <div class="col-md-9">

                                <select class="form-control" name="comuna" id="comuna" required>
                                    <option selected disabled value="">Seleccione su comuna</option>}

                                    @foreach($comunas as $cursorcomuna)
                                    <option value="{{ $cursorcomuna->ID}}">{{ $cursorcomuna->NOMBRECOMUNA}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="codigopostal">Codigo postal:</label>
                            <div class="col-md-9">
                                <input type="text" id="codigopostal" name="codigopostal" class="form-control" placeholder="Ingrese el telefono . . . " required maxlength="8">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="telefono">Telefono:</label>
                            <div class="col-md-9">
                                <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Ingrese el telefono . . . " required maxlength="9">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="credencial">Ingrese sus credenciales</label>
                            </div>
                            <label class="col-md-3 form-control-label" for="correo">Correo:</label>
                            <div class="col-md-9">
                                <input type="email" class="form-control" id="correo" name="correo" required placeholder="Ingrese el correo">
                            </div>
                            <br>
                            <br>
                            <label class="col-md-3 form-control-label" for="contra">Contraseña:</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" id="contrasenia" name="contrasenia" required placeholder="Ingrese su contraseña . . .">
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




<!-- Modal editar usuario -->
<div class="modal fade" id="editarModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-body">
                    <h4 class="modal-tittle">Editar usuario</h4>
                    <!-- contenido del form -->
                    <!-- <form action={{ route('ModificarUser') }} method="POST" autocomplete="on" action="">    -->
                    <form id="updateUserForm">
                        @csrf

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="rutUser">Rut</label>
                            <div class="col-md-6">
                                <input type="text" id="rut_edit" name="rut" class="form-control" placeholder="Ingrese su rut" disabled>
                            </div>
                            <div class="col-md-3">
                                <input type="text" id="dv_edit" name="dv" class="form-control" placeholder="dv" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="nombre">Nombre</label>
                            <div class="col-md-9">
                                <input type="text" id="nombre_edit" name="nombre" class="form-control" placeholder="Ingrese el Nombre" required pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="apellido">Apellido</label>
                            <div class="col-md-9">
                                <input type="text" id="apellido_edit" name="apellido" class="form-control" placeholder="Ingrese su apellido" pattern="^[a-zA-Z0-9_áéíóúñ°\s]{0,200}$">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="documento">Tipo de usuario</label>
                            <div class="col-md-9">
                                <select class="form-control" name="tipocomprador" id="tipocomprador_edit">
                                    <option selected disabled value="">Seleccione perfil</option>
                                    @foreach ($perfil as $perfil1)
                                    <!--
                                        <option value=1>Administrador</option>
                                        <option value=2>Vendedor</option>
                                        <option value=3>Compras Nacionales</option>
                                        <option value=4>Compras Internacionales</option>
                                        <option value=4>Transportista</option>
                                        -->
                                    <option value="{{$perfil1->ID_PERFIL}}">{{$perfil1->NOMBRE}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="documento">Tipo de persona</label>

                            <div class="col-md-9">

                                <select class="form-control" name="tipopersona" id="tipopersona_edit">

                                    <option selected hidden value="">Seleccione tipo</option>
                                    @foreach($tipo_persona_legal as $tipo_persona)
                                    <option value="{{$tipo_persona->ID_TIPO_PERSONA_LEGAL}}">{{$tipo_persona->DESCRIPCION}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="nombrefantasia">Nombre comercial</label>
                            <div class="col-md-9">
                                <input type="text" id="nombrefantasia_edit" name="nombrefantasia" class="form-control" placeholder="Ingrese nombre de fantasia . . . ">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="documento">Comuna</label>

                            <div class="col-md-9">

                                <select class="form-control" name="comuna" id="comuna_edit">
                                    <option selected disabled value="">Seleccione su comuna</option>}

                                    @foreach($comunas as $cursorcomuna)
                                    <option value="{{ $cursorcomuna->ID}}">{{ $cursorcomuna->NOMBRECOMUNA}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="codigopostal">Codigo postal</label>
                            <div class="col-md-9">
                                <input type="text" id="codigopostal_edit" name="codigopostal" class="form-control" placeholder="Ingrese el telefono . . . " pattern="[0-9]{0,15}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="telefono">Telefono</label>
                            <div class="col-md-9">
                                <input type="text" id="telefono_edit" name="telefono" class="form-control" placeholder="Ingrese el telefono . . . " pattern="[0-9]{0,15}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="credencial">Cambiar datos importantes</label>
                            </div>
                            <label class="col-md-3 form-control-label" for="correo">Correo</label>
                            <div class="col-md-9">
                                <input type="email" class="form-control" id="correo_edit" name="correo" placeholder="Ingrese el correo" disabled>
                            </div>
                            <br>
                            <br>
                            <!-- <label class="col-md-3 form-control-label" for="contra">Contraseña:</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" id="contrasenia_edit" name="contrasenia" required placeholder="Ingrese su contraseña . . .">
                            </div> -->
                            <br>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times fa-1x"></i> Cerrar</button>

                            <button type="submit" class="btn btn-warning" ><i class="fa fa-edit fa-1x"></i>Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection