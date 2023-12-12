<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");
include("../../include/funciones.php");

$id_curso_programado = $_GET['data'];
$nro_calificacion = $_GET['data2'];
$evaluacion = $_GET['data3'];
$id_calificacion_rr = $_GET['data4'];

$contar_errores = 0;
$b_matriculados = buscar_detmatriculadosPorIdCursoProg($conexion, $id_curso_programado);
while ($rb_matriculados = mysqli_fetch_array($b_matriculados)) {
    $id_det_mat = $rb_matriculados['id'];
    $b_calificaciones = buscar_calificacionPorIdDetMatOrden($conexion, $id_det_mat, $nro_calificacion);
    $rb_calificaciones = mysqli_fetch_array($b_calificaciones);
    $id_calificacion = $rb_calificaciones['id'];

    $b_evaluacion = buscar_EvaluacionPorIdCalificacion_Detalle($conexion, $id_calificacion, $evaluacion);
    $rb_evaluacion = mysqli_fetch_array($b_evaluacion);
    $id_evaluacion = $rb_evaluacion['id'];

    $b_crit_evaluacion = buscar_CritEvaPorIdEvaluacion($conexion, $id_evaluacion);
    $cont_crit_eva = mysqli_num_rows($b_crit_evaluacion) + 1;

    $consulta = "INSERT INTO criterio_evaluacion (id_evaluacion, orden, detalle, calificacion, ponderado) VALUES ('$id_evaluacion','$cont_crit_eva','','','0')";
    $ejec_consulta= mysqli_query($conexion, $consulta);
    if (!$ejec_consulta) {
        $contar_errores++;
    }
}

if ($contar_errores>0) {
    echo "<script>
				  alert('Error, no se agregaron ".$contar_errores." nuevos indicador de logro');
				  window.history.back();
			  </script>";
}else{
    echo "<script>
				  alert('Se agregó un criterio de evaluación');
				  window.location.replace('../evaluacion.php?data=" . $id_calificacion_rr."');
			  </script>";
}

