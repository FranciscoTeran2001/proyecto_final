<?php
include("../conexion.php");

// Verificar si se proporcionó un ID de carrera válido en la URL
if (isset($_GET['id'])) {
    // Obtener el ID de la carrera desde la URL
    $id_carrera = $_GET['id'];

    // Actualizar el estado de la carrera a 0 (eliminado)
    $sql_carrera = "UPDATE carrera SET estado_carrera = 0 WHERE id_carrera = $id_carrera";
    if (mysqli_query($conn, $sql_carrera)) {

        // Actualizar el estado de las materias asociadas a esta carrera a 0
        $sql_materias = "UPDATE materia SET estado_materia = 0 WHERE id_carrera = $id_carrera";
        mysqli_query($conn, $sql_materias);

        // Actualizar el estado de los NRC asociados a las materias de esta carrera a 0
        $sql_nrc = "UPDATE nrc SET estado_nrc = 0 WHERE id_materia IN (SELECT id_materia FROM materia WHERE id_carrera = $id_carrera)";
        mysqli_query($conn, $sql_nrc);

        // Redireccionar de nuevo a la página de visualización de carreras
        header("Location: ver_carreras.php");
        exit();
    } else {
        echo "Error al intentar eliminar la carrera: " . mysqli_error($conn);
    }
} else {
    echo "ID de carrera no especificado.";
}
?>
