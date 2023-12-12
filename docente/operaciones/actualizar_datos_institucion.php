<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");
include("../../include/funciones.php");
$id = $_POST['id'];
$ruc = $_POST['ruc'];
$cod_modular = $_POST['cod_modular'];
$razon_social = $_POST['razon_social'];
$dep = $_POST['dep'];
$provincia = $_POST['provincia'];
$distrito = $_POST['distrito'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];

$consulta = "UPDATE datos_institucionales SET ruc='$ruc', cod_modular='$cod_modular',  razon_social='$razon_social', departamento='$dep', provincia='$provincia', distrito='$distrito', direccion='$direccion', telefono='$telefono', correo='$email' WHERE id=$id";
$ejec_consulta = mysqli_query($conexion, $consulta);
	if ($ejec_consulta) {
			echo "<script>
					alert('Datos actualizados de manera Correcta');
					window.location= '../datos_institucionales.php';
				</script>
			";
	}else {
			echo "<script>
					alert('Error al Actualizar Registro, por favor contacte con el administrador');
					window.history.back();
				</script>
			";
	}

mysqli_close($conexion);
