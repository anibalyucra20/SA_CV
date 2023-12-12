<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");
include("../../include/funciones.php");

//no recibir dni  buscar dn BD
$id_curso = $_POST['curso'];
$id = $_POST['data'];
$nombre = $_POST['editar_competencia'];
$enfoque = $_POST['editar_enfoque'];
$descripcion_competencia = $_POST['editar_descripcion_competencia'];



$consulta = "UPDATE competencia SET nombre='$nombre', enfoque='$enfoque', descripcion='$descripcion_competencia'WHERE id='$id'";


$ejecutar_consulta = mysqli_query($conexion, $consulta);
if ($ejecutar_consulta) {
    echo "<script>
                alert('Datos Actualizados Correctamente');
                window.location= '../competencias.php?curso=".$id_curso."';
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