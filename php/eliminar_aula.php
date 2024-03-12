<?php
include("conexion.php");

// Verificar si se proporcionó un ID de aula válido en la URL
if (isset($_GET['id'])) {
    // Obtener el ID de aula desde la URL
    $id_aula = $_GET['id'];

    // Actualizar el estado del aula a 0 (eliminado)
    $sql_aula = "UPDATE aula SET estado_aula = 0 WHERE id_aula = $id_aula";

    if (mysqli_query($conn, $sql_aula)) {
        // Redireccionar de nuevo a la página de visualización de aulas
        header("Location: ver_aula.php");
        exit();
    } else {
        echo "Error al intentar eliminar el aula: " . mysqli_error($conn);
    }
} else {
    echo "ID de aula no especificado.";
}
?>
