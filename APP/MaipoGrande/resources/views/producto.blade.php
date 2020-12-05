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

    <form class="form-inline my-2 my-lg-0 float-right" >
        <input name="name" class="form-control mr-sm-2" type="search" placeholder="Buscar por producto" aria-label="Search" value="">
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
                <!--<th scope="col">Imagen Producto</th>-->
                <th scope="col">Nombre Producto</th>
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
                        
                        <td><img src="{{Storage::url($fruta->FOTO)}}" alt="" width="80px" height="80px" onerror="this.onerror=null;this.src='{{ asset("default/not-available.jpg")}}';" class="img-fluid"></td>
                        
                        <td>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#editarPModal" onclick="getFruitById('{{$fruta->ID_TIPO_FRUTA}}')"> <!--<a href='ModificarProducto'>Modificar</a> -->
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
{{$frutas->links()}}

<div class="modal" id="producto" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-body">
                        <!-- contenido del form -->
                        <form action="{{route('CrearProducto')}}" method="post" enctype="multipart/form-data" >
                        @csrf
                        
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
                                        <textarea class="form-control"  id="descripcion" name="descripcion" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="file1">Cargar imagen de producto</label>
                                    <input type="file" class="form-control-file" name="imagen" id="imagen" accept="image/*" required>
                                    <!-- @error('file')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror -->
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
                        <form action="{{route('updateProduct')}}" method="post" enctype="multipart/form-data">  
                        @csrf
                        @method('PUT') 

                        <input type="hidden" name="id" id="product_id">
                     
                            <p class="font-weight-bold">Modifica un producto creado...</p>
                            <div class="form-group">
                                <div class="col-xs-4">
                                    <div class="col-xs-4">
                                        <label for="nombre1">Nombre del producto:</label>
                                        <input type="text" id="nombreEdit" class="form-control" name=nombreFruta placeholder="Nombre" required>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="descripcionEdit">Descipcion del producto:</label>
                                        <textarea class="form-control"  id="descripcionEdit" name="descripcionP" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="imagenP">Cargar imagen de producto</label>
                                    <input type="file" class="form-control-file" name="imagen" id="imagenP" accept="image/*">
                                    <input type="hidden" name="old_foto" id="old_foto">
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


    






    @endsection
    
    <script>
        
    </script>