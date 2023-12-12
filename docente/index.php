<?php 
session_start();
include("../include/conexion.php");
include("../include/busquedas.php");
include("../include/funciones.php");

$b_sesion = buscar_sesion_porID($conexion, $_SESSION['id_sesion_sie']);
$rb_sesion = mysqli_fetch_array($b_sesion);
$id_trabajador = $rb_sesion['id_trabajador'];

$b_trabajador = buscar_docentePorId($conexion, $id_trabajador);
$rb_trabajador = mysqli_fetch_array($b_trabajador);
$cargo_trabajador = $rb_trabajador['cargo'];

switch ($cargo_trabajador) {
    case 'Director':
        header("location: director.php");
        break;
    case 'Secretario Academico':
        header("location: secretaria_academica.php");
        break;
    case 'Docente':
        header("location: docente.php");
        break;
    default:
        header("location: login/");
        break;
}


?>