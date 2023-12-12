<?php
function verificar_sesion($conexion){
	session_start();
	if (isset($_SESSION['id_sesion_sie'])) {


		$b_sesion = buscar_sesion_porID($conexion, $_SESSION['id_sesion_sie']);
        $r_b_sesion = mysqli_fetch_array($b_sesion);
        $id_trabajador = $r_b_sesion['id_trabajador'];

		$b_docente = buscar_docentePorId($conexion, $id_trabajador);
		$r_b_docente = mysqli_fetch_array($b_docente);
		$cargo = $r_b_docente['cargo'];

		$sesion_activa = sesion_si_activa($conexion, $_SESSION['id_sesion_sie'], $_SESSION['token_sie']);

		if (!$sesion_activa) {
			echo "<script>
                alert('La Sesion Caducó, Inicie Sesión');
                window.location.replace('../include/cerrar_sesion.php');
    		</script>";
		}else {

				return $cargo;
			
		}
		
	}else {
		return "";
	}
}


?>