<?php
include("../../include/conexion.php");
include("../../include/busquedas.php");
// Recoge los datos del formulario
$dni = $_POST['dni'];
$apellidos_nombres = $_POST['apellidos_nombres'];
$correo = $_POST['correo'];
$direccion = $_POST['direccion'];
$fecha_nacimiento= $_POST['fec_nacimiento'];
$telefono = $_POST['telefono'];
$estudiantes = $_POST['estudiantes'];



// Validar que el DNI no exista previamente en la base de datos para evitar duplicados
$b_apoderados = buscar_apoderadoPorDni($conexion, $dni);
$contar_apoderados = mysqli_num_rows($b_apoderados);

if ($contar_apoderados > 0) {
    echo "<script>
        alert('Error, apoderado ya está registrado');
        window.history.back();
    </script>";
} else {
    
        $consulta = "INSERT INTO apoderado (dni, apellidos_nombres, correo, telefono, direccion, fecha_nac, genero, id_estudiantes)
        VALUES ('$dni', '$apellidos_nombres', '$correo', '$telefono', '$direccion', '$fecha_nacimiento', '$genero', '$estudiantes')";

        $ejecutar_consulta = mysqli_query($conexion, $consulta);

        if ($ejecutar_consulta) {
            echo "<script>
                alert('Se realizó el registro con éxito');
                window.location = '../apoderados.php';
            </script>";
        } else {
            echo "<script>
                alert('Error, error al registrar');
                window.history.back();
            </script>";
        }
    }

/*
if ($resultado) {
    // Obtiene el ID del apoderado recién registrado
    $id_apoderado = mysqli_insert_id($conexion);

    // Separa los estudiantes y los almacena en un array
    $estudiantes = explode(',', $estudiantes);

    // Relaciona el apoderado con los estudiantes en la tabla ApoderadoEstudiante
    foreach ($estudiantes as $id_estudiante) {
        $consultaRelacion = "INSERT INTO ApoderadoEstudiante (ID_Apoderado, ID_Estudiante) VALUES ($id_apoderado, $id_estudiante)";
        $resultadoRelacion = mysqli_query($conexion, $consultaRelacion);
    }

    echo "El apoderado se registró correctamente.";

    // Puedes redirigir a una página de éxito o realizar otras operaciones aquí
} else {
    echo "Hubo un error al registrar el apoderado.";
}
*/
?>