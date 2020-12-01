@extends('admin.layout')

@section('content')
    

    <!-- Modal editar usuario -->
    <div class="contenedor">
    <div>
        <br>
        <a href="#producto" data-toggle="modal"><button class="btn btn-success"><i class="material-icons"></i>  &#128465;&#65039; Producto</button></a>
    </div>
    <br>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Id</th>
                <!--<th scope="col">Imagen Producto</th>-->
                <th scope="col">Nombre Proveedor</th>
                <th scope="col">Calidad</th>
                <th scope="col">Costo</th>
            </tr>
        </thead>
        <tbody>
        @foreach($frutas as $fruta)
                    <tr>
                        <td>{{$fruta->ID_TIPO_FRUTA}}</td>
                        <td>{{$fruta->NOMBRE}}</td>
                        <td>{{$fruta->DESCRIPCION}}</td>
                        <td><a href='deleteProducto/{{ $fruta->ID_TIPO_FRUTA }}'>Borrar</a>
                            <a href='ModificarProducto'>Modificar</a>
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
                        <!--<form action="{{ route('CrearProducto') }}" method="POST" autocomplete="on" action="">-->
                            <p class="font-weight-bold">Ingresa los datos del nuevo Producto...</p>
                            <div class="form-group">
                                <div class="col-xs-4">
                                    <div class="col-xs-4">
                                        <label for="nombre1">Nombre del producto:</label>
                                        <input type="text" id="nombre1" class="form-control" name=nombreFruta placeholder="Nombre" required>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Descipcion del producto:</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" id="descripcion" rows="3"></textarea>
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
                        <form id="">  
                     
                            <p class="font-weight-bold">Ingresa los datos del nuevo Producto...</p>
                            <div class="form-group">
                                <div class="col-xs-4">
                                    <div class="col-xs-4">
                                        <label for="nombre1">Nombre del producto:</label>
                                        <input type="text" id="nombre1" class="form-control" name=nombreFruta placeholder="Nombre" required>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Descipcion del producto:</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" id="descripcion" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="file1">Cargar imagen de producto</label>
                                    <input type="file" class="form-control-file" name="imagen" id="imagen" accept="image/*">
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
         $('#ProductCreatedForm').submit(function(e) {
        e.preventDefault(); //evitar recargar la pagina


        var nombreFruta = $('#nombreFruta').val();
        var descripcion = $('#descripcion').val();
        var imagen = $('#imagen').val();


        $.ajax({
          type: 'POST',
          url: "{{ route('CrearProducto') }}",
          data: {
            "_token": $("meta[name='csrf-token']").attr("content"),


            "nombre": nombre,
            "descripcion": descripcion,
            "foto": foto
          },
          success: function(data) {
            var json = JSON.stringify(data);
            var Obj = JSON.parse(json);

            if (Obj.length === 0) {

              //alert('ok')
              //$('#prueba').modal('toggle')

            } else {
              alert('error')
            }

            console.log(Obj.length)


          },

          error: (error) => {
            alert('Formulario incompleto')

            console.log(error);
          },
        });
      });

    </script>