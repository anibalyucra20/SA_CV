<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");
include("../../include/funciones.php");

$id_crit_eva = $_GET['id'];
$detalle_crit_eva = $_GET['detalle'];
$id_evaluacion = $_GET['id_eva'];
$id_calificacion = $_GET['id_calif'];
$orden = $_GET['orden'];
$ponderado = $_GET['ponderado'];

$b_evaa = buscar_EvaluacionPorId($conexion, $id_evaluacion);
$rb_eva = mysqli_fetch_array($b_evaa);
$detalle_eva = $rb_eva['detalle'];



$b_calificacion = buscar_calificacionPorId($conexion, $id_calificacion);
$rb_calificacion = mysqli_fetch_array($b_calificacion);
$orden_calif = $rb_calificacion['orden'];

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
            $b_crit_eva = buscar_CritEvaPorIdEvaluacionOrden($conexion, $id_eva, $orden);
            while ($rb_ind_logro = mysqli_fetch_array($b_crit_eva)) {
                $id_crit = $rb_ind_logro['id'];
                $consulta = "UPDATE criterio_evaluacion SET detalle='$detalle_crit_eva', ponderado='$ponderado' WHERE id='$id_crit' AND orden='$orden'";
                $ejec_consulta = mysqli_query($conexion, $consulta);
                if (!$ejec_consulta) {
                    $contar_errores++;
                }
            }

            
        }
    }
}



if ($contar_errores > 0) {
    echo "<script>
                alert('Hubo " . $contar_errores .$ponderado. " errores al actualizar el detalle del criterio de evalaución');
                window.location= '../evaluacion.php?data=" . $id_calificacion . "';
                </script>
                ";
} else {
    echo "<script>
                window.location= '../evaluacion.php?data=" . $id_calificacion . "';
                </script>
                ";
}