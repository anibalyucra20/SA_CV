<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");
include("../../include/funciones.php");

$id_nivel= $_POST['data'];
$codigo_modular= $_POST['editar_codigo_modular'];
$nombre_nivel = $_POST['editar_nombre'];
$id_sede = $_POST['editar_sede'];

    $consulta = "UPDATE nivel SET cod_modular='$codigo_modular', nombre='$nombre_nivel', id_sede='$id_sede' WHERE id='$id_nivel'";

$ejecutar_consulta = mysqli_query($conexion, $consulta);
if ($ejecutar_consulta) {
    echo "<script>
                alert('Datos Actualizados Correctamente');
                window.location= '../nivel.php';
                </script>
                ";
}else {
    echo "<script>
        alert('Error, Error al Actualizar Datos');
        window.history.back();
    </script>
    ";
}
