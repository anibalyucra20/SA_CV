
<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");
include("../../include/funciones.php");
// Recoge los datos del formulario

$id_periodo = $_POST['data'];
$nombre = $_POST['editar_anio'];
$sede = $_POST['editar_sede'];
$director = $_POST['editar_director'];
$secretario_academico = $_POST['editar_secretario'];
$fecha_inicio = $_POST['editar_fecha_inicio'];
$fecha_fin = $_POST['editar_fecha_fin'];

// Realiza la actualización en la base de datos
$consulta = "UPDATE anio_academico SET nombre = '$nombre', id_director = '$director', id_secretario = '$secretario_academico', fecha_inicio = '$fecha_inicio', fecha_fin = '$fecha_fin', id_sede='$sede' WHERE id = $id_periodo";
$resultado = mysqli_query($conexion, $consulta);

if ($resultado) {
    echo "<script>
                alert('Datos Actualizados Correctamente');
                window.location= '../periodo_academico.php';
                </script>
                ";
} else {
    echo "<script>
        alert('Error, Error al Actualizar Datos');
        window.history.back();
    </script>
    ";
}
?>