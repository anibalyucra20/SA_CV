<?php
session_start();
include("../../include/conexion.php");
include("../../include/busquedas.php");
include("../../include/funciones.php");

// Recoge los datos del formulario
$id_est = $_POST['id_est'];
$sede_m = $_POST['sede_m'];
$nivel_m = $_POST['nivel_m'];
$grado_m = $_POST['grado_m'];
$turno_m = $_POST['turno_m'];
$seccion_m = $_POST['seccion_m'];
$id_anio = $_SESSION['anio_lectivo'];
$fecha = date("Y-m-d");

// Realiza la inserción en la base de datos
$consulta = "INSERT INTO matricula (id_anio_academico, id_sede, id_nivel, id_grado, id_turno, id_seccion,id_estudiante,fecha) VALUES ('$id_anio', '$sede_m', '$nivel_m', '$grado_m', '$turno_m', '$seccion_m', '$id_est', '$fecha')";
$resultado = mysqli_query($conexion, $consulta);
//buscamos el ultimo registro de la matricula
$id_matricula = mysqli_insert_id($conexion);

if ($resultado) {

    $b_cursos = buscar_cursoPorIdGrado($conexion, $grado_m);
    while ($r_b_cursos = mysqli_fetch_array($b_cursos)) {
        $id_curso = $r_b_cursos['id'];
        $busc_progr = buscar_cursos_prog_porSede_Anio_grado_turno_seccion($conexion, $sede_m, $id_anio, $id_curso, $turno_m, $seccion_m);
        
        $cont = mysqli_num_rows($busc_progr);
        if ($cont > 0) {
            $r_b_curso_prog = mysqli_fetch_array($busc_progr);
            
            $id_curso_prog = $r_b_curso_prog['id'];

            $b_cant_matriculados = buscar_detmatriculadosPorIdCursoProg($conexion, $id_curso_prog);
            $contar_matriculados = mysqli_num_rows($b_cant_matriculados);
            $new_orden = $contar_matriculados + 1;

            $consulta_reg_det = "INSERT INTO detalle_matricula (id_matricula,id_curso_programado,orden,recuperacion_activa,recuperacion,mostrar_calificacion) VALUES ('$id_matricula','$id_curso_prog','$new_orden',0,'',0)";
            $ejec_det_mat = mysqli_query($conexion, $consulta_reg_det);

            //buscamos el ultimo registro del detalle de matricula
            $id_detalle_matricula = mysqli_insert_id($conexion);

            //buscar periodo lectivo (trimestre, bimestre, etc)
            $b_periodo_lectivo = buscar_periodos($conexion);
            $cant_peridos = mysqli_num_rows($b_periodo_lectivo);
            $ponderado_calif = round(100 / $cant_peridos);
            $orden_calif = 0;
            while ($r_b_periodo = mysqli_fetch_array($b_periodo_lectivo)) {
                $orden_calif++;
                $detalle = $r_b_periodo['nombre'];
                //registramos calificaciones (trimestres)
                $reg_calif = "INSERT INTO calificacion (id_detalle_maticula,orden,detalle,ponderado) VALUES ('$id_detalle_matricula','$orden_calif','$detalle','$ponderado_calif')";
                $ejec_reg_calif = mysqli_query($conexion, $reg_calif);

                //buscamos el ultimo registro de la calificacion
                $id_calificacion = mysqli_insert_id($conexion);

                //buscar competencias para definir cantidad de evaluaciones
                $b_competencias = buscar_competenciaPorIdCurso($conexion, $id_curso);
                $cant_competencias = mysqli_num_rows($b_competencias);
                $ponderado_eva = round(100 / $cant_competencias);
                while ($r_b_competencias = mysqli_fetch_array($b_competencias)) {
                    $id_competencia = $r_b_competencias['id'];
                    $nom_competencia = $r_b_competencias['nombre'];
                    //registramos evaluacion
                    $reg_eva = "INSERT INTO evaluacion (id_calificacion,detalle,ponderado) VALUES('$id_calificacion','$nom_competencia','$ponderado_eva')";
                    $ejec_reg_eva = mysqli_query($conexion, $reg_eva);

                    //buscamos el ultimo registro de la evaluacion
                    $id_evaluacion = mysqli_insert_id($conexion);

                    // buscamos capacidades para definir cantidad de criterios de evaluacion
                    $b_capcaidades = buscar_capacidadPorIdCompetencia($conexion, $id_competencia);
                    $cant_capacidades = mysqli_num_rows($b_capcaidades);
                    $ponderado_c_eva = round(100 / $cant_capacidades);
                    $cont_orden=0;
                    while ($r_b_capacidades = mysqli_fetch_array($b_capcaidades)) {
                        $cont_orden++;
                        //registramos criterios de evaluacion
                        $reg_crit_eva = "INSERT INTO criterio_evaluacion (id_evaluacion,orden,detalle,calificacion,ponderado) VALUES ('$id_evaluacion','$cont_orden','','','$ponderado_c_eva')";
                        $ejec_reg_crit_eva = mysqli_query($conexion, $reg_crit_eva);
                    }

                }
            }
        }
    }
}
