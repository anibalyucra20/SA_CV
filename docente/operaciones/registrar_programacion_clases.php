<?php
session_start();
include("../../include/conexion.php");
include("../../include/busquedas.php");

$id_curso = $_POST['cursos'];
$seccion = $_POST['seccion'];
$turno = $_POST['turno'];
$modalidad = $_POST['modalidad'];
$docente = $_POST['docente'];

$id_sede = $_SESSION['id_sede'];
$anio_acad = $_SESSION['anio_lectivo'];

$hoy = date('Y-m-d');
$b_anio_acad = buscar_anio_academico_id($conexion, $anio_acad);
$rb_anio_acad = mysqli_fetch_array($b_anio_acad);
$fecha_fin_anio_acad = $rb_anio_acad['fecha_fin'];
echo $fecha_fin_anio_acad;
echo $hoy;

if($hoy <= $fecha_fin_anio_acad){
    $consulta = "INSERT INTO programacion_cursos (id_sede,id_anio_academico,id_curso,id_seccion,id_turno,id_modalidad,id_docente) VALUES ('$id_sede','$anio_acad','$id_curso','$seccion','$turno','$modalidad','$docente')";
    $ejecutar_consulta = mysqli_query($conexion, $consulta);
    if ($ejecutar_consulta) {
        echo "<script>
                    alert('Se realizó el registro con éxito');
                    window.location = '../programacion_clases.php';
                </script>";
    }else {
        echo "<script>
                    alert('Error, error al registrar');
                    window.history.back();
                </script>";
    }

}else{
    echo "<script>
                    alert('Error, No puede programar cursos fuera de la fecha');
                    window.history.back();
                </script>";
}


//$consulta = "INSERT INTO seccion (nombre) VALUES ( '$nombre')";




?>