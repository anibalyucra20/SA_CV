<?php 
include("../../include/conexion.php");
include("../../include/busquedas.php");

$id_grado = $_POST['id_grado'];

$cadena = "<option></option>";
$b_cursos = buscar_cursoPorIdGrado($conexion, $id_grado);
while ($r_b_cursos = mysqli_fetch_array($b_cursos)) {
    $cadena=$cadena."<option value='".$r_b_cursos['id']."'>".$r_b_cursos['nombre']."</option>";
}
echo $cadena;

?>
