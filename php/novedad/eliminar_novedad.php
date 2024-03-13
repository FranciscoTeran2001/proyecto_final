<?php
include("../conexion.php");

// Verificar si se proporcionó un ID de novedad válido en la URL
if (isset($_GET['id'])) {
    // Obtener el ID de la novedad desde la URL
    $id_novedad = $_GET['id'];

    // Actualizar el estado de la novedad a 0 (eliminado)
    $sql_eliminar = "UPDATE registro_novedades SET estado_novedad = 0 WHERE id_novedad = $id_novedad";

    if (mysqli_query($conn, $sql_eliminar)) {
        // Redireccionar a la página de visualización de novedades
        header("Location: ver_registros_novedad.php");
        exit();
    } else {
        // Mostrar un mensaje de error si la consulta falla
        echo "Error al intentar eliminar la novedad: " . mysqli_error($conn);
    }
} else {
    // Mostrar un mensaje si el ID de la novedad no está especificado
    echo "ID de novedad no especificado.";
}
?>
