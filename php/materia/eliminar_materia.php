<?php
include("../conexion.php");

// Verificar si se proporcionó un ID de materia válido en la URL
if (isset($_GET['id'])) {
    // Obtener el ID de la materia desde la URL
    $id_materia = $_GET['id'];

    // Actualizar el estado de la materia a 0 (eliminado)
    $sql_eliminar = "UPDATE materia SET estado_materia = 0 WHERE id_materia = $id_materia";

    if (mysqli_query($conn, $sql_eliminar)) {
        // Redireccionar a la página de visualización de materias
        header("Location: ver_materias.php");
        exit();
    } else {
        // Mostrar un mensaje de error si la consulta falla
        echo "Error al intentar eliminar la materia: " . mysqli_error($conn);
    }
} else {
    // Mostrar un mensaje si el ID de la materia no está especificado
    echo "ID de materia no especificado.";
}
?>
