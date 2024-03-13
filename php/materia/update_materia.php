<?php
include("../conexion.php");
// Verificar si se ha enviado el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_materia = $_POST['id_materia'];
    $nombre_materia = $_POST['nombre_materia'];
    $codigo_materia = $_POST['codigo_materia'];
    $creditos_materia = $_POST['creditos_materia'];
    $horas_materias = $_POST['horas_materias'];
    $id_carrera = $_POST['id_carrera'];

    // Actualizar los datos de la materia en la base de datos
    $sql = "UPDATE materia 
            SET nombre_materia = '$nombre_materia', 
                codigo_materia = '$codigo_materia', 
                creditos_materia = '$creditos_materia', 
                horas_materias = '$horas_materias', 
                id_carrera = '$id_carrera' 
            WHERE id_materia = $id_materia";

    if (mysqli_query($conn, $sql)) {
        // Establecer el mensaje de actualización exitosa
        $update_message = 'La materia se ha actualizado correctamente.';
    } else {
        // Establecer el mensaje de error de actualización
        $update_message = 'Error al actualizar la materia: ' . mysqli_error($conn);
    }
}
?>