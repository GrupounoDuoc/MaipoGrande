<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>PDF Ventas</title>
</head>

<body>
    <h1>Maipo Grande</h1>
    <br><br>
    <h3>Reporte de Ventas</h3>
    <hr>
    <div class="row d-flex justify-content-center">
        <table class="table table-striped" style="text-align: center;">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">VENDEDOR</th>
                    <th scope="col">COMPRADOR</th>
                    <th scope="col">FECHA</th>
                    <th scope="col">NOMBRE FRUTA</th>
                    <th scope="col">CALIDAD</th>
                    <th scope="col">SUBTOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reportes as $reporte)
                <tr>
                    <td>{{$reporte->ID_TRANSACCION}}</td>

                    <td>{{$reporte->CORREO_VENDEDOR}}</td>
                    <td>{{$reporte->CORREO_COMPRADOR}}</td>
                    <td>{{$reporte->FECHA_TRANSACCION}}</td>
                    <td>{{$reporte->NOMBRE_FRUTA}}</td>
                    <td>{{$reporte->TIPO_CALIDAD}}</td>
                    <td><b>{{$reporte->SUBTOTAL_TRANSACCION}}</b></td>
                    @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>