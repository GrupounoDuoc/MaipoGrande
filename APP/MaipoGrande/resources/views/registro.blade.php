
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro | Maipo Grande</title>
    <link rel="stylesheet" href="css/registro.css">
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Condensed" rel="stylesheet">

    <link rel="stylesheet" href="iconos/style.css">
    <link rel="stylesheet" href="iconos/icon-cerrar/style.css">
</head>

<body>
    <header id="cabecera">
        <img src="imagenes/manzana.png" class="img-logo"> 
         <h1 class="logo"> <a href="index.php" > Maipo Grande </a></h1>
        <img src="img/menu.png" class="icon-menu" id="boton-menu">
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="contacto.php">Contacto</a></li>
                <li><a href=""><span class="icon-search"></span></a></li>
            </ul>
        </nav>
    </header>  
    <div class="menu-lateralResponsive" id="menu-responsive">
        <nav class="nav-responsive">
            <ul>
                <li><a href="login.html">Entrar</a></li>
                <li><a href="contacto.html">Contacto</a></li>
                <li><a href=""><span class="icon-cart"></span></a></li>
            </ul>
        </nav>  
    </div>

<div class="contenedor seccion contenido-centrado">
        <h2 class="centrar-texto">Registro de Cliente Nacional</h2>

        <form action="php/insertarUser.php" method="POST" autocomplete="off" class="contacto" action=""> <!--Es una buena forma para trabajar con formularios, para validarlos con php o js-->
            <fieldset>
                <Legend>Datos de contacto</Legend>
                <label for="nombre">Nombre: </label>  <!-- El for se pone para quien va hacer asignado el label, por ej este y el text q esta abajo con una ID"nombre"-->
                <input class="nombre" type="text" id="nombre" placeholder="Ingresa tu nombre"> <!--- Aca entra solo tipo de texto al formulario-->

                <label for="apellido">Apellido: </label>  <!-- El for se pone para quien va hacer asignado el label, por ej este y el text q esta abajo con una ID"nombre"-->
                <input type="text" id="apellido" placeholder="Ingresa tu nombre"> <!--- Aca entra solo tipo de texto al formulario-->
                
                <label for="rut">Rut:</label>
                <input type="id" min="0" placeholder="Rut"> <!-- Step: espara ir de 5 en 5-->

                <label for="opciones">Pais:</label>
                <select name="paisopcion" id="pais">
                    <option value="" disabled selected>-- Seleccione --</option> 
                </select>

                <label for="opciones">Ciudad:</label>
                <select name="ciudadopcion" id="ciudad">
                    <option value="" disabled selected>-- Seleccione --</option> 
                </select>

                <label for="direccion">Direccion: </label>
                <input type="text" id="direccion" placeholder="Ingrese direccion">

                <label for="email">Email: </label>
                <input type="email" id="email" placeholder="Ingresa tu email" required> <!---Al tener un type email, el arroba se muestra en el teclado del telefono valida q es un correo -->

                <label for="contraseña">Contraseña:</label>
                <input type="password" id="contraseña" placeholder="Ingresa tu contraseña" required>

                <label for="telefono">Telefono:</label>
                <input type="tel" id="telefono" placeholder="Ingresa tu numero" required>
            </fieldset>

            <fieldset>
                <legend>Datos de Empresa</legend>
                <label for="opciones">Tipo de persona</label>
                <select name="opciones" id="opciones">
                    <option value="" disabled selected>-- Seleccione --</option> 
                    <option value="natural">Natural</option>
                    <option value="empresa">Empresa</option>
                </select>

                <label for="tipo">Tipo de Persona:</label>
                <input type="text" id="tipo" placeholder="Escriba el tipo de persona...">

            </fieldset>
            <fieldset>
                <div class="container-boton">
                    <input type="submit" name="" value="Solicitar Registro">
                </div>
                <div class="texto-login">
                    <h4 class="texto-registro">¿Ya estás registrado?</h4> 
                    <a class="btn-login1" href="login.php"> Inicia sesión</a> 
                </div>
            </fieldset>
        </form>
</div>

    <script src="js/ver_clave.js"></script>
    <script src="js/cerrarVentanita.js"></script>
</body>
</html>