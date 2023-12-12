<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");
include("../../include/funciones.php");

$id_grado= $_POST['data'];
$editar_ciclo= $_POST['editar_ciclo'];
$editar_grado = $_POST['editar_grado'];

    $consulta = "UPDATE grado SET nombre='$editar_grado', id_ciclo='$editar_ciclo' WHERE id='$id_grado'";

$ejecutar_consulta = mysqli_query($conexion, $consulta);
if ($ejecutar_consulta) {
    echo "<script>
                alert('Datos Actualizados Correctamente');
                window.location= '../grados.php';
                </script>
                ";
}else {
    echo "<script>
        alert('Error, Error al Actualizar Datos');
        window.history.back();
    </script>
    ";
}
