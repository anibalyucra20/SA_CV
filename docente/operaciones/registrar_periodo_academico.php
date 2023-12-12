<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");

$anio = $_POST['anio'];
$sede = $_POST['sede'];
$director = $_POST['director'];
$secretario = $_POST['secretario'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];

$consulta = "INSERT INTO anio_academico (nombre, id_director, id_secretario, fecha_inicio, fecha_fin, id_sede) VALUES ('$anio', '$director', '$secretario', '$fecha_inicio', '$fecha_fin', '$sede')";

$ejecutar_consulta = mysqli_query($conexion, $consulta);

if ($ejecutar_consulta) {
    echo "<script>
                alert('Se realizó el registro con éxito');
                window.location = '../periodo_academico.php';
            </script>";
}else {
    echo "<script>
                alert('Error, error al registrar');
                window.history.back();
            </script>";
}
