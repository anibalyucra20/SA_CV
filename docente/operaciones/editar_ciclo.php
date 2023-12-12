<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");
include("../../include/funciones.php");

//no recibir dni  buscar dn BD
$id = $_POST['data'];
$nombre_ciclo = $_POST['nombre_ciclo'];
$descripcion = $_POST['descripcion'];
$id_nivel = $_POST['id_nivel'];



$consulta = "UPDATE ciclo SET nombre='$nombre_ciclo', descripcion='$descripcion', id_nivel='$id_nivel'WHERE id='$id'";


$ejecutar_consulta = mysqli_query($conexion, $consulta);
if ($ejecutar_consulta) {
    echo "<script>
                alert('Datos Actualizados Correctamente');
                window.location= '../ciclos.php';
                </script>
                ";
}else {
    echo "<script>
        alert('Error, Error al Actualizar Datos');
        window.history.back();
    </script>
    ";
}



?>