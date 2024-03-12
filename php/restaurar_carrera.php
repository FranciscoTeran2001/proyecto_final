<?php
include("conexion.php");

// Verificar si se proporcionó un ID de carrera válido en la URL
if (isset($_GET['id'])) {
    // Obtener el ID de carrera desde la URL
    $id_carrera = $_GET['id'];

    // Restaurar el estado de la carrera a 1 (activo)
    $sql_carrera = "UPDATE carrera SET estado_carrera = 1 WHERE id_carrera = $id_carrera";

    if (mysqli_query($conn, $sql_carrera)) {
        // Restaurar el estado de las materias asociadas a esta carrera
        $sql_materias = "UPDATE materia SET estado_materia = 1 WHERE id_carrera = $id_carrera";
        mysqli_query($conn, $sql_materias);

        // Restaurar el estado de los NRC asociados a las materias de esta carrera
        $sql_nrc = "UPDATE nrc SET estado_nrc = 1 WHERE id_materia IN (SELECT id_materia FROM materia WHERE id_carrera = $id_carrera)";
        mysqli_query($conn, $sql_nrc);

        // Redirigir a la página de carreras eliminadas con un mensaje de éxito
        header("Location: carreras_eliminadas.php?restaurada=true");
        exit();
    } else {
        // Redirigir a la página de carreras eliminadas con un mensaje de error
        header("Location: carreras_eliminadas.php?restaurada=false");
        exit();
    }
} else {
    // Redirigir a la página de carreras eliminadas si no se proporciona un ID de carrera válido
    header("Location: carreras_eliminadas.php");
    exit();
}
?>
