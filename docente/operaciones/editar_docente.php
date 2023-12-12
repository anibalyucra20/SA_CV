<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");
include("../../include/funciones.php");

//no recibir dni  buscar dn BD
$dni = $_POST['editar_dni'];
$apellidos_nombres = $_POST['editar_apellidos_nombres'];
$correo = $_POST['editar_correo'];
$direccion = $_POST['editar_direccion'];
$telefono = $_POST['editar_telefono'];
$fecha_nacimiento = $_POST['editar_fecha_nacimiento'];
$genero = $_POST['editar_genero'];
$fecha_contrato = $_POST['editar_fecha_contrato'];
$grado_academico = $_POST['editar_grado_academico'];
$condicion_laboral = $_POST['editar_condicion_laboral'];
$cargo = $_POST['editar_cargo'];
$estado = $_POST['editar_estado'];
$id_docente = $_POST['data_edit'];

$ruta_archivo = "../img_docente/".$dni.".jpg";
$nombre_archivo = "img_docente/".$dni.".jpg";

$foto = $_FILES['editar_foto'];

if (!empty($foto)) {
    if (unlink($ruta_archivo)) {
        if (move_uploaded_file($_FILES['editar_foto']['tmp_name'], $ruta_archivo)) {
            $consulta = "UPDATE trabajador SET apellidos_nombres='$apellidos_nombres', correo='$correo', telefono='$telefono',direccion='$direccion',fecha_nac='$fecha_nacimiento', genero='$genero', fecha_contrato='$fecha_contrato', grado_academico='$grado_academico', cond_laboral='$condicion_laboral', cargo='$cargo', estado='$estado', foto='$nombre_archivo' WHERE id='$id_docente'";
        }else {
            echo "<script>
                alert('Error, Error al Actualizar Foto');
                window.history.back();
            </script>
            ";
        }
    }else {
        echo "<script>
                alert('Error, Error al Reemplazar Foto');
                window.history.back();
            </script>
            ";
    }

    
    
}else {
    $consulta = "UPDATE trabajador SET apellidos_nombres='$apellidos_nombres', correo='$correo', telefono='$telefono',direccion='$direccion',fecha_nac='$fecha_nacimiento', genero='$genero', fecha_contrato='$fecha_contrato', grado_academico='$grado_academico', cond_laboral='$condicion_laboral', cargo='$cargo', estado='$estado' WHERE id='$id_docente'";
}

$ejecutar_consulta = mysqli_query($conexion, $consulta);
if ($ejecutar_consulta) {
    echo "<script>
                alert('Datos Actualizados Correctamente');
                window.location= '../docentes.php';
                </script>
                ";
}else {
    echo "<script>
        alert('Error, Error al Actualizar Datos');
        window.history.back();
    </script>
    ";
}



?>