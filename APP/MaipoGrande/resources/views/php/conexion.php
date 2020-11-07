 <?php
	$conexion = new mysqli("localhost", "root", "", "maipogrande");
	if (mysqli_connect_error()) {
		echo "Conexcion Fallida";
	}
	$conexion->set_charset("utf8");
?>


