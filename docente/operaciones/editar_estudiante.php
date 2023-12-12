<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");
include("../../include/funciones.php");

//no recibir dni  buscar dn BD     --- los datos de la variable  son del formulario 
$id = $_POST['id_estudiante'];
$dni = $_POST['editar_dni'];
$apellidos_nombres = $_POST['editar_apellidos_nombres'];
$correo = $_POST['editar_correo'];
$direccion = $_POST['editar_direccion'];
$telefono = $_POST['editar_telefono'];
$fecha_nacimiento = $_POST['editar_fecha_nacimiento'];
$genero = $_POST['editar_genero'];

$sede = $_POST['editar_sede'];
$discapacidad = $_POST['editar_discapacidad'];


$consulta = "UPDATE estudiante SET dni='$dni', apellidos_nombres='$apellidos_nombres', correo='$correo',telefono='$telefono',direccion='$direccion', fecha_nac='$fecha_nacimiento', genero='$genero',  id_sede='$sede',  discapacidad='$discapacidad' WHERE id='$id'";


$ejecutar_consulta = mysqli_query($conexion, $consulta);
if ($ejecutar_consulta) {
    echo "<script>
                alert('Datos Actualizados Correctamente');
                window.location= '../estudiantes.php';
                </script>
                ";
}else {
    echo "<script>
        alert('Error, Error al Actualizar Datos');
        window.history.back();
    </script>
    ";
}

