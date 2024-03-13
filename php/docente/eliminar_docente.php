<?php
include("../conexion.php");

// Verificar si se proporcionó un ID de docente válido en la URL
if (isset($_GET['id'])) {
    // Obtener el ID del docente desde la URL
    $id_docente = $_GET['id'];

    // Actualizar el estado del docente a 0 (inactivo/eliminado lógicamente)
    $sql_eliminar = "UPDATE docente SET estado_docente = 0 WHERE id_docente = $id_docente";

    if (mysqli_query($conn, $sql_eliminar)) {
        // Si la consulta es exitosa, redireccionar a la página de lista de docentes
        // Puede ajustar la ubicación de redireccionamiento según su estructura de archivos
        header("Location: ver_docente.php");
        exit();
    } else {
        // Si ocurre un error en la consulta, mostrarlo
        echo "Error al intentar eliminar el docente: " . mysqli_error($conn);
    }
} else {
    // Si el ID del docente no está definido o es inválido, mostrar un mensaje de error
    echo "ID de docente no especificado.";
}
?>
