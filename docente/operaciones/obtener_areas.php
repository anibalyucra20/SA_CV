<?php 
include("../../include/conexion.php");
include("../../include/busquedas.php");

$id_grado = $_POST['id'];

$b_curso = buscar_gradoPorId($conexion, $id_grado);
$rb_curso = mysqli_fetch_array($b_curso);

$b_ciclo =buscar_ciclosPorId($conexion, $rb_curso['id_ciclo']);
$rb_ciclo = mysqli_fetch_array($b_ciclo);

$cadena = "<option></option>";
$b_areas = buscar_area_curricularPorIdNivel($conexion, $rb_ciclo['id_nivel']);
while ($r_b_areas = mysqli_fetch_array($b_areas)) {
    $cadena=$cadena."<option value='".$r_b_areas['id']."'>".$r_b_areas['nombre']."</option>";
}
echo $cadena;

?>
