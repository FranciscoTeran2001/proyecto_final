<?php
include("../conexion.php");

// Definir una variable para almacenar el mensaje de actualización
$update_message = '';

// Verificar si se ha enviado el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_nrc = $_POST['id_nrc'];
    $codigo_nrc = $_POST['codigo_nrc'];
    $id_materia = $_POST['id_materia'];
    $id_docente = $_POST['id_docente'];

    // Actualizar los datos del NRC en la base de datos
    $sql = "UPDATE nrc 
            SET codigo_nrc = '$codigo_nrc', 
                id_materia = '$id_materia', 
                id_docente = '$id_docente' 
            WHERE id_nrc = $id_nrc";

    if (mysqli_query($conn, $sql)) {
        // Establecer el mensaje de actualización exitosa
        $update_message = 'El NRC se ha actualizado correctamente.';
    } else {
        // Establecer el mensaje de error de actualización
        $update_message = 'Error al actualizar el NRC: ' . mysqli_error($conn);
    }
}
?>