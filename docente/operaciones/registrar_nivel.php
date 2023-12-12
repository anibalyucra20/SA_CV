<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");

$cod_modular = $_POST['codigo_modular'];
$nombre = $_POST['nombre'];
$id_sede = $_POST['id_sede'];


$consulta = "INSERT INTO nivel (cod_modular, nombre, id_sede) VALUES ('$cod_modular', '$nombre', '$id_sede')";

$ejecutar_consulta = mysqli_query($conexion, $consulta);

if ($ejecutar_consulta) {
    echo "<script>
                alert('Se realizó el registro con éxito');
                window.location = '../nivel.php';
            </script>";
}else {
    echo "<script>
                alert('Error, error al registrar');
                window.history.back();
            </script>";
}
