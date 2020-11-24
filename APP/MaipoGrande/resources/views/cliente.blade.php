@extends('admin.layout')

@section('content')
<div class="contenedor">
    <div>
        <br>
        <a href="#prueba" data-toggle="modal"><button class="btn btn-success" style="justify-content:center;"><span class="material-icons">person_add</span>Usuario</button></a>
    </div>
    <br>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Rut</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Correo</th>
                <th scope="col">Perfil</th>
                <th scope="col">Acción</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td scope="col">ID</td>
                <td scope="col">Rut</td>
                <td scope="col">Nombre</td>
                <td scope="col">Apellido</td>
                <td scope="col">Correo</td>
                <td scope="col">Perfil</td>
                <td><button class="btn btn-warning">Editar usuario <i class="material-icons"></i> &#128397;&#65039;</a></button> <button class="btn btn-danger">Eliminar usuario<i class="material-icons"></i> &#128465;&#65039;</a></button></td>
            </tr>
        </tbody>
    </table>
</div>


    <div class="modal" id="prueba" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-body">
                        <!-- contenido del form -->
                        <form action="">    
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="nombre">Nombre</label>
                                <div class="col-md-9">
                                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese el Nombre" required pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="apellido">Apellido</label>
                                <div class="col-md-9">
                                    <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Ingrese su apellido" pattern="^[a-zA-Z0-9_áéíóúñ°\s]{0,200}$">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="rutUser">Rut</label>
                                <div class="col-md-6">
                                    <input type="text" id="rutUser" name="rut" class="form-control" placeholder="Ingrese su rut" pattern="[0-10]{0,15}">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="dv" class="form-control" placeholder="dv">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="documento">Tipo de usuario</label>

                                <div class="col-md-9">

                                    <select class="form-control" name="tipo_documento" id="tipo_documento">
                                        <option selected disabled value="">Seleccione perfil</option>
                                        <option value=1>Administrador</option>
                                        <option value=2>Vendedor</option>
                                        <option value=3>Compras Nacionales</option>
                                        <option value=4>Compras Internacionales</option>
                                        <option value=4>Transportista</option>
                                    </select>

                                </div>

                            </div>


                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="num_documento">Nombre comercial</label>
                                <div class="col-md-9">
                                    <input type="text" id="num_documento" name="num_documento" class="form-control" placeholder="Ingrese nombre de fantasia . . . ">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="telefono">Telefono</label>
                                <div class="col-md-9">

                                    <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Ingrese el telefono . . . " pattern="[0-9]{0,15}">

                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="credencial">Ingrese sus credenciales</label>
                                </div>
                                <label class="col-md-3 form-control-label" for="telefono">Correo</label>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese el correo">
                                </div>
                                <br>
                                <br>
                                <label class="col-md-3 form-control-label" for="contra">Contraseña</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" id="contra" name="email" placeholder="Ingrese su contraseña . . .">
                                </div>
                                
                            </div>
                        </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times fa-2x"></i> Cerrar</button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-save fa-2x"></i> Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal editar usuario -->
    


    @endsection