<?php
include '../../include/conexion.php';
include "../../include/busquedas.php";
include "../../include/funciones.php";


$id_sede = $_POST['id'];

	$ejec_cons = buscar_sedesPorId($conexion, $id_sede);

		$cadena = '<option></option>';
		while ($mostrar=mysqli_fetch_array($ejec_cons)) {
			$cadena=$cadena.'<option value='.$mostrar['id'].' selected >'. $mostrar['nombre'].'</option>';
		}
		echo $cadena;

?>