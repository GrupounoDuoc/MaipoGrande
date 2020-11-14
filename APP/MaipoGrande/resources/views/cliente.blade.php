@extends('admin.layout')

@section('content')


</div>
                                       
    </div>
                                        
                                        
                                        <div class="form-group row">
                                                    <label class="col-md-3 form-control-label" for="num_documento">Rut</label>
                                                    <div class="col-md-9">
                                                        <input type="text" id="num_documento" name="rut" class="form-control" placeholder="Ingrese el número documento" pattern="[0-9]{0,15}">
                                                    </div>
                                        </div>
                                    
                                        <div class="form-group row">
                                                    <label class="col-md-3 form-control-label" for="telefono">Telefono</label>
                                                    <div class="col-md-9">
                                                        +
                                                        <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Ingrese el telefono" pattern="[0-9]{0,15}">
                                                            
                                                    </div>
                                        </div>
                                    
                                        <div class="form-group row">
                                                    <label class="col-md-3 form-control-label" for="telefono">Correo</label>
                                                    <div class="col-md-9">
                                                        
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese el correo">
                                                            
                                                    </div>
                                        </div>
                                    
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times fa-2x"></i> Cerrar</button>
                                            <button type="submit" class="btn btn-success"><i class="fa fa-save fa-2x"></i> Guardar</button>
                                            
                                        </div>
        
        
@endsection