<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");
include("../../include/funciones.php");

//no recibir dni  buscar dn BD
$id = $_POST['data_editar'];
$nombre = $_POST['nombre'];
$departamento = $_POST['departamento'];
$provincia = $_POST['provincia'];
$distrito = $_POST['distrito'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$responsable = $_POST['responsable'];
$tipo_sede = $_POST['tipo_sede'];

$consulta = "UPDATE sede SET nombre='$nombre', departamento='$departamento', provincia='$provincia',distrito='$distrito',direccion='$direccion', telefono='$telefono', correo='$correo', id_responsable='$responsable', tipo='$tipo_sede' WHERE id='$id'";


$ejecutar_consulta = mysqli_query($conexion, $consulta);
if ($ejecutar_consulta) {
    echo "<script>
                alert('Datos Actualizados Correctamente');
                window.location= '../sedes.php';
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