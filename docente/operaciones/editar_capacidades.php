<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");
include("../../include/funciones.php");

//no recibir dni  buscar dn BD
$id_competencia = $_POST['id_competencia'];
$id = $_POST['data'];
$nombre = $_POST['nombre_capacidades'];
$descripcion = $_POST['descripcion'];



$consulta = "UPDATE capacidad SET nombre='$nombre', descripcion='$descripcion' WHERE id='$id'";


$ejecutar_consulta = mysqli_query($conexion, $consulta);
if ($ejecutar_consulta) {
    echo "<script>
                alert('Datos Actualizados Correctamente');
                window.location= '../capacidades.php?competencia=".$id_competencia."';
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