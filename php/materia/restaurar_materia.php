<?php
include("../conexion.php");

// Verificar si se proporcionó un ID de materia válido en la URL
if (isset($_GET['id'])) {
    // Obtener el ID de la materia desde la URL
    $id_materia = $_GET['id'];

    // Actualizar el estado de la materia a 1 (restaurado)
    $sql_restaurar = "UPDATE materia SET estado_materia = 1 WHERE id_materia = $id_materia";

    if (mysqli_query($conn, $sql_restaurar)) {
        // Redireccionar a la página de visualización de materias eliminadas
        header("Location: materias_eliminadas.php");
        exit();
    } else {
        // Mostrar un mensaje de error si la consulta falla
        echo "Error al intentar restaurar la materia: " . mysqli_error($conn);
    }
} else {
    // Mostrar un mensaje si el ID de la materia no está especificado
    echo "ID de materia no especificado.";
}
?>
