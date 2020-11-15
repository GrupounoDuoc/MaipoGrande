
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicia sesión | MaipoGrande</title>
    
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Condensed" rel="stylesheet">

    <link rel="stylesheet" href="iconos/ojos-contraseña/style.css">
    <link rel="stylesheet" href="iconos/icon-cerrar/style.css">
    <link rel="stylesheet" href="iconos/style.css">

    <link rel="stylesheet" href="css/login.css">
</head>

<body>

    <div class="container-boton">
        <form action= "{{ route('salir') }}" method="POST" autocomplete="off" class="form-login">
        <h1>BIENVENIDO  <?php echo $varSesion ?> </h1>
            {{ csrf_field() }}
        <input type="submit" name="" value="LOGOUT">
    </div>

</body>