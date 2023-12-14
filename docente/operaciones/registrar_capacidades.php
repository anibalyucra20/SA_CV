<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$id_competencia = $_POST['id_competencia'];

$consulta = "INSERT INTO capacidad (nombre,descripcion,id_competencia) VALUES ( '$nombre', '$descripcion','$id_competencia')";

$ejecutar_consulta = mysqli_query($conexion, $consulta);

if ($ejecutar_consulta) {
    echo "<script>
                alert('Se realizó el registro con éxito');
                window.location = '../capacidades.php?competencia=".$id_competencia."';
            </script>";
}else {
    echo "<script>
                alert('Error, error al registrar');
                window.history.back();
            </script>";
}
?>