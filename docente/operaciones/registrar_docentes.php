<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");
$dni = $_POST['dni'];
$apellidos_nombres = $_POST['apellidos_nombres'];
$correo = $_POST['correo'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$genero = $_POST['genero'];
$fecha_contrato = $_POST['fecha_contrato'];
$grado_academico = $_POST['grado_academico'];
$condicion_laboral = $_POST['condicion_laboral'];
$cargo = $_POST['cargo'];
$sede = $_POST['sede'];

$ruta_archivo = "../img_docente/" . $dni . ".jpg";
$nombre_archivo = "img_docente/" . $dni . ".jpg";

// Validar que el DNI no exista previamente en la base de datos para evitar duplicados
$b_docente = buscar_docenteByDni($conexion, $dni);
$contar_docentes = mysqli_num_rows($b_docente);

if ($contar_docentes > 0) {
    echo "<script>
        alert('Error, Docente ya está registrado');
        window.history.back();
    </script>";
} else {
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $ruta_archivo)) {
        $consulta = "INSERT INTO trabajador (dni, apellidos_nombres, correo, telefono, direccion, fecha_nac, genero, fecha_contrato, grado_academico, cond_laboral, cargo, foto,id_sede, password, estado, reset_password, token_password)
        VALUES ('$dni', '$apellidos_nombres', '$correo', '$telefono', '$direccion', '$fecha_nacimiento', '$genero', '$fecha_contrato', '$grado_academico', '$condicion_laboral', '$cargo', '$nombre_archivo','$sede', '', 1, 0, '')";

        $ejecutar_consulta = mysqli_query($conexion, $consulta);

        if ($ejecutar_consulta) {
            echo "<script>
                alert('Se realizó el registro con éxito');
                window.location = '../docentes.php';
            </script>";
        } else {
            echo "<script>
                alert('Error, error al registrar');
                window.history.back();
            </script>";
        }
    } else {
        echo "<script>
            alert('Error al subir la foto');
            window.history.back();
        </script>";
    }
}
?>