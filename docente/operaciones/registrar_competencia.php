<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");

$nombre = $_POST['nombre'];
$enfoque = $_POST['enfoque'];
$descripcion = $_POST['descripcion'];
$id_curso = $_POST['id_curso'];

$consulta = "INSERT INTO competencia (nombre,enfoque,descripcion,id_curso) VALUES ( '$nombre', '$enfoque','$descripcion','$id_curso')";

$ejecutar_consulta = mysqli_query($conexion, $consulta);

if ($ejecutar_consulta) {
    echo "<script>
                alert('Se realizó el registro con éxito');
                window.location = '../competencias.php?curso=".$id_curso."';
            </script>";
}else {
    echo "<script>
                alert('Error, error al registrar');
                window.history.back();
            </script>";
}
?>