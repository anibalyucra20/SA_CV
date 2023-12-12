<?php
$host = "localhost";
$db = "sie";
$user_db = "root";
$pass_db = "root";

$conexion = mysqli_connect($host,$user_db,$pass_db,$db);

if ($conexion) {
	date_default_timezone_set("America/Lima"); 
	$conexion->set_charset("utf8");
}else{
	echo "error de conexion a la base de datos";
	
}
?>