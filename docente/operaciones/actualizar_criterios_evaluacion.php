<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");
include("../../include/funciones.php");

$id_calificacion = $_POST['data_id'];


$b_calificacion = buscar_calificacionPorId($conexion, $id_calificacion);
$rb_calificacion = mysqli_fetch_array($b_calificacion);
$orden_calif = $rb_calificacion['orden'];

$b_det_mat = buscar_detmatriculadosPorId($conexion, $rb_calificacion['id_detalle_maticula']);
$rb_det_mat = mysqli_fetch_array($b_det_mat);

$id_curso_programado = $rb_det_mat['id_curso_programado'];



// buscamos los matriculados a esta area
$contar_errores = 0;
$b_detmatriculas = buscar_detmatriculadosPorIdCursoProg($conexion, $id_curso_programado);
while ($rb_det_mat = mysqli_fetch_array($b_detmatriculas)) {
    $id_det_matricula = $rb_det_mat['id'];
    //buscar matricula de estudiante
    $b_matricula = buscar_matriculasPorId($conexion, $rb_det_mat['id_matricula']);
    $rb_matricula = mysqli_fetch_array($b_matricula);
    $id_estudiante = $rb_matricula['id_estudiante'];

    $b_estudiante = buscar_estudiantePorId($conexion, $id_estudiante);
    $rb_estudiante = mysqli_fetch_array($b_estudiante);
    $dni_estudiante = $rb_estudiante['dni'];

    $b_calificacion = buscar_calificacionPorIdDetMatOrden($conexion, $id_det_matricula, $orden_calif);
    while ($rb_calificacion = mysqli_fetch_array($b_calificacion)) {
        $id_calificacion = $rb_calificacion['id'];

        $b_evaluacion = buscar_EvaluacionPorIdCalificacion($conexion, $id_calificacion);
        while ($rb_evaluacion = mysqli_fetch_array($b_evaluacion)) {
            $id_evaluacion = $rb_evaluacion['id'];
            $b_ind_logro = buscar_CritEvaPorIdEvaluacion($conexion, $id_evaluacion);
            while ($rb_ind_logro = mysqli_fetch_array($b_ind_logro)) {
                $id_crit = $rb_ind_logro['id'];
                $nota = $_POST[$dni_estudiante . "_" . $id_crit];
                if ($nota >= 0 && $nota <= 20) {
                    $consulta = "UPDATE criterio_evaluacion SET calificacion='$nota' WHERE id='$id_crit'";
                    $ejec_consulta = mysqli_query($conexion, $consulta);
                    if (!$ejec_consulta) {
                        $contar_errores++;
                    }
                }
            }
        }
    }
}

if ($contar_errores > 0) {
    echo "<script>
                alert('Hubo " . $contar_errores . " errores al actualizar calificaciones');
                window.location= '../evaluacion.php';
                </script>
                ";
} else {
    echo "<script>
                window.location= '../evaluacion.php?data=" . $id_calificacion . "';
                </script>
                ";
}
