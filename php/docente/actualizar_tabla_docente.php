<?php
// Incluir la conexión a la base de datos
include('../conexion.php');


// Verificar si se ha enviado el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_docente = $_POST['id_docente'];
    $nombre_docente = $_POST['nombre_docente'];
    $cedula_docente = $_POST['cedula_docente'];
    $correo_docente = $_POST['correo_docente'];
    $telefono_docente = $_POST['telefono_docente'];
    $especializacion_docente = $_POST['especializacion_docente'];
    $horas_clase_docente = $_POST['horas_clase_docente'];

    // Actualizar los datos del docente en la base de datos
    $sql = "UPDATE docente 
            SET 
                cedula_docente = '$cedula_docente', 
                correo_docente = '$correo_docente', 
                telefono_docente = '$telefono_docente', 
                especializacion_docente = '$especializacion_docente',
                horas_clase_docente = '$horas_clase_docente' 
            WHERE id_docente = $id_docente";

    if (mysqli_query($conn, $sql)) {
        // Establecer el mensaje de actualización exitosa
        $update_message = 'El docente se ha actualizado correctamente.';
    } else {
        // Establecer el mensaje de error de actualización
        $update_message = 'Error al actualizar el docente: ' . mysqli_error($conn);
    }
}
?>
