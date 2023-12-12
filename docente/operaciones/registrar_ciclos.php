<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");

$nombre = $_POST['nombre_ciclo'];
$descripcion = $_POST['descripcion'];
$id_nivel= $_POST['id_nivel'];

$consulta = "INSERT INTO ciclo (nombre,descripcion,id_nivel) VALUES ( '$nombre', '$descripcion','$id_nivel')";

$ejecutar_consulta = mysqli_query($conexion, $consulta);

if ($ejecutar_consulta) {
    echo "<script>
                alert('Se realizó el registro con éxito');
                window.location = '../ciclos.php';
            </script>";
}else {
    echo "<script>
                alert('Error, error al registrar');
                window.history.back();
            </script>";
}
?>