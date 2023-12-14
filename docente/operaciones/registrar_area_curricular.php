<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");

$nivel = $_POST['nivel'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];

$consulta = "INSERT INTO area_curricular (nombre,descripcion,id_nivel) VALUES ( '$nombre', '$descripcion', '$nivel')";

$ejecutar_consulta = mysqli_query($conexion, $consulta);

if ($ejecutar_consulta) {
    echo "<script>
                alert('Se realizó el registro con éxito');
                window.location = '../area_curricular.php';
            </script>";
}else {
    echo "<script>
                alert('Error, error al registrar');
                window.history.back();
            </script>";
}
?>