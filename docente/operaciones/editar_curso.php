<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");
include("../../include/funciones.php");

//no recibir dni  buscar dn BD
$id = $_POST['data'];
$nombre = $_POST['editar_curso'];
$descripcion_curso = $_POST['descripcion_curso'];
$id_grado = $_POST['id_grado'];


$consulta = "UPDATE curso SET nombre='$nombre', descripcion='$descripcion_curso', id_grado='$id_grado' WHERE id='$id'";


$ejecutar_consulta = mysqli_query($conexion, $consulta);
if ($ejecutar_consulta) {
    echo "<script>
                alert('Datos Actualizados Correctamente');
                window.location= '../cursos.php';
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