<?php
include("../conexion.php");

// Definir una variable para almacenar el mensaje de actualización
$update_message = '';

// Verificar si se ha enviado el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_carrera = $_POST['id_carrera'];
    $nombre_carrera = mysqli_real_escape_string($conn, $_POST['nombre_carrera']);

    // Actualizar los datos de la carrera en la base de datos
    $sql = "UPDATE carrera SET nombre_carrera = '$nombre_carrera' WHERE id_carrera = $id_carrera";

    if (mysqli_query($conn, $sql)) {
        // Establecer el mensaje de actualización exitosa
        $update_message = 'La carrera se ha actualizado correctamente.';
    } else {
        // Establecer el mensaje de error de actualización
        $update_message = 'Error al actualizar la carrera: ' . mysqli_error($conn);
    }
}

?>