<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");

$nombre = $_POST['nombre'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];

$consulta = "INSERT INTO periodo_lectivo (nombre, fecha_inicio, fecha_fin) VALUES ('$nombre', '$fecha_inicio', '$fecha_fin')";

$ejecutar_consulta = mysqli_query($conexion, $consulta);

if ($ejecutar_consulta) {
    echo "<script>
                alert('Se realizó el registro con éxito');
                window.location = '../periodo_lectivo.php';
            </script>";
}else {
    echo "<script>
                alert('Error, error al registrar');
                window.history.back();
            </script>";
}
