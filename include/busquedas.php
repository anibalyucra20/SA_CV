<?php
// busquedas docente
function buscar_docenteByDni($conexion, $dni){
    $consulta = "SELECT * FROM trabajador WHERE dni='$dni'";
    return mysqli_query($conexion, $consulta);
}
function buscar_docente($conexion){
    $consulta = "SELECT * FROM trabajador";
    return mysqli_query($conexion, $consulta);
}
function buscar_docentePorId($conexion, $id){
    $consulta = "SELECT * FROM trabajador WHERE id='$id'";
    return mysqli_query($conexion, $consulta);
}
function buscar_docentePorCargo($conexion, $cargo){
    $consulta = "SELECT * FROM trabajador WHERE cargo='$cargo'";
    return mysqli_query($conexion, $consulta);
}
function buscar_docenteOrdenAp($conexion){
    $consulta = "SELECT * FROM trabajador ORDER BY apellidos_nombres ASC";
    return mysqli_query($conexion, $consulta);
}

// busquedas estudiantes
function buscar_estudiante($conexion){
    $consulta = "SELECT * FROM estudiante";
    return mysqli_query($conexion, $consulta);
}
function buscar_estudiantePorId($conexion, $id){
    $consulta = "SELECT * FROM estudiante WHERE id='$id'";
    return mysqli_query($conexion, $consulta);
}
function buscar_estudiantePorDni($conexion, $dni){
    $consulta = "SELECT * FROM estudiante WHERE dni='$dni'";
    return mysqli_query($conexion, $consulta);
}
function buscar_estudiantePorDniNombres($conexion, $dni, $nombres){
    $consulta = "SELECT * FROM estudiante WHERE dni='$dni' AND apellidos_nombres='$nombres'";
    return mysqli_query($conexion, $consulta);
}
//buscar apoderados
function buscar_apoderados($conexion){
    $consulta = "SELECT * FROM apoderado";
    return mysqli_query($conexion, $consulta);
}
function buscar_apoderadoPorId($conexion, $id){
    $consulta = "SELECT * FROM apoderado WHERE id='$id'";
    return mysqli_query($conexion, $consulta);
}
function buscar_apoderadoPorDni($conexion, $dni){
    $consulta = "SELECT * FROM apoderado WHERE dni='$dni'";
    return mysqli_query($conexion, $consulta);
}
// busquedas sedes

function buscar_sedes($conexion){
    $consulta = "SELECT * FROM sede";
    return mysqli_query($conexion, $consulta);
}
function buscar_sedesPorId($conexion, $id){
    $consulta = "SELECT * FROM sede WHERE id='$id'";
    return mysqli_query($conexion, $consulta);
}

//busquedas datos institucionales
function buscar_datos_institucionales($conexion){
    $consulta = "SELECT * FROM datos_institucionales";
    return mysqli_query($conexion, $consulta);
}
//busquedas datos de sistema
function buscar_datos_sistema($conexion){
    $consulta = "SELECT * FROM datos_sistema";
    return mysqli_query($conexion, $consulta);
}

//busqueda niveles 
function buscar_nivel($conexion){
    $consulta = "SELECT * FROM nivel";
    return mysqli_query($conexion, $consulta);
}

function buscar_nivel_id($conexion, $id){
    $consulta = "SELECT * FROM nivel WHERE id='$id'";
    return mysqli_query($conexion, $consulta);
}
function buscar_nivel_idSede($conexion, $idsede){
    $consulta = "SELECT * FROM nivel WHERE id_sede='$idsede'";
    return mysqli_query($conexion, $consulta);
}

//busqueda turno 
function buscar_turno($conexion){
    $consulta = "SELECT * FROM turno";
    return mysqli_query($conexion, $consulta);
}

function buscar_turno_id($conexion, $id){
    $consulta = "SELECT * FROM turno WHERE id='$id'";
    return mysqli_query($conexion, $consulta);
}

//busqueda año academico
function buscar_anio_academico($conexion){
    $consulta = "SELECT * FROM anio_academico";
    return mysqli_query($conexion, $consulta);
}
function buscar_anio_academicoInvertidoporSede($conexion,$sede){
    $consulta = "SELECT * FROM anio_academico WHERE id_sede='$sede' ORDER BY id DESC";
    return mysqli_query($conexion, $consulta);
}

function buscar_anio_academico_id($conexion, $id){
    $consulta = "SELECT * FROM anio_academico WHERE id='$id'";
    return mysqli_query($conexion, $consulta);
}
function buscar_anio_academico_id_sede($conexion, $id_sede){
    $consulta = "SELECT * FROM anio_academico WHERE id_sede='$id_sede'";
    return mysqli_query($conexion, $consulta);
}
function buscar_anio_academicoultimoporSede($conexion,$id_sede){
    $consulta = "SELECT * FROM anio_academico WHERE id_sede='$id_sede' ORDER BY id DESC LIMIT 1";
    return mysqli_query($conexion, $consulta);
}
function buscar_anio_academicoultimo($conexion){
    $consulta = "SELECT * FROM anio_academico ORDER BY id DESC LIMIT 1";
    return mysqli_query($conexion, $consulta);
}

