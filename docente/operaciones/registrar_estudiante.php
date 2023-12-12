<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");
// Recoge los datos del formulario
$dni = $_POST['dni'];
$apellidos_nombres = $_POST['apellidos_nombres'];
$correo = $_POST['correo'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$genero = $_POST['genero'];
$sede = $_POST['sede'];
$discapacidad = $_POST['discapacidad'];

// Sube la foto del estudiante al servidor
$ruta_archivo = "../../estudiante/img_estudiante/" . $dni . ".jpg";
$foto = "img_estudiante/" . $dni . ".jpg";


$b_estudiante = buscar_estudiantePorDni($conexion, $dni);
$contar_estudiantes = mysqli_num_rows($b_estudiante);
if ($contar_estudiantes > 0) {
    echo "<script>
        alert('Error, Estudiante ya está registrado');
        window.history.back();
    </script>";
} else {

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $ruta_archivo)) {
        // Realiza la inserción en la base de datos
        $consulta = "INSERT INTO estudiante (dni, apellidos_nombres, correo, telefono, direccion, fecha_nac, genero,foto, id_sede, discapacidad, password, activo, reset_password, token_password) VALUES ('$dni', '$apellidos_nombres', '$correo', '$telefono','$direccion','$fecha_nacimiento', '$genero','$foto', '$sede', '$discapacidad', ' ',1 ,0 ,' ')";

        $resultado = mysqli_query($conexion, $consulta);

        if ($resultado) {

            echo "<script>
                alert('El estudiante se registró correctamente.');
                window.location = '../estudiantes.php';
            </script>";
        } else {
            echo "<script>
                alert('Hubo un error al registrar el estudiante.');
                window.history.back();
            </script>";
        }
    } else {
        echo "<script>
    alert('Error al subir la foto del estudiante.');
    window.history.back();
</script>";
    }
}
