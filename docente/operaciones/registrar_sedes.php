<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");

$codigo = $_POST['codigo'];
$nombre = $_POST['nombre'];
$departamento = $_POST['departamento'];
$provincia = $_POST['provincia'];
$distrito = $_POST['distrito'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$responsable = $_POST['responsable'];
$tipo_sede = $_POST['tipo_sede'];

$consulta = "INSERT INTO sede (codigo, nombre, departamento, provincia, distrito, direccion, telefono, correo, id_responsable, tipo) VALUES ('$codigo', '$nombre', '$departamento', '$provincia', '$distrito', '$direccion', '$telefono', '$correo', '$responsable', '$tipo_sede')";

$ejecutar_consulta = mysqli_query($conexion, $consulta);

if ($ejecutar_consulta) {
    echo "<script>
                alert('Se realizó el registro con éxito');
                window.location = '../sedes.php';
            </script>";
}else {
    echo "<script>
                alert('Error, error al registrar');
                window.history.back();
            </script>";
}