// busquedas periodo academico

function buscar_periodos($conexion){
    $consulta = "SELECT * FROM periodo_lectivo";
    return mysqli_query($conexion, $consulta);
}

// busquedas seccioes

function buscar_seccion($conexion){
    $consulta = "SELECT * FROM seccion";
    return mysqli_query($conexion, $consulta);
}
function buscar_seccionPorid($conexion, $id){
    $consulta = "SELECT * FROM seccion WHERE id='$id'";
    return mysqli_query($conexion, $consulta);
}

//busquedas areas curriculares
function buscar_area_curricular($conexion){
    $consulta = "SELECT * FROM area_curricular";
    return mysqli_query($conexion, $consulta);
}
function buscar_area_curricularPorId($conexion, $id){
    $consulta = "SELECT * FROM area_curricular WHERE id='$id'";
    return mysqli_query($conexion, $consulta);
}
function buscar_area_curricularPorIdNivel($conexion, $id){
    $consulta = "SELECT * FROM area_curricular WHERE id_nivel='$id'";
    return mysqli_query($conexion, $consulta);
}


// busquedas curso

function buscar_curso($conexion){
    $consulta = "SELECT * FROM curso";
    return mysqli_query($conexion, $consulta);
}
function buscar_cursoPorId($conexion, $id){
    $consulta = "SELECT * FROM curso WHERE id='$id'";
    return mysqli_query($conexion, $consulta);
}
function buscar_cursoPorIdGrado($conexion, $id_grado){
    $consulta = "SELECT * FROM curso WHERE id_grado='$id_grado'";
    return mysqli_query($conexion, $consulta);
}
function buscar_cursoPorIdArea($conexion, $id_area){
    $consulta = "SELECT * FROM curso WHERE id_area_curricular='$id_area'";
    return mysqli_query($conexion, $consulta);
}

// busquedas copetencias

function buscar_competencia($conexion){
    $consulta = "SELECT * FROM competencia";
    return mysqli_query($conexion, $consulta);
}
function buscar_competenciaPorId($conexion, $id){
    $consulta = "SELECT * FROM competencia WHERE id='$id'";
    return mysqli_query($conexion, $consulta);
}
function buscar_competenciaPorIdCurso($conexion, $id){
    $consulta = "SELECT * FROM competencia WHERE id_curso='$id'";
    return mysqli_query($conexion, $consulta);
}
// busquedas capacidad

function buscar_capacidad($conexion){
    $consulta = "SELECT * FROM capacidad" ;
    return mysqli_query($conexion, $consulta);
}
function buscar_capacidadPorId($conexion, $id){
    $consulta = "SELECT * FROM capacidad WHERE id='$id'" ;
    return mysqli_query($conexion, $consulta);
}
function buscar_capacidadPorIdCompetencia($conexion, $id){
    $consulta = "SELECT * FROM capacidad WHERE id_competencia='$id'" ;
    return mysqli_query($conexion, $consulta);
}
// busquedas ciclos

function buscar_ciclos($conexion){
    $consulta = "SELECT * FROM ciclo" ;
    return mysqli_query($conexion, $consulta);
}
function buscar_ciclosPorId($conexion, $id){
    $consulta = "SELECT * FROM ciclo WHERE id='$id'";
    return mysqli_query($conexion, $consulta);
}
function buscar_ciclosPorIdNivel($conexion, $id_nivel){
    $consulta = "SELECT * FROM ciclo WHERE id_nivel='$id_nivel'";
    return mysqli_query($conexion, $consulta);
}



// busquedas grado

function buscar_grado($conexion){
    $consulta = "SELECT * FROM grado";
    return mysqli_query($conexion, $consulta);
}
function buscar_gradoPorId($conexion, $id){
    $consulta = "SELECT * FROM grado WHERE id='$id'";
    return mysqli_query($conexion, $consulta);
}
function buscar_gradoPorIdCiclo($conexion, $id_ciclo){
    $consulta = "SELECT * FROM grado WHERE id_ciclo='$id_ciclo'";
    return mysqli_query($conexion, $consulta);
}

// busquedas grado

function buscar_modalidad($conexion){
    $consulta = "SELECT * FROM modalidad";
    return mysqli_query($conexion, $consulta);
}
function buscar_modalidadPorId($conexion, $id){
    $consulta = "SELECT * FROM modalidad WHERE id='$id'";
    return mysqli_query($conexion, $consulta);
}



