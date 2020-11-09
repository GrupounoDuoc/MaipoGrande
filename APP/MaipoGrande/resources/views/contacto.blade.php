<?php 

    session_start();

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Contacto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
    <link rel="stylesheet" href="css/contacto.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR" rel="stylesheet">
    <link rel="stylesheet" href="iconos/style.css">
    <link rel="stylesheet" href="iconos/icon-cerrar/style.css">
  </head>
  <body>

    <header>
        <img src="imagenes/manzana.png" class="img-logo">
        <h1 class="logo">Maipo Grande</h1>
        <img src="imagenes/menu.png" class="icon-menu" id="boton-menu">
        <nav>
            <ul>
                <?php if (empty($_SESSION['datos'])) { ?>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="login.php">Entrar</a></li>
                    <li><a href="registro.php?dato=3">Registrarse</a></li>
                    <li><a href="#">Contacto</a></li>
                    <li><a href=""><span class="icon-search"></span></a></li>
                         
                <?php }else { ?>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="#">Contacto</a></li>
                    <li><a href=""><span class="icon-search"></span></a></li>   
                <?php } ?>
            </ul>
        </nav>
    </header>
           <div class="menu-lateralResponsive" id="menu-responsive">
               <nav class="nav-responsive">
                   <ul>
                       <li><a href="login.php">Entrar</a></li>
                       <li><a href="registro.php">Registrarse</a></li>
                       <li><a href="#">Contacto</a></li>
                       <li><a href=""></a></li>
                   </ul>
               </nav>  
           </div>

    <div id="titulo"> 
        <h1>¡Env&iacuteanos t&uacute problema</h1>
        <h1>o sugerencia!</h1>
    </div>
    <?php if (isset($_SESSION['mensajeCorrecto'])) { ?>
        <div class="mensaje-succes" id="ventana-emergente">
            <?php echo $_SESSION['mensajeCorrecto'] ?>
            <span class="icon-cancel-circle" id="close-alert"></span>
        </div>
    <?php session_unset(); } ?>
    <div class="login-box">
      
      <form action="php/enviar.php" method="POST">
        <!-- ASUNTO INPUT -->
        <label for="username">Asunto:</label>
        <input type="text" name="posdata" placeholder="Ingresa un asunto">

        <!-- NOMBRE INPUT -->
        <label for="password">Nombre:</label>
        <input type="text" name="nombre" placeholder=" Escribe tu nombre">
       

         <!-- CORREO INPUT -->
        <label for="password">Correo:</label>
        <input type="text" name="correo" placeholder="Escribe t&uacute correo">

        <!-- MENSAJE INPUT -->
        <textarea name="mensaje" id="hola" cols="40" rows="5" placeholder="Escribe t&uacute mensaje"></textarea>
        
        <input type="submit" value="ENVIAR">

      </form>
    </div>
   </div> 
<!--Footer-->
    <footer>
        <div class="contenedor" >
            <div class="d-flex p-2 justify-content-center">
                 <div class="copyright">
                    © 2019 Todos los derechos reservados | Diseñado por <a href="/"> Maipo Grande </a>
                 </div>
            </div>
        </div>
    </footer>
    <script src="js/menu.js"></script>
    <script src="js/aparecerIcono.js"></script>
    <script src="js/cerrarVentanita.js"></script>
</body>
</html>