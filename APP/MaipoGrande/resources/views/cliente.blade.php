@extends('admin.layout')

@section('content')


</div>

</div>
<div class="form-group ">
    <label class="col-md-8 form-control-label" for="nombrefor">Nombre</label>
    <div class="col-md-12">
        <input type="text" id="nombrefor" name="nombre" class="form-control" placeholder="Ingrese su nombre ...">
    </div>
</div>

<div class="form-group ">
    <label class="col-md-8 form-control-label" for="apellidofor">Apellido</label>
    <div class="col-md-12">
        <input type="text" id="apellidofor" name="apellido" class="form-control" placeholder="Ingrese su apellido ...">
    </div>
</div>


<div class="form-group ">
    <label class="col-md-8 form-control-label" for="num_documento">Rut</label>
    <div class="col-md-12">
        <input type="text" id="num_documento" name="rut" class="form-control" placeholder="Ingrese el número documento" pattern="[0-9]{0,15}">
    </div>
</div>

<div class="form-group ">
    <label class="col-md-8 form-control-label" for="telefono">Telefono</label>
    <div class="col-md-12">
        <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Ingrese el telefono" pattern="[0-9]{0,15}">
    </div>
</div>

<div class="form-group ">
    <label class="col-md-8 form-control-label" for="emailfor">Correo</label>
    <div class="col-md-12">
        <input type="email" class="form-control" id="emailfor" name="email" placeholder="Ingrese el correo">
    </div>
</div>

<div class="form-group">
    <label for="exampleFormControlSelect1">Tipo de Comprador</label>
    <select class="form-control" name="tipocomprador" required>
        <option value=3>Compras Nacionales</option>
        <option value=4>Compras Internacionales</option>
    </select>
</div>



<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times fa-2x"></i> Cerrar</button>
    <button type="submit" class="btn btn-success"><i class="fa fa-save fa-2x"></i> Guardar</button>

</div>


@endsection