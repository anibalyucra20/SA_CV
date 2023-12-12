<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");
include("../../include/funciones.php");


$id_evaluacion = $_GET['id'];
$id_calificacion = $_GET['id_calif'];
$peso = $_GET['peso'];


$b_evaluacion = buscar_EvaluacionPorId($conexion, $id_evaluacion);
$rb_evaluacion = mysqli_fetch_array($b_evaluacion);
$detalle_eva = $rb_evaluacion['detalle'];

$b_calificacion = buscar_calificacionPorId($conexion, $id_calificacion);
$rb_calificacion = mysqli_fetch_array($b_calificacion);
$orden_calif = $rb_calificacion['orden'];

echo $peso;


$b_det_mat = buscar_detmatriculadosPorId($conexion, $rb_calificacion['id_detalle_maticula']);
$rb_det_mat = mysqli_fetch_array($b_det_mat);

$id_curso_programado = $rb_det_mat['id_curso_programado'];

$contar_errores = 0;
$b_detmatriculas = buscar_detmatriculadosPorIdCursoProg($conexion, $id_curso_programado);
while ($rb_det_mat = mysqli_fetch_array($b_detmatriculas)) {
    $id_det_mat = $rb_det_mat['id'];
    $b_calificaciones = buscar_calificacionPorIdDetMatOrden($conexion, $id_det_mat,$orden_calif);
    while ($rb_calificaciones = mysqli_fetch_array($b_calificaciones)) {
        $id_calif = $rb_calificaciones['id'];
        $b_evaluacion = buscar_EvaluacionPorIdCalificacion_Detalle($conexion, $id_calif,$detalle_eva);
        while ($rb_evaluacion = mysqli_fetch_array($b_evaluacion)) {
            $id_eva= $rb_evaluacion['id'];
            $consulta = "UPDATE evaluacion SET ponderado='$peso' WHERE id='$id_eva'";
            $ejec_consulta = mysqli_query($conexion, $consulta);
            if (!$ejec_consulta) {
                $contar_errores++;
            }
        }
    }
}


if ($contar_errores > 0) {
    echo "<script>
                alert('Hubo " . $contar_errores . " errores al actualizar');
                window.location= '../evaluacion.php?data=" . $id_calificacion . "';
                </script>
                ";
} else {
    echo "<script>
                window.location= '../evaluacion.php?data=" . $id_calificacion . "';
                </script>
                ";
}

