@extends('admin.layout')

@section('content')
<div class="contenedor">
    <div>
        <a href="#prueba" data-toggle="modal"><button class="btn btn-success" style="margin-top: 0.5rem;"><img src="imagenes/agregar-usuario.svg"></img>Usuario</button></a>
    </div>
    <br>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Correo Electronico</th>
                <th scope="col">Tipo Comprador</th>
                <th scope="col">Accion</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row"></th>
                <td></td>
                <td>Otto</td>
                <td>@mdo</td>
                <td>@mdo</td>
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
                                <label class="col-md-3 form-control-label" for="direccion">Apellido</label>
                                <div class="col-md-9">
                                    <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Ingrese la dirección" pattern="^[a-zA-Z0-9_áéíóúñ°\s]{0,200}$">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="documento">Documento</label>

                                <div class="col-md-9">

                                    <select class="form-control" name="tipo_documento" id="tipo_documento">

                                        <option value="0" disabled>Seleccione</option>
                                        <option value="DNI">Cliente nacional</option>
                                        <option value="CEDULA">Cliente internacional</option>
                                    </select>

                                </div>

                            </div>


                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="num_documento">Número documento</label>
                                <div class="col-md-9">
                                    <input type="text" id="num_documento" name="num_documento" class="form-control" placeholder="Ingrese el número documento" pattern="[0-9]{0,15}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="telefono">Telefono</label>
                                <div class="col-md-9">

                                    <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Ingrese el telefono" pattern="[0-9]{0,15}">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="telefono">Correo</label>
                                <div class="col-md-9">

                                    <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese el correo">

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