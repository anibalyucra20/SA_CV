<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");

$nombre = $_POST['seccion'];

$consulta = "INSERT INTO seccion (nombre) VALUES ( '$nombre')";

$ejecutar_consulta = mysqli_query($conexion, $consulta);

if ($ejecutar_consulta) {
    echo "<script>
                alert('Se realizó el registro con éxito');
                window.location = '../secciones.php';
            </script>";
}else {
    echo "<script>
                alert('Error, error al registrar');
                window.history.back();
            </script>";
}
?>