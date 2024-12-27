<?php
session_start();
include("../include/conexion.php");
include("../include/busquedas.php");
include("../include/funciones.php");


require_once('../plugins/tcpdf/tcpdf.php');
setlocale(LC_ALL, "es_ES");

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{



    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, '´Página ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}




$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle("BOLETA DE NOTAS - " . $r_b_pe['nombre'] . " - " . $r_b_sem['descripcion']);
$pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont('helvetica');
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetAutoPageBreak(TRUE, 10);
$pdf->SetFont('helvetica', '', 5);

//BUSCAMOS LAS MATRICULAS SEGUN EL FILTRO
$hoy = date('Y-m-d');

$b_periodo_acad = buscar_anio_academico_id($conexion, $_SESSION['anio_lectivo']);
$rb_periodo_acad = mysqli_fetch_array($b_periodo_acad);


$contar = 0;
$b_matriculas = "SELECT * FROM matricula";
$ejecutar = mysqli_query($conexion, $b_matriculas);
while ($rb_matriculas = mysqli_fetch_array($ejecutar)) {
    $contar++;

    $b_estudiante = buscar_estudiantePorId($conexion, $rb_matriculas['id_estudiante']);
    $rb_estudiante = mysqli_fetch_array($b_estudiante);

    $b_anio_acad = buscar_anio_academico_id($conexion, $_SESSION['anio_lectivo']);
    $rb_anio_acad = mysqli_fetch_array($b_anio_acad);

    $b_sede = buscar_sedesPorId($conexion, $_SESSION['id_sede']);
    $rb_sede = mysqli_fetch_array($b_sede);

    $b_nivel = buscar_nivel_id($conexion, $rb_matriculas['id_nivel']);
    $rb_nivel = mysqli_fetch_array($b_nivel);

    $b_grado = buscar_gradoPorId($conexion, $rb_matriculas['id_grado']);
    $rb_grado = mysqli_fetch_array($b_grado);

    $b_turno = buscar_turno_id($conexion, $rb_matriculas['id_turno']);
    $rb_turno = mysqli_fetch_array($b_turno);

    $b_seccion = buscar_seccionPorid($conexion, $rb_matriculas['id_seccion']);
    $rb_seccion = mysqli_fetch_array($b_seccion);

    $b_periodos_lectivos = buscar_periodos($conexion);
    $cont_periodo_lectivos = mysqli_num_rows($b_periodos_lectivos);
    $cant_columnas = $cont_periodo_lectivos * 2;



    $contenido_cursos = '';
    $b_area_curriculares = buscar_area_curricularPorIdNivel($conexion, $rb_matriculas['id_nivel']);
    while ($rb_areas_curricular = mysqli_fetch_array($b_area_curriculares)) {
        $b_cursos = buscar_cursoPorIdArea($conexion, $rb_areas_curricular['id']);
        $cont_cursos = mysqli_num_rows($b_cursos);
        $contenido_cursos .= '<tr><td rowspan="' . $cont_cursos . '" >' . $rb_areas_curricular['nombre'] . '</td>';
        $contador_cursos = 0;
        while ($rb_cursos = mysqli_fetch_array($b_cursos)) {
            if ($contador_cursos > 0) {
                $contenido_cursos .= '<tr>';
            }
            $contador_cursos++;


            $b_curso_programado = buscar_cursos_prog_porSede_Anio_grado_turno_seccion($conexion, $rb_sede['id'], $rb_anio_acad['id'], $rb_cursos['id'], $rb_turno['id'], $rb_seccion['id']);
            $rb_curso_programado = mysqli_fetch_array($b_curso_programado);
            if (mysqli_num_rows($b_curso_programado) > 0) {

                $contenido_cursos .= '<td>' . $rb_cursos['nombre'] . '</td>';

                $b_det_mat = buscar_detmatriculadosPorIdCursoProgIdMatricula($conexion, $rb_curso_programado['id'], $rb_matriculas['id']);
                $rb_det_mat = mysqli_fetch_array($b_det_mat);

                $b_calificcaciones = buscar_calificacionPorIdDetMat($conexion, $rb_det_mat['id']);
                $suma_total_calif = 0;
                $cant_calif = mysqli_num_rows($b_calificcaciones);
                $cont_calif = 0;
                while ($rb_calificacion = mysqli_fetch_array($b_calificcaciones)) {
                    $id_calif = $rb_calificacion['id'];

                    //funcion para calcular la calificacion
                    $suma_total_evaluacion = calcular_calificacion($conexion, $id_calif);

                    $contenido_cursos .= '<td>';
                    if ($suma_total_evaluacion > 0) {
                        $cont_calif++;
                        $suma_total_calif += round($suma_total_evaluacion);
                        $contenido_cursos .= round($suma_total_evaluacion);
                    }
                    $contenido_cursos .= '</td><td>';
                    if ($suma_total_evaluacion > 0) {
                        $contenido_cursos .= convertir_vigesimal_cualitativo(round($suma_total_evaluacion));
                    }
                    $contenido_cursos .= '</td>';
                }
                $ponderado = '';
                if ($cant_calif == $cont_calif) {
                    $ponderado = convertir_vigesimal_cualitativo($suma_total_calif / $cont_calif);
                }
                $contenido_cursos .= '<td>' . $ponderado . '</td><td></td>';
            }
            $contenido_cursos .= '</tr>';
        }
    }

    //para calcular los ponderados finales
    $contenido_ponderado = '';
    $contenido_puntaje = '';
    for ($i = 1; $i <= $cont_periodo_lectivos; $i++) {
        $suma_ponderado = 0;
        $cont_calif_ponderado = 0;
        $b_det_mats_ponderado = buscar_detmatriculadosPorIdMatricula($conexion, $rb_matriculas['id']);
        while ($rb_det_mats_p = mysqli_fetch_array($b_det_mats_ponderado)) {
            $b_calif_p = buscar_calificacionPorIdDetMatOrden($conexion, $rb_det_mats_p['id'], $i);
            $rb_calif_p = mysqli_fetch_array($b_calif_p);
            $suma_calif_p = calcular_calificacion($conexion, $rb_calif_p['id']);
            if ($suma_calif_p > 0) {
                $suma_ponderado += $suma_calif_p;
                $cont_calif_ponderado++;
            }
        }
        $ponderado_final = round(round($suma_ponderado) / $cont_calif_ponderado);
        $contenido_ponderado .= '<td>' . $ponderado_final . '</td><td></td>';
        $contenido_puntaje .= '<td colspan="2">' . round($suma_ponderado) . '</td>';
    }


    $pdf->AddPage('P', 'A5');
    $contenido = '<table border="1" width="100%" cellspacing="0" cellpadding="3">
    <tr>
        <td rowspan="2" width="30%">LOGO</td>
        <td width="70%">BOLETA DE NOTAS ' . $rb_periodo_acad['nombre'] . '</td>
    </tr>
    <tr>
        <td>Fecha: ' . $hoy . '</td>
    </tr>

</table>
<table border="0" width="100%" cellspacing="0" cellpadding="3">
    <tr>
        <td width="20%" rowspan="2">Nro de Orden</td>
        <td width="20%" rowspan="2">' . $contar . '</td>
        <td width="60%">
            <center>' . $rb_estudiante['apellidos_nombres'] . '<br>....................................<br>Apellidos y Nombres</center>
        </td>
    </tr>
</table>
<table border="1" width="60%" cellspacing="0" cellpadding="3">
    <tr>
        <td width="20%">GRADO</td>
        <td width="20%">' . $rb_grado['nombre'] . ' ' . $rb_seccion['nombre'] . '</td>
        <td width="20%">' . $rb_nivel['nombre'] . '</td>
    </tr>
</table>
<table border="1" width="100%" cellspacing="0" cellpadding="3">
    <tr>
        <td rowspan="3" width="20%">ÁREAS CURRICULARES</td>
        <td rowspan="3" width="20%">CURSOS</td>
        <td colspan="' . $cant_columnas . '" width="40%">TRIMESTRE</td>
        <td rowspan="3" width="10%">PROMEDIO FINAL</td>
        <td rowspan="3" width="10%">PROMEDIO DE ÁREA</td>
    </tr>
    <tr>
        <td colspan="2">I</td>
        <td colspan="2">II</td>
        <td colspan="2">III</td>
    </tr>
    <tr>
        <td>Números</td>
        <td>Letras</td>
        <td>Números</td>
        <td>Letras</td>
        <td>Números</td>
        <td>Letras</td>
    </tr>
    
    ';
    $contenido .= $contenido_cursos;

    $contenido .= '<tr>
    <td rowspan="5"></td>
    <td> PROMEDIO PONDERADO</td>
    ' . $contenido_ponderado . '
    <td rowspan="2" colspan="2" style="border: 3px solid red;">ORDEN DE MÉRITO <br> I TRIMESTRE</td>
</tr>
<tr>
    <td> PUNTAJE</td>
    ' . $contenido_puntaje . '
</tr>
<tr>
    <td colspan="7">CONDUCTA</td>
    <td colspan="2" style="border: 3px solid red;">16 PUESTO</td>
</tr>
<tr>
    <td colspan="3">AD: <br>A: <br>B: <br>C:</td>
    <td colspan="4"><h1>A</h1></td>
</tr>



</table>';


    $pdf->writeHTML($contenido);
}
$pdf->Output('BOLETA DE NOTAS - ' . $r_b_pe['nombre'] . ' ' . $r_b_sem['descripcion'] . '.pdf', 'I');
