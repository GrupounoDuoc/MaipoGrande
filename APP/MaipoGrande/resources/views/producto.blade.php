@extends('admin.layout')

@section('content')
    

    <!-- Modal editar usuario -->
    <div class="contenedor">
    <div>
        <br>
        <a href="#producto" data-toggle="modal"><button class="btn btn-success"><i class="material-icons"></i>  &#128465;&#65039; Producto</button></a>
    </div>
    <br>
    <h2>Lista de productos registrados</h2>

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
                <th scope="col">Id</th>
                <!--<th scope="col">Imagen Producto</th>-->
                <th scope="col">Nombre Proveedor</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Imagen</th>
                <th scope="col">Accion</th>
            </tr>
        </thead>
        <tbody>
        @foreach($frutas as $fruta)
                    <tr>
                        <td>{{$fruta->ID_TIPO_FRUTA}}</td>
                        <td>{{$fruta->TIPO_FRUTA}}</td>
                        <td>{{$fruta->DESCRIPCION}}</td>
                        <td>{{$fruta->FOTO}}</td>
                        <td>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#editarModal" onclick="ConsultaUserbyRut('{{$fruta->ID_TIPO_FRUTA}}')"> <!--<a href='ModificarProducto'>Modificar</a> -->
                                Editar usuario
                                <input type="hidden" value="{{$fruta->ID_TIPO_FRUTA}}">
                                <i class="material-icons"></i> &#128397;&#65039;</a>
                            </button>

                            <a href='deleteProducto/{{ $fruta->ID_TIPO_FRUTA }}' role="button" class="btn btn-danger">Eliminar Producto<i class="material-icons"></i> &#128465;&#65039;</a>
                        </td>
                    </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="modal" id="producto" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-body">
                        <!-- contenido del form -->
                        <form id="ProductCreatedForm">
                        @csrf
                        <!--<form action="{{ route('CrearProducto') }}" method="POST" autocomplete="on" action="">-->
                            <p class="font-weight-bold">Ingresa los datos del nuevo Producto...</p>
                            <div class="form-group">
                                <div class="col-xs-4">
                                    <div class="col-xs-4">
                                        <label for="nombre1">Nombre del producto:</label>
                                        <input type="text" id="nombreFruta" class="form-control" name=nombreFruta placeholder="Nombre" required>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Descipcion del producto:</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" id="descripcion" name="descripcion" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="file1">Cargar imagen de producto</label>
                                    <input type="file" class="form-control-file" name="imagen" id="imagen" accept="image/*">
                                </div>
                            </div>
                    
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times fa-2x"></i> Cerrar</button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-save fa-2x"></i> Guardar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal" id="editarPModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-body">
                        <!-- contenido del form -->
                        <form id="ProductCreatedForm">  
                     
                            <p class="font-weight-bold">Ingresa los datos del nuevo Producto...</p>
                            <div class="form-group">
                                <div class="col-xs-4">
                                    <div class="col-xs-4">
                                        <label for="nombre1">Nombre del producto:</label>
                                        <input type="text" id="nombreP" class="form-control" name=nombreFruta placeholder="Nombre" required>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Descipcion del producto:</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" id="descripcionP" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="file1">Cargar imagen de producto</label>
                                    <input type="file" class="form-control-file" name="imagen" id="imagenP" accept="image/*">
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



    @endsection
    
    <script>
        
    </script>