<?php
include("conexion.php");

// Verificar si se proporcionó un ID de aula válido en la URL
if (isset($_GET['id'])) {
    // Obtener el ID de aula desde la URL
    $id_aula = $_GET['id'];

    // Restaurar el estado del aula a 1 (activo)
    $sql_aula = "UPDATE aula SET estado_aula = 1 WHERE id_aula = $id_aula";

    if (mysqli_query($conn, $sql_aula)) {
        // Redirigir a la página de aulas eliminadas con un mensaje de éxito
        header("Location: aulas_eliminados.php?restaurado=true");
        exit();
    } else {
        // Redirigir a la página de aulas eliminadas con un mensaje de error
        header("Location: aulas_eliminados.php?restaurado=false");
        exit();
    }
} else {
    // Redirigir a la página de aulas eliminadas si no se proporciona un ID de aula válido
    header("Location: aulas_eliminados.php");
    exit();
}
?>