// busquedas sesiones

function buscar_sesion_porID($conexion, $id){
    $consulta = "SELECT * FROM sesiones WHERE id='$id'";
    return mysqli_query($conexion, $consulta);
}




// busquedas cursos programados

function buscar_cursos_prog_porSede_Anio($conexion, $sede, $anio){
    $consulta = "SELECT * FROM programacion_cursos WHERE id_sede='$sede' AND id_anio_academico='$anio'";
    return mysqli_query($conexion, $consulta);
}
function buscar_cursos_prog_porId($conexion, $id){
    $consulta = "SELECT * FROM programacion_cursos WHERE id='$id'";
    return mysqli_query($conexion, $consulta);
}

function buscar_cursos_prog_porSede_Anio_grado_turno_seccion($conexion, $sede, $anio, $curso, $turno, $seccion){
    $consulta = "SELECT * FROM programacion_cursos WHERE id_sede='$sede' AND id_anio_academico='$anio' AND id_curso='$curso' AND id_seccion='$seccion' AND id_turno='$turno'";
    return mysqli_query($conexion, $consulta);
}

//buscar matriculas
function buscar_matriculas($conexion){
    $consulta = "SELECT * FROM matricula ";
    return mysqli_query($conexion, $consulta);
}
function buscar_matriculasPorId($conexion,$id){
    $consulta = "SELECT * FROM matricula WHERE id='$id'";
    return mysqli_query($conexion, $consulta);
}
function buscar_matriculasPorAnioAcademicoSede($conexion,$anio,$sede){
    $consulta = "SELECT * FROM matricula WHERE id_anio_academico='$anio' AND id_sede='$sede'";
    return mysqli_query($conexion, $consulta);
}


//buscar estudiantes matriculados
function buscar_detmatriculadosPorIdCursoProg($conexion, $id_curso){
    $consulta = "SELECT * FROM detalle_matricula WHERE id_curso_programado='$id_curso'";
    return mysqli_query($conexion, $consulta);
}
function buscar_detmatriculadosPorId($conexion, $id){
    $consulta = "SELECT * FROM detalle_matricula WHERE id='$id'";
    return mysqli_query($conexion, $consulta);
}
function buscar_detmatriculadosPorIdMatricula($conexion, $id){
    $consulta = "SELECT * FROM detalle_matricula WHERE id_matricula='$id'";
    return mysqli_query($conexion, $consulta);
}
function buscar_detmatriculadosPorIdCursoProgIdMatricula($conexion, $id_curso,$id_mat){
    $consulta = "SELECT * FROM detalle_matricula WHERE id_curso_programado='$id_curso' AND id_matricula='$id_mat'";
    return mysqli_query($conexion, $consulta);
}

// buscar calificaciones
function buscar_calificacionPorId($conexion, $id){
    $consulta = "SELECT * FROM calificacion WHERE id='$id'";
    return mysqli_query($conexion, $consulta);
}
function buscar_calificacionPorIdDetMat($conexion, $id_det_mat){
    $consulta = "SELECT * FROM calificacion WHERE id_detalle_maticula='$id_det_mat'";
    return mysqli_query($conexion, $consulta);
}
function buscar_calificacionPorIdDetMatOrden($conexion, $id_det_mat,$orden){
    $consulta = "SELECT * FROM calificacion WHERE id_detalle_maticula='$id_det_mat' AND orden='$orden'";
    return mysqli_query($conexion, $consulta);
}

// buscar evaluacion
function buscar_EvaluacionPorId($conexion, $id){
    $consulta = "SELECT * FROM evaluacion WHERE id='$id'";
    return mysqli_query($conexion, $consulta);
}
function buscar_EvaluacionPorIdCalificacion($conexion, $id_calif){
    $consulta = "SELECT * FROM evaluacion WHERE id_calificacion='$id_calif'";
    return mysqli_query($conexion, $consulta);
}
function buscar_EvaluacionPorIdCalificacion_Detalle($conexion, $id_calif,$detalle){
    $consulta = "SELECT * FROM evaluacion WHERE id_calificacion='$id_calif' AND detalle='$detalle'";
    return mysqli_query($conexion, $consulta);
}

// buscar indicadores de logro
function buscar_CritEvaPorIdEvaluacion($conexion, $id_eva){
    $consulta = "SELECT * FROM criterio_evaluacion WHERE id_evaluacion='$id_eva'";
    return mysqli_query($conexion, $consulta);
}
function buscar_CritEvaPorIdEvaluacionOrden($conexion, $id_eva, $orden){
    $consulta = "SELECT * FROM criterio_evaluacion WHERE id_evaluacion='$id_eva'";
    return mysqli_query($conexion, $consulta);
}
?>