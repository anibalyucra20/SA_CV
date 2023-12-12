<?php
session_start();
include '../../include/conexion.php';
include "../../include/busquedas.php";
include "../../include/funciones.php";

$id_sede = $_POST['id_sede'];
$id_grado = $_POST['id_grado'];
$id_turno = $_POST['id_turno'];
$seccion = $_POST['id_seccion'];

$ejec_cons = buscar_cursoPorIdGrado($conexion, $id_grado);

$cadena = '<div class="checkbox">
		
		</div>';
$contador = 0;
while ($mostrar = mysqli_fetch_array($ejec_cons)) {

    $id_anio = $_SESSION['anio_lectivo'];
    $id_curso = $mostrar["id"];
    $busc_progr = buscar_cursos_prog_porSede_Anio_grado_turno_seccion($conexion, $id_sede, $id_anio, $id_curso, $id_turno,$seccion);

    $cont = mysqli_num_rows($busc_progr);
    if ($cont > 0) {
        $contador+=1;
        $res_curso = mysqli_fetch_array($busc_progr);
        $id_docente = $res_curso['id_docente'];
        $b_docente = buscar_docentePorId($conexion, $id_docente);
        $r_b_docente = mysqli_fetch_array($b_docente);
        $cadena = $cadena . '<label>' .$contador.".- ". $mostrar["nombre"]." - ".$r_b_docente['apellidos_nombres']. '</label>';
        
    }
}
echo $cadena;
