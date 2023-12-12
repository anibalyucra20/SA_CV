<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");
include("../../include/funciones.php");

//no recibir dni  buscar dn BD
$id_apoderado = $_POST['id_apoderado'];
$apellidos_nombres = $_POST['editar_apellidos_nombres'];
$correo = $_POST['editar_correo'];
$direccion = $_POST['editar_direccion'];
$telefono = $_POST['editar_telefono'];
$fecha_nacimiento = $_POST['editar_fecha_nacimiento'];
$genero = $_POST['editar_genero'];
$id_estudiantes = $_POST['id_estudiantes'];


    $consulta = "UPDATE apoderado SET apellidos_nombres='$apellidos_nombres', correo='$correo', telefono='$telefono',direccion='$direccion',fecha_nac='$fecha_nacimiento', genero='$genero',id_estudiantes='$id_estudiantes' WHERE id='$id_apoderado'";

$ejecutar_consulta = mysqli_query($conexion, $consulta);
if ($ejecutar_consulta) {
    echo "<script>
                alert('Datos Actualizados Correctamente');
                window.location= '../apoderados.php';
                </script>
                ";
}else {
    echo "<script>
        alert('Error, Error al Actualizar Datos');
        window.history.back();
    </script>
    ";
}
