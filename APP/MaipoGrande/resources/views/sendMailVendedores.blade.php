<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Envío de correo</title>
</head>
<body>
    <p>¡Hola! Te escribimos para informarte que tu producto ha sido comprada</p>
    <p>con el pedido N° <b>{{ $pedido }}</b> del comprador {{ $comprador }}.</p>

    <p>Tu producto comprado fue <b>{{ $producto }}</b> con <b>{{ $cantidad }} Kg. </b></p>

    <p>¡Felicidades!</p>

    <p>MAIPO GRANDE</p>
</body>
</html>