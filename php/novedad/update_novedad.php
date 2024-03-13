<?php
include("../conexion.php");
date_default_timezone_set('America/Guayaquil');
// Definir una variable para almacenar el mensaje de actualización
$update_message = '';

// Verificar si se ha enviado el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_novedad = $_POST['id_novedad'];
    $descripcion_novedad = mysqli_real_escape_string($conn, $_POST['descripcion_novedad']);
    $fecha_edicion_novedad = date("Y-m-d H:i:s"); // Obtener la fecha y hora actual en el formato MySQL
    $id_usuario = mysqli_real_escape_string($conn, $_POST['id_usuario']);
    $id_aula = mysqli_real_escape_string($conn, $_POST['id_aula']);

    // Actualizar los datos de la novedad en la base de datos
    $sql = "UPDATE registro_novedades 
            SET descripcion_novedad = '$descripcion_novedad', 
                fecha_edicion_novedad = '$fecha_edicion_novedad', 
                id_usuario = '$id_usuario', 
                id_aula = '$id_aula' 
            WHERE id_novedad = $id_novedad";

    if (mysqli_query($conn, $sql)) {
        // Establecer el mensaje de actualización exitosa
        $update_message = 'La novedad se ha actualizado correctamente.';
    } else {
        // Establecer el mensaje de error de actualización
        $update_message = 'Error al actualizar la novedad: ' . mysqli_error($conn);
    }
}
?>