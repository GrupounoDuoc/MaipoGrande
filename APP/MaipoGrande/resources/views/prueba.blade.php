<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF USUARIO</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<h1>Maipo Grande</h1>
<br><br>
<h3>Reporte de usuario</h3>
<hr>
    <div class="row d-flex justify-content-center">
        <table class="table table-striped" style="text-align: center;">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Rut</th>
                    <th scope="col">Dv</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Perfil</th>
                </tr>
            </thead>
            <tbody>   
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
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>