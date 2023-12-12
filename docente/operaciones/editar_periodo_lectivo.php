
<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");
include("../../include/funciones.php");
// Recoge los datos del formulario
$id = $_POST['data'];
$nombre = $_POST['editar_nombre'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];

// Realiza la actualización en la base de datos
$consulta = "UPDATE periodo_lectivo SET nombre = '$nombre',fecha_inicio = '$fecha_inicio', fecha_fin = '$fecha_fin' WHERE id = $id";
$resultado = mysqli_query($conexion, $consulta);

if ($resultado) {
    echo "<script>
                alert('Datos Actualizados Correctamente');
                window.location= '../periodo_lectivo.php';
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