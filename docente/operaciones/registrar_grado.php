<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");

$id_ciclo = $_POST['ciclo'];
$grado = $_POST['grado'];

$consulta = "INSERT INTO grado (nombre, id_ciclo) VALUES ('$grado', '$id_ciclo')";

$ejecutar_consulta = mysqli_query($conexion, $consulta);

if ($ejecutar_consulta) {
    echo "<script>
                alert('Se realizó el registro con éxito');
                window.location = '../grados.php';
            </script>";
}else {
    echo "<script>
                alert('Error, error al registrar');
                window.history.back();
            </script>";
}
