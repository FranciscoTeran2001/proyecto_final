<?php
// Definir una variable para almacenar el mensaje de actualización
$update_message = '';

// Verificar si se ha enviado el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_periodo = $_POST['id_periodo'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_final = $_POST['fecha_final'];

    // Actualizar los datos del periodo en la base de datos
    $sql = "UPDATE periodo 
            SET fecha_inicio = '$fecha_inicio', 
                fecha_final = '$fecha_final' 
            WHERE id_periodo = $id_periodo";

    if (mysqli_query($conn, $sql)) {
        // Establecer el mensaje de actualización exitosa
        $update_message = 'El periodo se ha actualizado correctamente.';
    } else {
        // Establecer el mensaje de error de actualización
        $update_message = 'Error al actualizar el periodo: ' . mysqli_error($conn);
    }
}
?>