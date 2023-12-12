<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");

$modalidad = $_POST['modalidad'];

$consulta = "INSERT INTO modalidad (detalle) VALUES ('$modalidad')";

$ejecutar_consulta = mysqli_query($conexion, $consulta);

if ($ejecutar_consulta) {
    echo "<script>
                alert('Se realizó el registro con éxito');
                window.location = '../modalidad.php';
            </script>";
}else {
    echo "<script>
                alert('Error, error al registrar');
                window.history.back();
            </script>";
}
