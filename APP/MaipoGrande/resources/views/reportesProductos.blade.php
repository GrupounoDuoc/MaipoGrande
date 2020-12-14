<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Reporte de Productos</title>
</head>

    <body>
    <img src="https://gomommyhealthynutrition.files.wordpress.com/2018/06/plato-y-surtido-de-verduras-maduras_23-2147694064.jpg"  margin: 0; padding: 0; background-size:cover; >
    <h1>Maipo Grande</h1>
    <br><br>
    <h3>Reporte de productos</h3>
    <hr>
    <div class="row d-flex justify-content-center">
        <table class="table table-striped" style="text-align: center;">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <!--<th scope="col">Imagen Producto</th>-->
                    <th scope="col">Nombre Producto</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Imagen</th>
                </tr>
            </thead>
            <tbody>
            @foreach($frutas as $fruta)
                        <tr>
                            <td>{{$fruta->ID_TIPO_FRUTA}}</td>
                            <td>{{$fruta->NOMBRE}}</td>
                            <td>{{$fruta->DESCRIPCION}}</td>
                            <td><img src="{{public_path(Storage::url($fruta->FOTO))}}" alt="" onerror="this.onerror=null;this.src='{{ asset("default/not-available.jpg")}}';" class="img-fluid" style="width: 500px; height: 100px;"></td> <!-- public pat, es para mostrar imagenes en pdf de manera publica!!-->
                            
                        </tr>
            @endforeach
            </tbody>
        </table>
    </div>


        <!-- <img src="https://gomommyhealthynutrition.files.wordpress.com/2018/06/plato-y-surtido-de-verduras-maduras_23-2147694064.jpg" margin: 0; padding: 0; background-size:cover;>
        <h1>Maipo Grande</h1>
        <br><br>
        <h3>Reporte de productos</h3>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre Producto</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Imagen</th>

                </tr>
            </thead>
            <tbody>
                @foreach($frutas as $fruta)
                <tr>
                    <td>{{$fruta->ID_TIPO_FRUTA}}</td>
                    <td>{{$fruta->NOMBRE}}</td>
                    <td>{{$fruta->DESCRIPCION}}</td>

                    <td><img src="{{Storage::url($fruta->FOTO)}}" alt="" width="80px" height="80px" onerror="this.onerror=null;this.src='{{ asset("default/not-available.jpg")}}';" class="img-fluid"></td>

                </tr>
                @endforeach
        </table> -->
    </body>

</html>