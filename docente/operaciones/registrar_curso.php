<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");

$grado = $_POST['grado'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];

$consulta = "INSERT INTO curso (nombre,descripcion,id_grado) VALUES ( '$nombre', '$descripcion', '$grado')";

$ejecutar_consulta = mysqli_query($conexion, $consulta);

if ($ejecutar_consulta) {
    echo "<script>
                alert('Se realizó el registro con éxito');
                window.location = '../cursos.php';
            </script>";
}else {
    echo "<script>
                alert('Error, error al registrar');
                window.history.back();
            </script>";
}
?>