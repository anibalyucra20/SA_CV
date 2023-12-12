<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");
include("../../include/funciones.php");

//no recibir dni  buscar dn BD
$id = $_POST['data'];
$nombre = $_POST['editar_turno'];


$consulta = "UPDATE turno SET nombre='$nombre' WHERE id='$id'";


$ejecutar_consulta = mysqli_query($conexion, $consulta);
if ($ejecutar_consulta) {
    echo "<script>
                alert('Datos Actualizados Correctamente');
                window.location= '../turnos.php';
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